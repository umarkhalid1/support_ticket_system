<div class="card">
    <div class="p-6">
        <div class="flex flex-row flex-wrap gap-4">
            {{-- Category --}}
            <div class="flex-1 min-w-[180px]">
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                <select class="form-select select2 w-full" wire:model.live='search_category_id'>
                    <option value="">All Categories</option>
                    @foreach ($categories as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach

                </select>
            </div>

            {{-- Status --}}
            <div class="flex-1 min-w-[180px]">
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                <select class="form-select w-full" wire:model.live="search_status">
                    <option value="">All Status</option>
                    <option value="{{ App\Models\Ticket::OPEN_STATUS }}">Open</option>
                    <option value="{{ App\Models\Ticket::IN_PROGRESS_STATUS }}">In Progress</option>
                    <option value="{{ App\Models\Ticket::RESOLVED_STATUS }}">Resolved</option>
                    <option value="{{ App\Models\Ticket::CLOSED_STATUS }}">Closed</option>
                </select>
            </div>

            {{-- Priority --}}
            <div class="flex-1 min-w-[180px]">
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
                <select class="form-select w-full" wire:model.live='search_priority'>
                    <option value="">All Priorities</option>
                    <option value="{{ App\Models\Ticket::LOW_PRIORITY }}">Low</option>
                    <option value="{{ App\Models\Ticket::MEDIUM_PRIORITY }}">Medium</option>
                    <option value="{{ App\Models\Ticket::HIGH_PRIORITY }}">High</option>
                </select>
            </div>

            <div class="flex items-end min-w-[120px]" style="margin-top: 22px;">
                <button type="button" class="btn bg-secondary text-white w-full" wire:click="clearFilters">
                    Reset
                </button>
            </div>
        </div>
    </div>

    <div class="p-6 pt-2">
        <div class="flex justify-between">
            <h3 class="card-title mb-4"> <i class="ri-list-unordered"></i> Tickets List</h3>
        </div>
        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">#
                                </th>
                                <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                    Image</th>
                                <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                    User Name</th>
                                <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                    Category</th>
                                <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                    Assigned To</th>
                                <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                    Title</th>
                                <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                    Priority</th>
                                <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                    Status</th>
                                <th scope="col" class="px-4 py-4 text-center text-sm font-medium text-gray-500">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($tickets as $index => $data)
                                <tr class="bg-gray-50 dark:bg-gray-900" x-data="{ isEditing: false, newPriority: '{{ $data->priority }}', newStatus: '{{ $data->status }}' }"
                                    @click.away="isEditing = false">

                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                        @if (!empty($data->attachement))
                                            <img src="{{ asset('storage/' . $data->attachement) }}" alt="Ticket Image"
                                                class="w-16 h-16 object-cover rounded" />
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                        {{ $data->user->name }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                        {{ $data->category->name }}
                                    </td>
                                    @php
                                        $canAssignTicket = Auth::user()->can('ticket.assign');
                                    @endphp

                                    <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-200">
                                        <div x-data="{
                                            editing: false,
                                            selected: '',
                                            name: '{{ $data->assignto->name ?? 'N/A' }}',
                                            canAssign: {{ $canAssignTicket ? 'true' : 'false' }},
                                            initSelect2() {
                                                const select = this.$refs.select;
                                                $(select).select2({
                                                    placeholder: 'Assign to...',
                                                    dropdownParent: $(select).parent()
                                                });
                                                $(select).on('change', (e) => {
                                                    this.selected = e.target.value;
                                                    this.name = select.options[select.selectedIndex]?.text || 'N/A';
                                                    this.editing = false;
                                                    $(select).select2('destroy');
                                                    Livewire.dispatch('updateAssignedTo', {
                                                        ticketId: {{ $data->id }},
                                                        userId: this.selected
                                                    });
                                                });
                                            }
                                        }" x-init="$watch('editing', val => {
                                            if (val && canAssign) $nextTick(() => initSelect2());
                                        })"
                                            @click.away="
                                                if (editing && canAssign) {
                                                    editing = false;
                                                    if ($refs.select) {
                                                        try {
                                                            $($refs.select).select2('destroy');
                                                        } catch (e) {}
                                                    }
                                                }
                                            ">
                                            <!-- Static View -->
                                            <template x-if="!editing">
                                                <div @click="if (canAssign) editing = true" class="cursor-pointer"
                                                    :class="canAssign ?
                                                        'hover:text-blue-600' :
                                                        'cursor-default text-gray-500'">
                                                    <span x-text="name"></span>
                                                </div>
                                            </template>

                                            <!-- Select2 Dropdown -->
                                            <template x-if="editing && canAssign">
                                                <select x-ref="select"
                                                    class="form-select w-full text-sm border-gray-300 rounded">
                                                    <option value="" disabled selected>Select User</option>
                                                    @foreach ($supportAgents as $supportAgent)
                                                        <option value="{{ $supportAgent->id }}">
                                                            {{ $supportAgent->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </template>
                                        </div>
                                    </td>

                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                        {{ $data->title }}
                                    </td>
                                    @php

                                        $priorityColors = [
                                            App\Models\Ticket::LOW_PRIORITY => 'bg-green-500',
                                            App\Models\Ticket::MEDIUM_PRIORITY => 'bg-orange-500',
                                            App\Models\Ticket::HIGH_PRIORITY => 'bg-red-500',
                                        ];

                                        $priority = $data->priority;
                                    @endphp

                                    <td style="width: 130px;"
                                        class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">

                                        <template x-if="!isEditing">
                                            <span
                                                class="inline-block px-2 py-1 text-white text-xs font-semibold rounded {{ $priorityColors[$priority] ?? 'bg-gray-400' }}">
                                                {{ ucfirst($priority) }}
                                            </span>
                                        </template>
                                        <template x-if="isEditing">
                                            @can('ticket.priority')
                                                <select x-model="newPriority" class="form-select text-sm"
                                                    @change="$wire.updatePriority({{ $data->id }}, newPriority); isEditing = false">
                                                    <option value="low">Low</option>
                                                    <option value="medium">Medium</option>
                                                    <option value="high">High</option>
                                                </select>
                                            @else
                                                <span
                                                    class="inline-block px-2 py-1 text-white text-xs font-semibold rounded {{ $priorityColors[$priority] ?? 'bg-gray-400' }}">
                                                    {{ ucfirst($priority) }}
                                                </span>
                                            @endcan
                                        </template>
                                    </td>

                                    @php

                                        $statusColors = [
                                            App\Models\Ticket::OPEN_STATUS => 'bg-green-500',
                                            App\Models\Ticket::IN_PROGRESS_STATUS => 'bg-yellow-500',
                                            App\Models\Ticket::CLOSED_STATUS => 'bg-red-500',
                                            App\Models\Ticket::RESOLVED_STATUS => 'bg-blue-500',
                                        ];

                                        $status = $data->status;
                                    @endphp

                                    <td style="width: 130px;"
                                        class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                        <template x-if="!isEditing">
                                            <span
                                                class="inline-block px-2 py-1 text-white text-xs font-semibold rounded {{ $statusColors[$status] ?? 'bg-gray-400' }}">
                                                {{ ucwords(str_replace('_', ' ', $status)) }}
                                            </span>
                                        </template>
                                        <template x-if="isEditing">
                                            @can('ticket.status')
                                                <select x-model="newStatus" class="form-select text-sm"
                                                    @change="$wire.updateStatus({{ $data->id }}, newStatus); isEditing = false">
                                                    <option value="open">Open</option>
                                                    <option value="in_progress">In Progress</option>
                                                    <option value="closed">Closed</option>
                                                    <option value="resolved">Resolved</option>
                                                </select>
                                            @else
                                                <span
                                                    class="inline-block px-2 py-1 text-white text-xs font-semibold rounded {{ $statusColors[$status] ?? 'bg-gray-400' }}">
                                                    {{ ucwords(str_replace('_', ' ', $status)) }}
                                                </span>
                                            @endcan
                                        </template>
                                    </td>

                                    <td class="px-4 py-4 whitespace-nowrap text-center">
                                        @can('ticket.status')
                                            <button type="button" @click="isEditing = !isEditing">
                                                <i class="ri-pencil-line"
                                                    style="color: rgb(140, 35, 238); margin-right: 5px; font-size: 18px;"></i>
                                            </button>
                                        @endcan
                                        <a href="{{ route('ticket.detail', $data->id) }}"> <i class="ri-eye-line"
                                                style="color: rgb(140, 35, 238); font-size: 18px; margin-right: 10px;"></i>
                                        </a>
                                        @can('ticket.delete')
                                            <button wire:click="confirmDelete({{ $data->id }})" type="button">
                                                <i class="ri-delete-bin-2-line text-base text-red-600"></i>
                                            </button>
                                        @endcan
                                        @if (
                                            !empty($data->assigned_to) &&
                                                $data->status !== \App\Models\Ticket::CLOSED_STATUS &&
                                                $data->status !== \App\Models\Ticket::RESOLVED_STATUS)
                                            <a href="{{ route('contact.user', [$data->id]) }}">
                                                <i class="ri-message-3-line mr-2"
                                                    style="color: rgb(140, 35, 238); font-size: 18px; margin-right: 10px;"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-gray-500 dark:text-gray-300">
                                        No records found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-6 flex justify-end">
                        {{ $tickets->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script type="text/javascript">
        document.addEventListener("livewire:initialized", function() {

            function loadJavascript() {
                $(".select2").select2().on("change", function() {
                    $wire.set("search_category_id", $(this).val());
                })
            }

            loadJavascript();
            Livewire.hook("morphed", () => {
                loadJavascript();

            })
        });

        $wire.on('deleteConfirmation', (event) => {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.dispatch('delete', {
                        id: event.id
                    });
                }
            });
        });
    </script>
@endscript

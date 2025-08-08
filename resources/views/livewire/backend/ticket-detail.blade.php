<div class="">
    <div class="bg-white shadow-2xl border border-gray-200 rounded-3xl overflow-hidden transition duration-300">
        <!-- Header -->

        <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-10 py-7 flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <i class="ri-ticket-line text-4xl"></i>
                <div>
                    <h2 class="text-3xl font-bold tracking-wide">Ticket #{{ $ticket->id }}</h2>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <a href="{{ route('tickets.index') }}" class="btn bg-secondary text-white ml-2">Back</a>
            </div>
        </div>

        <!-- Ticket Info -->
        <div class="px-10 pb-5">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 items-start">
                @if (!empty($ticket->attachement))
                    <div x-data="{ showPreview: false }" class="relative">
                        <img src="{{ asset('storage/' . $ticket->attachement) }}" alt="Ticket Image"
                            @click="showPreview = true" class="w-full h-auto object-cover rounded cursor-pointer" />

                        <div x-show="showPreview" x-transition @keydown.escape.window="showPreview = false"
                            class="fixed inset-0 z-50 bg-black bg-opacity-80 flex items-center justify-center"
                            style="display: none;">
                            <div @click.away="showPreview = false" class="max-w-3xl w-full px-4">
                                <img src="{{ asset('storage/' . $ticket->attachement) }}" alt="Ticket Image Preview"
                                    class="rounded shadow-lg max-h-[80vh] mx-auto" />
                            </div>
                        </div>
                    </div>
                @else
                    image not uploaded.
                @endif

                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6 text-[15px] text-gray-700">
                    <!-- Title -->
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Title</p>
                        <p class="text-sm text-gray-900 text-lg">{{ $ticket->title }}</p>
                    </div>

                    <!-- Category -->
                    <div>
                        <p class="text-sm text-gray-500">Category</p>
                        <p class="text-sm text-gray-900">{{ $ticket->category->name }}</p>
                    </div>

                    <!-- Priority -->
                    <div>
                        <p class="text-sm text-gray-500 mb-2">Priority</p>
                        <span
                            class="inline-block px-5 py-2 text-xs font-semibold rounded-full shadow-sm
                    @if ($ticket->priority == 'high') bg-red-100 text-red-700
                    @elseif($ticket->priority == 'medium') bg-yellow-100 text-yellow-800
                    @else bg-green-100 text-green-700 @endif">
                            {{ ucfirst($ticket->priority) }}
                        </span>
                    </div>

                    <!-- Status -->
                    <div>
                        <p class="text-sm text-gray-500 mb-2">Status</p>
                        <span
                            class="inline-block px-5 py-2 text-xs font-semibold rounded-full shadow-sm
                    @if ($ticket->status == 'open') bg-green-100 text-green-700
                    @elseif($ticket->status == 'closed') bg-gray-200 text-gray-600
                    @else bg-yellow-100 text-yellow-800 @endif">
                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                        </span>
                    </div>

                    <!-- Submitted By -->
                    <div class="flex items-start gap-2 mt-6">
                        <i class="ri-user-line text-purple-500 text-lg mt-1"></i>
                        <div>
                            <p class="text-sm text-gray-500">Submitted By</p>
                            <p class="text-gray-900">{{ $ticket->user->name }}</p>
                        </div>
                    </div>

                    <!-- Assigned To -->
                    <div class="flex items-start gap-2 mt-6">
                        <i class="ri-user-settings-line text-indigo-500 text-lg mt-1"></i>
                        <div>
                            <p class="text-sm text-gray-500">Assigned To</p>
                            <p class="text-gray-900">{{ $ticket->assignto->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <!-- Assigned To -->
                    <div class="flex items-start gap-2 mt-6">
                        <i class="ri-user-settings-line text-indigo-500 text-lg mt-1"></i>
                        <div>
                            <p class="text-sm text-gray-500">Assigned By</p>
                            <p class="text-gray-900">{{ $ticket->assignBy->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mt-6">
                <div class="flex justify-between mb-5">
                    <h4 class="text-md font-semibold text-gray-800 mb-3 flex items-center gap-1">
                        <i class="ri-file-text-line text-indigo-500"></i> Description
                    </h4>
                    @if (
                        !empty($ticket->assigned_to) &&
                            $ticket->status !== \App\Models\Ticket::CLOSED_STATUS &&
                            $ticket->status !== \App\Models\Ticket::RESOLVED_STATUS)
                        <a href="{{ route('contact.user', [$ticket->id]) }}"
                            class="btn bg-primary btn-sm text-white ml-2">
                            <i class="ri-message-3-line mr-2"></i>Message
                        </a>
                    @endif

                </div>
                <div
                    class="bg-gray-50 border border-gray-200 rounded-xl p-6 text-gray-700 leading-relaxed shadow-inner">
                    {{ $ticket->description }}
                </div>
            </div>
        </div>
    </div>
</div>

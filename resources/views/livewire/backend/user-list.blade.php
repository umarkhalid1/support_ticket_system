<div class="card">
    <div class="p-6 pb-0">
        <label class="block mb-2 font-medium text-gray-700" for="search_by_name">
            Name
        </label>

        <div class="flex items-center gap-2 lg:w-5/12">
            <input id="search_by_name" type="text" wire:model.live.debounce.500ms="search_by_name"
                placeholder="Search by name..." class="form-input w-full" />

            <button type="button" class="btn bg-secondary text-white" wire:click="clearFilters">
                Reset
            </button>
        </div>
    </div>


    <div class="p-6">
        <div class="p-2">
            <div class="flex justify-between">
                <h3 class="card-title mb-4"> <i class="ri-list-unordered"></i> User's List</h3>
                <a href="{{ route('users.create') }}" class="btn text-xs bg-dark text-white">Create</a>
            </div>
            <div class="overflow-x-auto">
                <div class="min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">ID
                                    </th>
                                    <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                        Name</th>
                                    <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                        Email</th>
                                    <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                        Role</th>
                                    <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($users as $index => $data)
                                    <tr class="bg-gray-50 dark:bg-gray-900">

                                        <td
                                            class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                            {{ $index + 1 }}
                                        </td>
                                        <td
                                            class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                            {{ $data->name }}
                                        </td>
                                        <td
                                            class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                            {{ $data->email }}
                                        </td>

                                        <td
                                            class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                            {{ $data->getRoleNames()->first() }}
                                        </td>

                                        <td class="px-4 py-4 whitespace-nowrap">
                                            @can('user.update')
                                                <a href="{{ route('users.edit', $data->id) }}"> <i class="ri-pencil-line"
                                                        style="color: rgba(10, 100, 37, 0.534); margin-right: 5px; font-size: 19px;"></i>
                                                </a>
                                            @endcan
                                            @can('user.delete')
                                                <button wire:click="confirmDelete({{ $data->id }})" type="button"
                                                    style="margin-left: 0px;">
                                                    <i class="ri-delete-bin-2-line text-base text-red-600"></i>
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"
                                            class="px-4 py-6 text-center text-gray-500 dark:text-gray-300">
                                            No records found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-6 flex justify-end">
                            {{ $users->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@script
    <script>
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

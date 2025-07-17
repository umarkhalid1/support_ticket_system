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
        <div class="flex justify-between">
            <h3 class="card-title mb-4"> <i class="ri-list-unordered"></i> Category List</h3>
            <a href="{{ route('categories.create') }}" class="btn bg-dark text-white">Create</a>
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
                                    Status</th>
                                <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($categories as $index => $item)
                                <tr class="bg-gray-50 dark:bg-gray-900">
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                        {{ $categories->firstItem() + $index }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                        {{ $item->name }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                        @livewire('status-update', ['model' => $item, 'field' => 'is_active'], key($item->id . time()))
                                    </td>
                                    <div></div>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center justify-start space-x-3">
                                            @can('category.update')
                                                <a href="{{ route('categories.edit', $item->id) }}"><i
                                                        class=" ri-pencil-fill" style="color: rgb(28, 170, 70)"></i></a>
                                            @endcan

                                            @can('category.delete')
                                                <button wire:click="confirmDelete({{ $item->id }})" type="button">
                                                    <i class="ri-delete-bin-2-line text-base text-red-600"></i>
                                                </button>
                                            @endcan

                                            <!-- Delete Modal -->
                                            @if ($showModal)
                                                <div class="fixed inset-0 z-50 flex items-center justify-center">
                                                    <div
                                                        class="sm:max-w-xs w-full m-3 sm:mx-auto flex flex-col bg-danger text-white shadow-sm rounded transition-all duration-300">
                                                        <div class="p-9 text-center">
                                                            <i class="ri-close-circle-line text-4xl"></i>
                                                            <h4 class="text-xl font-medium mt-3 mb-2.5">Delete
                                                                Confirmation</h4>
                                                            <p class="mt-2 mb-4">Are you sure you want to delete this?
                                                            </p>
                                                            <div class="flex justify-center space-x-4">
                                                                <button type="button" class="btn bg-light text-black"
                                                                    wire:click="cancel">Cancel</button>
                                                                <button type="button" class="btn bg-white text-danger"
                                                                    wire:click="delete">Yes, Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
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
                        {{ $categories->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

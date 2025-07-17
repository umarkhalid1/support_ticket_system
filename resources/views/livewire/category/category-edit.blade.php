<main class="p-4">
    <div class="card mb-6">
        <div class="p-6">
            <h4 class="card-title mb-4">
                Edit Category
            </h4>

            <form wire:submit.prevent="submit" class="grid lg:grid-cols-2 gap-6">
                <div>
                    <label class="mb-2 block">
                        Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" wire:model="name" class="form-input w-full" />

                    @error('name')
                        <span class="text-sm text-red-600 !text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-2">
                    <button type="submit" class="btn bg-primary text-white">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

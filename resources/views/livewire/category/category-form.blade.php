<main class="p-2">
    <div class="card mb-6">
        <div class="p-6">
            <h4 class="card-title mb-4">
                Create Category
            </h4>

            <form wire:submit.prevent="submit" class="grid lg:grid-cols-2 gap-6">
                <div>
                    <label class="mb-2 block" for="name">
                        Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="name" wire:model="name" class="form-input w-full" />

                    @error('name')
                        <span class="text-sm text-red-600 !text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-2">
                    <button type="submit" class="btn bg-primary text-white">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

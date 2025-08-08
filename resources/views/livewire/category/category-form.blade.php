<main class="p-2">
    <div class="card mb-6">
        <div class="p-6">
            <h4 class="card-title mb-4">
                Create Category
            </h4>

            <form wire:submit.prevent="submit" class="grid lg:grid-cols-2 gap-6">

                <!-- Name -->

                <x-my-input name="name" label="Name" type="text" model="name" />

                {{-- <div>
                    <label class="mb-2 block" for="name">
                        Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="name" wire:model="name" class="form-input w-full" />

                    @error('name')
                        <span class="text-sm text-red-600 !text-red-600">{{ $message }}</span>
                    @enderror
                </div> --}}

                {{-- <div x-data="{ fields: [{ value: '' }] }">
                    <template x-for="(field, index) in fields" :key="index">
                        <div>
                            <input type="text"class="form-input w-full" x-model="field.value" :name="`field_${index}`">
                            <button type="button" class="btn bg-primary text-white" @click="fields.splice(index, 1)">Remove</button>
                        </div>
                    </template>
                    <button type="button" @click="fields.push({ value: '' })">Add More</button>
                </div> --}}

                <div class="col-span-2">
                    <x-primary-button style="background: black">{{ __('Save') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</main>

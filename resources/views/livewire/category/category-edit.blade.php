<main class="p-4">
    <div class="card mb-6">
        <div class="p-6">
            <h4 class="card-title mb-4">
                Edit Category
            </h4>

            <form wire:submit.prevent="submit" class="grid lg:grid-cols-2 gap-6">

                <!-- Name -->
                <x-my-input name="name" label="Name" type="text" model="name" />

                <div class="col-span-2">
                    <x-primary-button style="background: black">{{ __('Save') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</main>

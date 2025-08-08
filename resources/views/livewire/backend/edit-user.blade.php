<main class="p-4">
    <div class="card mb-6">
        <div class="p-6">
            <h4 class="card-title text-lg font-semibold mb-6 border-b pb-2">Create User</h4>

            <form wire:submit.prevent="update" class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Name -->
                <x-my-input name="name" label="Name" type="text" model="name" />

                <!-- Email -->
                <x-my-input name="email" label="Email" type="email" model="email" />

                <!-- Password -->
                <x-my-input name="password" label="Password" type="password" model="password" />

                <!-- Role -->
                <div>
                    <label class="mb-2 block font-medium text-gray-700">
                        Role <span class="text-red-600">*</span>
                    </label>
                    <select class="form-control select2 w-full" wire:model="role_id">
                        <option value="" disabled>Select a Role</option>
                        @foreach ($roles as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-1 md:col-span-2">
                    <x-primary-button style="background: black">{{ __('Save') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</main>

@script
    <script type="text/javascript">
        document.addEventListener("livewire:initialized", function() {


            function loadJavascript() {
                $(".select2").select2().on("change", function() {
                    $wire.set("role_id", $(this).val());
                })
            }

            loadJavascript();
            Livewire.hook("morphed", () => {
                loadJavascript();

            })
        })
    </script>
@endscript

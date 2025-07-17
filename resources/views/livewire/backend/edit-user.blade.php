<main class="p-4">
    <div class="card mb-6">
        <div class="p-6">
            <h4 class="card-title text-lg font-semibold mb-6 border-b pb-2">Create User</h4>

            <form wire:submit.prevent="update" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label class="mb-2 block font-medium text-gray-700" for="name">
                        Name <span class="text-red-600">*</span>
                    </label>
                    <input type="text" id="name" wire:model="name" class="form-input w-full" />
                    @error('name')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="mb-2 block font-medium text-gray-700" for="email">
                        Email <span class="text-red-600">*</span>
                    </label>
                    <input type="text" id="email" wire:model="email" class="form-input w-full" />
                    @error('email')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="mb-2 block font-medium text-gray-700" for="password">
                        Password <span class="text-red-600">*</span>
                    </label>
                    <input type="password" id="password" wire:model="password" class="form-input w-full" />
                    @error('password')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

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
                    <button type="submit" class="btn bg-primary text-white px-6 py-2 mt-4 rounded">
                        Submit
                    </button>
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

@push('styles')
<style>
    .select2-container .select2-selection--single {
        height: 37px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 33px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 33px;
    }


    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: black !important;
    }

    .select2-selection--multiple {
        height: 40px;
    }

    .ticket-form {
        background: linear-gradient(to right, #ffffff, #f9f9fb);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
        border: 1px solid #e2e8f0;
    }

    .form-label {
        display: block;
        font-size: 0.95rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
    }

    .form-control {
        width: 100%;
        /* padding: 10px 14px; */
        border: 1px solid #cbd5e0;
        border-radius: 0.5rem;
        font-size: 0.95rem;
        color: #1f2937;
        background-color: #fff;
        transition: border 0.2s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #7732ED;
        box-shadow: 0 0 0 3px rgba(119, 50, 237, 0.1);
    }

    .submit-btn {
        background-color: #7732ED;
        color: #fff;
        font-weight: 600;
        padding: 10px 24px;
        font-size: 1rem;
        border-radius: 0.5rem;
        transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #5b25b6;
    }

    .form-error {
        display: block;
        font-size: 0.85rem;
        color: #dc2626;
        margin-top: 4px;
    }
</style>
@endpush
<main class="p-6 max-w-3xl mx-auto">
    <div class="ticket-form bg-white rounded-2xl shadow-md p-8" style="margin-top: 50px;">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6 border-b pb-3">
            Submit Ticket
        </h1>
        <form wire:submit.prevent="submit" class="space-y-6">
            @if (session()->has('errorLogin'))
            <div
                class="flex items-center justify-between bg-red-100 border border-red-400 text-red-800 text-sm rounded-lg px-4 py-3 mb-6 shadow">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span>{{ session('errorLogin') }}</span>
                </div>

                @guest
                <a href="{{ route('login') }}"
                    class="bg-red-600 hover:bg-red-700 text-white text-xs font-semibold px-3 py-1.5 rounded shadow transition">
                    Go To Login
                </a>
                @endguest
            </div>
            @endif

            @if (session()->has('error'))
            <div
                class="flex items-center justify-between bg-red-100 border border-red-400 text-red-800 text-sm rounded-lg px-4 py-3 mb-6 shadow">
                <div class="flex items-center space-x-2">
                    <span>{{ session('error') }}</span>
                </div>
            </div>
            @endif
            @if (session()->has('success'))
            <div
                class="flex items-center justify-between bg-green-100 border border-green-400 text-green-800 text-sm rounded-lg px-4 py-3 mb-6 shadow">
                <div class="flex items-center space-x-2">
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif

            <div>
                <label for="title" class="form-label">Title <span class="text-red-600">*</span></label>
                <input type="text" id="title" wire:model.defer="title" class="form-control"
                    placeholder="Enter your ticket title" />
                @error('title')
                <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="uploadimage" class="form-label">Upload Image </label>

                <input type="file" id="uploadimage" wire:model="attachement"
                    class="form-control @error('attachement') is-invalid @enderror" accept="image/*" />

                <div wire:loading wire:target="attachement" class="text-sm text-gray-500 mt-1">
                    Uploading...
                </div>

                @error('attachement')
                <span class="invalid-feedback d-block text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="form-label">Category <span class="text-red-600">*</span></label>
                <div>
                    <select class="form-control select2" wire:model="category_id">
                        <option value="" disabled>Select a category</option>
                        @foreach ($categories as $data)
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>

                @error('category_id')
                <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="form-label block mb-2">Priority <span class="text-red-600">*</span></label>
                <div class="flex gap-3">
                    @foreach (['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'] as $value => $label)
                    <label class="inline-flex items-center space-x-2">
                        <input type="radio" wire:model="priority" value="{{ $value }}"
                            class="text-purple-600 focus:ring-purple-500 border-gray-300">
                        <span class="text-sm text-gray-700">{{ $label }}</span>
                    </label>
                    @endforeach

                </div>

                @error('priority')
                <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="description" class="form-label">Description <span class="text-red-600">*</span></label>
                <textarea id="description" wire:model.defer="description" rows="5" class="form-control"
                    placeholder="Describe your issue..."></textarea>
                @error('description')
                <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="text-right">
                <button type="submit" class="submit-btn">🚀 Submit Ticket</button>
            </div>

        </form>
    </div>

</main>

@script
<script type="text/javascript">
    document.addEventListener("livewire:initialized", function() {


            function loadJavascript() {
                $(".select2").select2().on("change", function() {
                    $wire.set("category_id", $(this).val());
                })
            }

            loadJavascript();
            Livewire.hook("morphed", () => {
                loadJavascript();

            })
        })
</script>
@endscript
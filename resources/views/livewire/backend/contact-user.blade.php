{{-- <main class="p-2" wire:listen.window="messageSent"> --}}
<main class="p-2">
    <div class="relative lg:overflow-visible overflow-hidden">
        <div class="lg:flex gap-4">
            <div id="default-offcanvas"
                class="fc-offcanvas-open:translate-x-0 hidden lg:flex lg:static absolute inset-y-0 end-0 translate-x-full lg:rtl:translate-x-0 lg:translate-x-0 rtl:-translate-x-full transition-all duration-300 transform w-full"
                tabindex="-1">
                <div class="card w-full overflow-hidden">
                    <div class="py-3 px-6 border-b border-light dark:border-gray-600 flex justify-between">
                        <div class="flex flex-wrap justify-between gap-3 py-1.5">
                            <div class="sm:w-7/12">
                                <div class="flex items-center gap-2">
                                    <button class="lg:hidden block rtl:rotate-180" data-fc-dismiss type="button">
                                        <i
                                            class="ri-arrow-left-s-line text-xl text-gray-500 hover:text-gray-700 dark:text-gray-500 dark:hover:text-gray-400"></i>
                                    </button>

                                    <img src="{{ asset('assets/images/users/avatar-5.jpg') }}"
                                        class="me-2 rounded-full h-9" alt="Brandon Smith">
                                    <div>
                                        <h5 class="text-sm">
                                            <a class="text-gray-500">{{ $ticket->user->name }}</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->hasRole(App\Models\User::SUPPORT_AGENT_ROLE))
                            <form wire.submit.prevent='updateTicketStatus'>
                                <div class="flex-1 min-w-[180px]">
                                    <select class="form-select w-full" wire:model='ticket_status'
                                        wire:change='updateTicketStatus'>
                                        <option value="">All Status</option>
                                        <option value="{{ App\Models\Ticket::OPEN_STATUS }}">Open</option>
                                        <option value="{{ App\Models\Ticket::IN_PROGRESS_STATUS }}">In Progress</option>
                                        <option value="{{ App\Models\Ticket::RESOLVED_STATUS }}">Resolved</option>
                                        <option value="{{ App\Models\Ticket::CLOSED_STATUS }}">Closed</option>
                                    </select>
                                </div>
                            </form>
                        @endif
                    </div>
                    <div class="p-4">
                        <div x-data="{
                            loading: false,
                            async checkScrollTop(event) {
                                if (event.target.scrollTop === 0 && !this.loading) {
                                    this.loading = true;
                        
                                    await new Promise(resolve => setTimeout(resolve, 100));
                        
                                    Livewire.dispatch('loadMoreReplies');
                        
                                    await new Promise(resolve => setTimeout(resolve, 400)); // optional
                                    this.loading = false;
                                }
                            },
                            scrollToBottom() {
                                $nextTick(() => {
                                    this.$el.scrollTop = this.$el.scrollHeight;
                                });
                            }
                        }" x-init="scrollToBottom()" @scroll="checkScrollTop($event)"
                            class="space-y-4 overflow-y-auto w-full relative"
                            style="max-height: calc(100vh - 300px); scrollbar-width: none; -ms-overflow-style: none;">

                            <div x-show="loading" style="margin-bottom: 50px;"
                                class="absolute top-0 left-1/2 transform -translate-x-1/2 text-gray-500 text-sm">
                                Loading...
                            </div>


                            <!-- Chat Left -->
                            @if ($replies->isEmpty())
                                <div class="flex items-start text-start gap-3 group">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/images/users/avatar-5.jpg') }}"
                                            class="rounded-md h-8" />
                                        {{-- <p class="text-xs pt-0.5">10:00</p> --}}
                                    </div>
                                    <div
                                        class="max-w-3/4 bg-light p-3 relative rounded rounded-ss-none after:top-0 after:-start-2.5 after:absolute after:border-[6px] after:border-t-light after:border-e-light after:border-transparent dark:bg-gray-700 dark:after:border-t-gray-700 dark:after:border-e-gray-700">
                                        <p class="text-xs font-bold relative">{{ $ticket->user->name }}</p>
                                        <p class="pt-1">{{ $ticket->description }}!</p>
                                    </div>

                                </div>
                            @endif
                            <!-- Chat Right -->
                            @foreach ($replies as $reply)
                                @if ($reply->user_id === auth()->id())
                                    <div wire:key="reply-{{ $reply->id }}"
                                        class="flex flex-row-reverse items-start gap-3 group">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                                class="rounded-md h-8" />
                                        </div>
                                        <div
                                            class="max-w-3/4 bg-success p-3 relative rounded rounded-se-none after:top-0 after:-end-2.5 after:absolute after:border-[6px] after:border-t-success after:border-s-success after:border-transparent">
                                            <p class="block text-xs font-bold text-white text-end relative">
                                                {{ $reply->user->name }}

                                                @if ($reply->user->hasRole(App\Models\User::ADMIN_ROLE))
                                                    <b class="text-xs text-white/70">( Admin )</b>
                                                @endif
                                            </p>
                                            <p class="pt-1 text-white/90">{{ $reply->message }}</p>
                                            <div x-data="{ showModal: false, selectedImage: '' }" class="flex gap-2 mt-2 cursor-pointer">
                                                @if ($reply->attachments->isNotEmpty())
                                                    @foreach ($reply->attachments as $attachment)
                                                        <img src="{{ asset('storage/' . $attachment->file_path) }}"
                                                            alt="Ticket Attachment"
                                                            class="w-16 h-16 object-cover rounded shadow hover:scale-105 transition-transform duration-150"
                                                            @click="selectedImage = '{{ asset('storage/' . $attachment->file_path) }}'; showModal = true" />
                                                    @endforeach
                                                @endif
                                                <div x-show="showModal" x-transition x-cloak
                                                    @keydown.escape.window="showModal = false"
                                                    class="fixed inset-0 z-50 bg-black bg-opacity-80 flex items-center justify-center">
                                                    <div class="relative max-w-3xl w-full px-4"
                                                        @click.away="showModal = false">
                                                        <img :src="selectedImage" alt="Selected Attachment"
                                                            class="rounded shadow-lg max-h-[80vh] mx-auto" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    {{-- Chat Left: other user's reply --}}
                                    <div wire:key="reply-{{ $reply->id }}"
                                        class="flex items-start text-start gap-3 group">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/images/users/avatar-5.jpg') }}"
                                                class="rounded-md h-8" />
                                        </div>
                                        <div
                                            class="max-w-3/4 bg-light p-3 relative rounded rounded-ss-none after:top-0 after:-start-2.5 after:absolute after:border-[6px] after:border-t-light after:border-e-light after:border-transparent dark:bg-gray-700 dark:after:border-t-gray-700 dark:after:border-e-gray-700">
                                            <p class="text-xs font-bold relative">{{ $reply->user->name }}
                                                @if ($reply->user->hasRole(App\Models\User::ADMIN_ROLE))
                                                    <b class="text-xs text-black/70">( Admin )</b>
                                                @elseif ($reply->user->hasRole(App\Models\User::SUPER_ADMIN_ROLE))
                                                    <b class="text-xs text-black/70">( Super Admin )</b>
                                                @endif
                                            </p>
                                            <p class="pt-1">{{ $reply->message }}</p>
                                            <div x-data="{ showModal: false, selectedImage: '' }" class="flex gap-2 mt-2 cursor-pointer">
                                                @if ($reply->attachments->isNotEmpty())
                                                    @foreach ($reply->attachments as $attachment)
                                                        <img src="{{ asset('storage/' . $attachment->file_path) }}"
                                                            alt="Ticket Attachment"
                                                            class="w-16 h-16 object-cover rounded shadow hover:scale-105 transition-transform duration-150"
                                                            @click="selectedImage = '{{ asset('storage/' . $attachment->file_path) }}'; showModal = true" />
                                                    @endforeach
                                                @endif
                                                <div x-show="showModal" x-transition x-cloak
                                                    @keydown.escape.window="showModal = false"
                                                    class="fixed inset-0 z-50 bg-black bg-opacity-80 flex items-center justify-center">
                                                    <div class="relative max-w-3xl w-full px-4"
                                                        @click.away="showModal = false">
                                                        <img :src="selectedImage" alt="Selected Attachment"
                                                            class="rounded shadow-lg max-h-[80vh] mx-auto" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-full">
                            <div class="bg-light p-6 dark:bg-gray-700" x-data="chatImageUploader">
                                <!-- Image Preview Section -->
                                <div x-show="images.length > 0" class="mb-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm text-gray-600 dark:text-gray-300">
                                            <span x-text="images.length"></span> image(s) selected
                                        </span>
                                        <button @click="clearAll"
                                            class="text-xs text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                            Clear All
                                        </button>
                                    </div>
                                    <div
                                        class="flex flex-wrap gap-2 max-h-32 overflow-y-auto p-2 bg-white dark:bg-gray-800 rounded">
                                        <template x-for="(image, index) in images" :key="index">
                                            <div class="relative group">
                                                <img :src="image.url" :alt="image.name"
                                                    class="w-16 h-16 object-cover rounded border border-gray-300">
                                                <button style="color: black" @click="removeImage(index)"
                                                    class="absolute -top-1 -right-1 bg-red-500 hover:bg-red-600 rounded-full w-5 h-5 flex items-center justify-center transition-opacity">
                                                    ×
                                                </button>
                                                <div
                                                    class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-1 rounded-b opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <span
                                                        x-text="image.name.length > 10 ? image.name.substring(0, 10) + '...' : image.name"></span>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <form wire:submit.prevent='submit'>
                                    <div class="flex gap-2">
                                        <input type="text"
                                            class="form-input border-none bg-white dark:bg-gray-800 placeholder:text-slate-400"
                                            placeholder="Enter your text" required="" wire:model='message' />
                                        <div class="w-auto">
                                            <div class="flex gap-1">
                                                <a href="#" @click.prevent="$refs.fileInput.click()"
                                                    class="btn text-gray-800 bg-gray-200 hover:bg-dark/20 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-light/20"
                                                    :class="{ 'bg-blue-200 dark:bg-blue-700': images.length > 0 }">
                                                    <i class="ri-attachment-2"></i>
                                                    <span x-show="images.length > 0" class="ml-1 text-xs"
                                                        x-text="images.length"></span>
                                                </a>

                                                <input type="file" x-ref="fileInput" @change="handleFileSelection"
                                                    multiple accept="image/*" style="display: none;" />

                                                <button type="submit" class="btn bg-success text-white w-full">
                                                    <i class="ri-send-plane-2-line"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@script
    <script>
        Alpine.data('chatImageUploader', () => ({
            images: [],
            dragOver: false,

            handleFileSelection(event) {
                const files = Array.from(event.target.files);
                const imageFiles = files.filter(file => file.type.startsWith('image/'));

                imageFiles.forEach(file => {
                    const exists = this.images.some(img => img.name === file.name && img.size === file
                        .size);
                    if (!exists) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.images.push({
                                file: file,
                                name: file.name,
                                size: file.size,
                                url: e.target.result,
                                id: Date.now() + Math.random()
                            });

                            @this.upload(`uploadedImages.${this.images.length - 1}`, file, () => {},
                                () => {}, (error) => {
                                    console.error(error);
                                });
                        };
                        reader.readAsDataURL(file);
                    }
                });

                this.$refs.fileInput.value = '';
            },

            addFiles(files) {
                const imageFiles = files.filter(file => file.type.startsWith('image/'));

                imageFiles.forEach((file, index) => {
                    const exists = this.images.some(img => img.name === file.name && img.size === file
                        .size);
                    if (!exists) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const imageData = {
                                file: file,
                                name: file.name,
                                size: file.size,
                                url: e.target.result,
                                id: Date.now() + Math.random()
                            };
                            this.images.push(imageData);

                            @this.upload(`uploadedImages.${this.images.length - 1}`, file, () => {

                            }, () => {

                            }, (error) => {
                                console.error('Upload failed', error);
                            });
                        };
                        reader.readAsDataURL(file);
                    }
                });

                this.$refs.fileInput.value = '';
            },


            removeImage(index) {
                this.images.splice(index, 1);
            },

            clearAll() {
                this.images = [];
            },

            init() {
                window.addEventListener('clear-images', () => {
                    this.clearAll();
                });
            },

            getImages() {
                return this.images.map(img => img.file);
            }
        }));
    </script>
@endscript

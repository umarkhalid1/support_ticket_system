<main class="p-2">
    <div class="relative lg:overflow-visible overflow-hidden">
        <div class="lg:flex gap-4">

            <div id="default-offcanvas"
                class="fc-offcanvas-open:translate-x-0 hidden lg:flex lg:static absolute inset-y-0 end-0 translate-x-full lg:rtl:translate-x-0 lg:translate-x-0 rtl:-translate-x-full transition-all duration-300 transform w-full"
                tabindex="-1">
                <div class="card w-full overflow-hidden">

                    <div class="py-3 px-6 border-b border-light dark:border-gray-600">
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
                                        <h5 class="text-sm ">
                                            <a class="text-gray-500">{{ $ticket->user->name }}</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 h-[calc(100vh-400px)]" data-simplebar>
                        <div class="space-y-4">
                            <!-- Chat Left -->
                            <div class="flex items-start text-start gap-3 group">
                                <div class="text-center">
                                    <img src="{{ asset('assets/images/users/avatar-5.jpg') }}" class="rounded-md h-8" />
                                    {{-- <p class="text-xs pt-0.5">10:00</p> --}}
                                </div>

                                <div
                                    class="max-w-3/4 bg-light p-3 relative rounded rounded-ss-none after:top-0 after:-start-2.5 after:absolute after:border-[6px] after:border-t-light after:border-e-light after:border-transparent dark:bg-gray-700 dark:after:border-t-gray-700 dark:after:border-e-gray-700">
                                    <p class="text-xs font-bold relative">James Z</p>
                                    <p class="pt-1">{{ $ticket->description }}!</p>
                                </div>

                                {{-- <div class="hidden group-hover:block">
                                    <button class="text-primary" type="button" data-fc-type="dropdown">
                                        <i class="ri-more-2-fill text-lg"></i>
                                    </button>
                                    <div
                                        class="fc-dropdown fc-dropdown-open:opacity-100 opacity-0 min-w-40 mt-2 z-50 transition-all duration-300 bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-600 rounded-md py-1.5 hidden">
                                        <a class="flex items-center py-1.5 px-5 text-sm text-gray-500 hover:bg-slate-100 hover:text-slate-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                            href="javascript: void(0);">Copy Message</a>
                                        <a class="flex items-center py-1.5 px-5 text-sm text-gray-500 hover:bg-slate-100 hover:text-slate-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                            href="javascript: void(0);">Edit</a>
                                        <a class="flex items-center py-1.5 px-5 text-sm text-gray-500 hover:bg-slate-100 hover:text-slate-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                            href="javascript: void(0);">Delete</a>
                                    </div>
                                </div> --}}
                            </div>

                            <!-- Chat Right -->
                            <div class="flex flex-row-reverse items-start text-end gap-3 group">
                                <div class="text-center">
                                    <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" class="rounded-md h-8" />
                                </div>

                                <div
                                    class="max-w-3/4 bg-primary p-3 relative rounded rounded-se-none after:top-0 after:-end-2.5 after:absolute after:border-[6px] after:border-t-primary after:border-s-primary after:border-transparent">
                                    <p class="block text-xs font-bold text-white relative">Geneva M</p>
                                    <p class="pt-1 text-white/90">
                                        Hi, How are you? What about our next meeting?
                                    </p>
                                </div>

                                {{-- <div class="hidden group-hover:block">
                                    <button class="text-primary" type="button" data-fc-type="dropdown"
                                        data-fc-placement="bottom-end">
                                        <i class="ri-more-2-fill text-lg"></i>
                                    </button>
                                    <div
                                        class="fc-dropdown fc-dropdown-open:opacity-100 opacity-0 min-w-40 mt-2 z-50 transition-all duration-300 bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-600 rounded-md py-1.5 hidden">
                                        <a class="flex items-center py-1.5 px-5 text-sm text-gray-500 hover:bg-slate-100 hover:text-slate-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                            href="javascript: void(0);">Copy Message</a>
                                        <a class="flex items-center py-1.5 px-5 text-sm text-gray-500 hover:bg-slate-100 hover:text-slate-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                            href="javascript: void(0);">Edit</a>
                                        <a class="flex items-center py-1.5 px-5 text-sm text-gray-500 hover:bg-slate-100 hover:text-slate-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                            href="javascript: void(0);">Delete</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="w-full">
                            <div class="bg-light p-6 dark:bg-gray-700">
                                <form wire:submit.prevent='submit'>
                                    <div class="flex gap-2">
                                        <input type="text"
                                            class="form-input border-none bg-white dark:bg-gray-800 placeholder:text-slate-400"
                                            placeholder="Enter your text" required="" wire:model='message' />
                                        <input type="hidden" value="{{ $ticket->user_id }}">
                                        <div class="w-auto">
                                            <div class="flex gap-1">
                                                {{-- <a href="#"
                                                    class="btn bg-light text-gray-800 hover:bg-dark/20 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-light/20"><i
                                                        class="ri-attachment-2"></i></a> --}}
                                                <button type="submit" class="btn bg-success text-white w-full"><i
                                                        class="ri-send-plane-2-line"></i></button>
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

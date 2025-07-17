<!-- Sidenav Menu Toggle Button -->
<button id="button-toggle-menu" class="nav-link p-2">
    <span class="sr-only">Menu Toggle Button</span>
    <span class="flex items-center justify-center">
        <i class="ri-menu-2-fill text-2xl"></i>
    </span>
</button>

<!-- Light/Dark Toggle Button -->
<div class="lg:flex hidden relative ms-auto">
    <button id="light-dark-mode" type="button" class="nav-link p-2">
        <span class="sr-only">Light/Dark Mode</span>
        <span class="flex items-center justify-center">
            <i class="ri-moon-line text-2xl block dark:hidden"></i>
            <i class="ri-sun-line text-2xl hidden dark:block"></i>
        </span>
    </button>
</div>

<!-- Profile Dropdown Button -->
<div class="relative">
    <button data-fc-type="dropdown" data-fc-placement="bottom-end" type="button"
        class="nav-link flex items-center gap-2.5 px-3 bg-black/5 border-x border-black/10">
        <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image" class="rounded-full h-8">
        <span class="md:flex flex-col gap-0.5 text-start hidden">
            <h5 class="text-sm">{{ Auth::user()->name }}</h5><span class="text-xs">
                {{ Auth::user()->getRoleNames()->first() }}
            </span>
    </button>

    <div
        class="fc-dropdown fc-dropdown-open:opacity-100 hidden opacity-0 w-44 z-50 transition-all duration-300 bg-white shadow-lg border rounded-lg py-2 border-gray-200 dark:border-gray-700 dark:bg-gray-800">
        <!-- item-->
        <h6 class="flex items-center py-2 px-3 text-xs text-gray-800 dark:text-gray-400">Welcome !</h6>

        <!-- item-->
        <a href="{{ route('profile') }}"
            class="flex items-center gap-2 py-1.5 px-4 text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300">
            <i class="ri-account-circle-line text-lg align-middle"></i>
            <span>My Profile</span>
        </a>

        <livewire:logout />
    </div>
</div>

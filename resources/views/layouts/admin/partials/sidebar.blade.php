<a href="{{ route('dashboard') }}" class="logo-box">
    <div class="logo-light">
        <div class="logo-lg h-[22px]">
            Support Ticket System
        </div>
        <div class="logo-sm h-[22px]">
            TS
        </div>
    </div>

    <div class="logo-dark">
        <div class="logo-lg h-[22px]">
            Ticket System
        </div>
        <div class="logo-sm h-[22px]">
            TS
        </div>
    </div>
</a>

<button id="button-hover-toggle" class="absolute top-5 end-2 rounded-full p-1.5 z-50">
    <span class="sr-only">Menu Toggle Button</span>
    <i class="ri-checkbox-blank-circle-line text-xl"></i>
</button>

<div class="scrollbar" data-simplebar>
    <ul class="menu" data-fc-type="accordion">
        <li class="menu-title">Dashboard</li>

        <li class="menu-item">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <span class="menu-icon">
                    <i class="ri-home-4-line"></i>
                </span>
                <span class="menu-text"> Dashboard </span>
            </a>
        </li>
        @can('user.view')
            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="ri-user-line"></i></span>
                    <span class="menu-text"> User </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{ route('users.create') }}" class="menu-link">
                            <span class="menu-text">Create</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('users') }}" class="menu-link">
                            <span class="menu-text">List</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('category.view')
            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="ri-task-line"></i></span>
                    <span class="menu-text"> Category </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{ route('categories.create') }}" class="menu-link">
                            <span class="menu-text">Create</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('categories') }}" class="menu-link">
                            <span class="menu-text">List</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('ticket.view')
            <li class="menu-item">
                <a href="{{ route('tickets.index') }}" class="menu-link">
                    <span class="menu-icon">
                        <i class="ri-briefcase-line"></i>
                    </span>
                    <span class="menu-text"> Tickets </span>
                </a>
            </li>
        @endcan
    </ul>
</div>

<div>
    <!-- Page Title Start -->
    <div class="flex justify-between items-center mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">Dashboard</h4>
    </div>
    <!-- Page Title End -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- <h1>{{Auth::user()->getAllPermissions()}}</h1> --}}

        {{-- Total Tickets --}}
        <div class="bg-white border border-gray-100 p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h5 class="text-gray-500 text-sm uppercase tracking-wider mb-1">
                        Total Tickets
                    </h5>
                    <h2 class="text-4xl font-extrabold text-gray-800">
                        {{ $totalTickets }}
                    </h2>
                </div>
                <div class="text-indigo-600 bg-indigo-100 p-3 rounded-full text-3xl shadow-sm">
                    🧾
                </div>
            </div>
        </div>
        <div class="bg-white border border-gray-100 p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h5 class="text-gray-500 text-sm uppercase tracking-wider mb-1">
                        Open Tickets
                    </h5>
                    <h2 class="text-4xl font-extrabold text-gray-800">
                        {{ $statusCounts[App\Models\Ticket::OPEN_STATUS] ?? 0 }}
                    </h2>
                </div>
                <div class="text-indigo-600 bg-green-300 p-3 rounded-full text-3xl shadow-sm">
                    🧾
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-100 p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h5 class="text-gray-500 text-sm uppercase tracking-wider mb-1">
                        In Progress Tickets
                    </h5>
                    <h2 class="text-4xl font-extrabold text-gray-800">
                        {{ $statusCounts[App\Models\Ticket::IN_PROGRESS_STATUS] ?? 0 }}
                    </h2>
                </div>
                <div class="text-indigo-600 bg-yellow-200 p-3 rounded-full text-3xl shadow-sm">
                    🧾
                </div>
            </div>
        </div>
        
        <div class="bg-white border border-gray-100 p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h5 class="text-gray-500 text-sm uppercase tracking-wider mb-1">
                        Closed Tickets
                    </h5>
                    <h2 class="text-4xl font-extrabold text-gray-800">
                        {{ $statusCounts[App\Models\Ticket::CLOSED_STATUS] ?? 0 }}
                    </h2>
                </div>
                <div class="text-indigo-600 bg-red-400 p-3 rounded-full text-3xl shadow-sm">
                    🧾
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-100 p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h5 class="text-gray-500 text-sm uppercase tracking-wider mb-1">
                        Resolved Tickets
                    </h5>
                    <h2 class="text-4xl font-extrabold text-gray-800">
                        {{ $statusCounts[App\Models\Ticket::RESOLVED_STATUS] ?? 0 }}
                    </h2>
                </div>
                <div class="text-indigo-600 bg-blue-400 p-3 rounded-full text-3xl shadow-sm">
                    🧾
                </div>
            </div>
        </div>
        

        <div class="bg-white border border-gray-100 p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h5 class="text-gray-500 text-sm uppercase tracking-wider mb-1">
                        High Priority
                    </h5>
                    <h2 class="text-4xl font-extrabold text-gray-800">
                        {{ $priorityCounts[App\Models\Ticket::HIGH_PRIORITY] ?? 0 }}
                    </h2>
                </div>
                <div class="text-indigo-600 bg-red-500 p-3 rounded-full text-3xl shadow-sm">
                    🧾
                </div>
            </div>
        </div>

    </div>

</div>


@script
    <script>
        setTimeout(function() {
            $('#loading-spinner').fadeOut('slow');
        }, 2000);
    </script>
@endscript

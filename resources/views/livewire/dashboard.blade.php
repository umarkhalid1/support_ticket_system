<div>
    <!-- Page Title Start -->
    <div class="flex justify-between items-center mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">Dashboard</h4>
    </div>
    <!-- Page Title End -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- <h1>{{ dd(Auth::user()->getRoleNames()) }}</h1> --}}

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
    @if (Auth::user()->hasAnyRole([App\Models\User::ADMIN_ROLE, App\Models\User::SUPER_ADMIN_ROLE]))
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <section class="bg-white border border-gray-100 p-6 rounded-xl shadow-md">
                <div id="piechart" class="w-full h-64 md:h-96"></div>
            </section>
        </div>
    @endif


</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    var ticketData = @json($ticketsByMonth);

    google.charts.load('current', {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var chartData = [
            ['Month', 'Tickets Created']
        ];
        ticketData.forEach(function(item) {
            chartData.push([item.month, parseInt(item.count)]);
        });

        var data = google.visualization.arrayToDataTable(chartData);

        var options = {
            title: "Tickets Created This Year ({{ date('Y') }})",
            pieHole: 0.4,
            chartArea: {
                width: '100%',
                height: '80%'
            },
            legend: {
                position: 'bottom'
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);

        window.addEventListener('resize', () => {
            chart.draw(data, options);
        });
    }
</script>

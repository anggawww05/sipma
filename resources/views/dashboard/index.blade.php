@extends('layout.dashboard')

@section('content')
    <div class="grid grid-cols-2 gap-4 mb-8">
        <div class="wrapper col-span-2">
            <form method="GET" class="flex items-center gap-3">
                <select name="year" id="year"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#141414] mt-1">
                    @foreach($years as $year)
                        <option value="{{ $year }}" @selected($year == $current_year)>{{ $year }}</option>
                    @endforeach
                </select>
                <button type="submit" class="text-nowrap bg-[#A91D3A] hover:bg-[#CA3453] text-white py-3 px-6 rounded-[4px] focus:outline-none text-[0.875rem] border w-fit">
                    Filter
                </button>
            </form>
        </div>
        <div class="wrapper grid grid-cols-3 gap-4">
            <div class="flex flex-col items-start p-4 bg-blue-500/10 border border-blue-400 rounded-lg shadow-sm">
                <span class="text-xs text-blue-700 mb-1">Total Mahasiswa</span>
                <span class="text-2xl font-bold text-blue-900">{{ $total_student }}</span>
            </div>
            <div class="flex flex-col items-start p-4 bg-green-500/10 border border-green-400 rounded-lg shadow-sm">
                <span class="text-xs text-green-700 mb-1">Total Operator</span>
                <span class="text-2xl font-bold text-green-900">{{ $total_admin }}</span>
            </div>
            <div class="flex flex-col items-start p-4 bg-yellow-400/10 border border-yellow-400 rounded-lg shadow-sm">
                <span class="text-xs text-yellow-700 mb-1">Total Admin</span>
                <span class="text-2xl font-bold text-yellow-900">{{ $total_operator }}</span>
            </div>
            <div class="flex flex-col items-start p-4 bg-pink-500/10 border border-pink-400 rounded-lg shadow-sm">
                <span class="text-xs text-pink-700 mb-1">Total Pengaduan</span>
                <span class="text-2xl font-bold text-pink-900">{{ $total_submission }}</span>
            </div>
            <div class="flex flex-col items-start p-4 bg-emerald-500/10 border border-emerald-400 rounded-lg shadow-sm">
                <span class="text-xs text-emerald-700 mb-1">Total Pengaduan Diterima</span>
                <span class="text-2xl font-bold text-emerald-900">{{ $total_submission_approved }}</span>
            </div>
            <div class="flex flex-col items-start p-4 bg-red-500/10 border border-red-400 rounded-lg shadow-sm">
                <span class="text-xs text-red-700 mb-1">Total Pengaduan Ditolak</span>
                <span class="text-2xl font-bold text-red-900">{{ $total_submission_rejected }}</span>
            </div>
        </div>
        @if(auth()->user()->admin_id)
            <div class="w-full h-80 p-4 border border-[#0d1117]/[0.12] rounded-[4px] flex flex-col">
                <h2 class="text-[1.5rem] font-semibold text-[#0d1117] mb-[12px]">Grafik Pertambahan User Per Bulan</h2>
                <div class="flex-1 flex items-center">
                    <canvas id="chartUserPerMonth" class="w-full h-full"></canvas>
                </div>
            </div>
            <div class="w-full h-80 p-4 border border-[#0d1117]/[0.12] rounded-[4px] flex flex-col">
                <h2 class="text-[1.5rem] font-semibold text-[#0d1117] mb-[12px]">Grafik Pengajuan Berdasarkan Kategori</h2>
                <div class="flex-1 flex items-center">
                    <canvas id="chartReportCategory" class="w-full h-full"></canvas>
                </div>
            </div>
        @endif
        <div class="w-full h-80 p-4 border border-[#0d1117]/[0.12] rounded-[4px] flex flex-col">
            <h2 class="text-[1.5rem] font-semibold text-[#0d1117] mb-[12px]">Grafik Pengajuan Tahunan</h2>
            <div class="flex-1 flex items-center">
                <canvas id="chartReportYear" class="w-full h-full"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const submissionCategory = @json($submission_category);
        const submissionYear = @json($submission_year);
        const submissionMonth = @json($submission_month);

        const ctxCategory = document.getElementById('chartReportCategory');
        const ctxYear = document.getElementById('chartReportYear');

        const labelsCategory = Object.keys(submissionCategory);
        const dataCategory = Object.values(submissionCategory);

        const labelsYear = Object.keys(submissionYear);
        const dataYear = Object.values(submissionYear);

        const labelsMonth = Object.keys(submissionMonth);
        const dataMonth = Object.values(submissionMonth);

        new Chart(ctxCategory, {
            type: 'bar',
            data: {
                labels: labelsCategory,
                datasets: [{
                    label: 'Jumlah Laporan per Kategori',
                    data: dataCategory,
                    borderWidth: 1,
                    backgroundColor: '#CA3453',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(ctxYear, {
            type: 'bar',
            data: {
                labels: labelsYear,
                datasets: [{
                    label: 'Jumlah Laporan per Bulan (Tahun Ini)',
                    data: dataYear,
                    borderWidth: 1,
                    backgroundColor: '#3B82F6',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        const userPerMonth = @json($user_per_month);

        const labelsUserMonth = Object.keys(userPerMonth);
        const dataUserMonth = Object.values(userPerMonth);

        const ctxUserMonth = document.getElementById('chartUserPerMonth');

        new Chart(ctxUserMonth, {
            type: 'line',
            data: {
                labels: labelsUserMonth,
                datasets: [{
                    label: 'User Baru per Bulan',
                    data: dataUserMonth,
                    borderWidth: 2,
                    borderColor: '#6366F1',
                    backgroundColor: 'rgba(99,102,241,0.1)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection

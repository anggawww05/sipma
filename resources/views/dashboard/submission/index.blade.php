@extends('layout.dashboard')

@section('content')
    @if (session()->has('success'))
        <div class="mb-[16px] w-full text-[0.913rem] text-green-400 bg-green-400/[0.08] p-3 rounded-[3px]"
             role="alert">
            {{ session('success') }}
        </div>
    @elseif(session()->has('failed'))
        <div class="mb-[16px] w-full text-[0.913rem] text-red-400 bg-red-400/[0.08] p-3 rounded-[3px]"
             role="alert">
            {{ session('failed') }}
        </div>
    @endif
    <form method="GET" class="mb-4 flex items-center gap-[8px]">
        <input type="text" id="search" name="search" value="{{ $search }}" placeholder="Cari pengajuan..." class="w-full p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]">
        <input type="date" id="start_date" name="start_date" value="{{ $startDate }}" placeholder="Cari dari tanggal..." class="w-full p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]">
        <input type="date" id="end_date" name="end_date" value="{{ $endDate }}" placeholder="Cari sampai tanggal..." class="w-full p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]">
        <button type="submit" class="text-nowrap bg-[#A91D3A] hover:bg-[#CA3453] text-white py-3 px-6 rounded-[4px] focus:outline-none text-[0.875rem] border w-fit">
            Cari
        </button>
        <a href="{{ route('dashboard.submission.create') }}" class="text-nowrap bg-[#A91D3A] hover:bg-[#CA3453] text-white p-3 rounded-[4px] focus:outline-none text-[0.875rem] border w-fit">
            Tambah Pengajuan
        </a>
        <a target="_blank" href="{{ route('dashboard.submission.export-excel', ['search' => $search, 'start_date' => $startDate, 'end_date' => $endDate]) }}" class="lg:col-span-2 text-nowrap bg-transparent hover:bg-[#0d1117]/[0.04] text-[#0d1117] p-3 rounded-[4px] focus:outline-none text-[0.875rem] border border-[#0d1117]/[0.12] hover:border-[#0d1117]/[0.24] w-fit">
            Export Excel
        </a>
    </form>
    <div class="relative overflow-x-auto border border-[#0d1117]/[0.12] rounded-[4px]">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-[0.875rem] text-[#0d1117] bg-[#0d1117]/[0.04] border-b border-[#0d1117]/[0.12]">
            <tr>
                <td class="px-6 py-3 font-medium">
                    Nomor Tiket
                </td>
                <td class="px-6 py-3 font-medium">
                    Pembuat
                </td>
                <td class="px-6 py-3 font-medium">
                    Kategori
                </td>
                <td class="px-6 py-3 font-medium">
                    Judul
                </td>
                <td class="px-6 py-3 font-medium">
                    Status
                </td>
                <td class="px-6 py-3 font-medium">
                    Status Publish
                </td>
                <td class="px-6 py-3 font-medium"></td>
            </tr>
            </thead>
            <tbody>
            @if(count($submissions) === 0)
                <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                    <td colspan="7" class="px-6 py-4 text-center">
                        Tidak ada data pengajuan!
                    </td>
                </tr>
            @else
                @foreach($submissions as $submission)
                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-4">
                            {{ $submission->ticket_number }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $submission->user->username }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $submission->category->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $submission->title }}
                        </td>
                        <td class="px-6 py-4 capitalize">
                            {{ $submission->status }}
                        </td>
                        <td class="px-6 py-4 capitalize">
                            {{ $submission->available }}
                        </td>
                        <td class="px-6 py-4 text-right flex items-center gap-[8px]">
                            @if($submission->status === 'pending')
                                <form action="{{ route('dashboard.submission.confirm', $submission) }}" method="POST" id="confirmForm">
                                    @csrf
                                    <input type="hidden" name="confirm" value="0">
                                    <button type="submit" class="font-medium text-yellow-600 hover:underline">Konfirmasi</button>
                                </form>
                            @endif
                            <a href="{{ route('dashboard.submission.show', $submission) }}" class="font-medium text-blue-600 hover:underline">Detail</a>
                            @if($submission->status === 'approved')
                                <a href="{{ route('dashboard.submission.edit', $submission) }}" class="font-medium text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('dashboard.submission.destroy', $submission) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 hover:underline" onclick="return confirm('Apakah anda yakin ingin menghapus pengajuan ini?')">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                    <td colspan="7" class="px-6 py-4">
                        Total Pengajuan: {{ count($submissions) }}
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('confirmForm').addEventListener('submit', function (e) {
            const isConfirmed = confirm('Apakah anda yakin ingin mengkonfirmasi pengajuan ini?');
            if (isConfirmed) {
                this.querySelector('input[name="confirm"]').value = 1;
            } else {
                this.querySelector('input[name="confirm"]').value = 0;
            }
        });
    </script>
@endsection

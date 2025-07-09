@extends('layout.main')

@section('content')
    <section class="p-6 h-full w-[1400px] mx-auto pt-24">
        <h2 class="w-full text-center mb-6 text-[2rem] font-semibold">Data Pengaduan Saya</h2>
        @if (session()->has('success'))
            <div class="mb-[16px] w-full text-[0.913rem] text-green-400 bg-green-400/[0.08] p-3 rounded-[3px]" role="alert">
                {{ session('success') }}
            </div>
        @elseif(session()->has('failed'))
            <div class="mb-[16px] w-full text-[0.913rem] text-red-400 bg-red-400/[0.08] p-3 rounded-[3px]" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        <form method="GET" class="mb-4 flex items-center gap-[8px]">
            <input type="text" id="search" name="search" value="{{ $search }}" placeholder="Cari pengajuan..."
                class="w-full p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]">
            <a href="{{ route('profile-submission.create') }}"
                class="text-nowrap bg-[#A91D3A] hover:bg-[#CA3453] text-white p-3 rounded-[4px] focus:outline-none text-[0.875rem] border w-fit">
                Tambah Pengajuan
            </a>
        </form>
        <div class="relative overflow-x-auto border border-[#0d1117]/[0.12] rounded-[4px]">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-[0.875rem] text-[#0d1117] bg-[#0d1117]/[0.04] border-b border-[#0d1117]/[0.12]">
                    <tr>
                        <td class="px-6 py-3 font-medium">
                            No Tiket
                        </td>
                        <td class="px-6 py-3 font-medium">
                            Judul
                        </td>
                        <td class="px-6 py-3 font-medium">
                            Kategori
                        </td>
                        <td class="px-6 py-3 font-medium">
                            Status Postingan
                        </td>
                        <td class="px-6 py-3 font-medium">
                            Estimasi Selesai
                        </td>
                        <td class="px-6 py-3 font-medium"></td>
                    </tr>
                </thead>
                <tbody>
                    @if (count($submissions) === 0)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                            <td colspan="4" class="px-6 py-4 text-center">
                                Tidak ada data pengaduan!
                            </td>
                        </tr>
                    @else
                        @foreach ($submissions as $submission)
                            <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    {{ $submission->ticket_number }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $submission->title }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $submission->category->name }}
                                </td>
                                <td class="px-6 py-4 capitalize">
                                    {{ $submission->status }}
                                </td>
                                <td class="px-6 py-4 capitalize">
                                    {{ $submission->estimated_date ? \Carbon\Carbon::parse($submission->estimated_date)->locale('id')->translatedFormat('j F Y') : 'Belum ada estimasi' }}
                                </td>
                                <td class="px-6 py-4 text-right flex items-center gap-[8px]">
                                    @if ($submission->status === 'approved' && !$submission->survey)
                                        <a href="{{ route('profile-submission.edit', $submission->id) }}"
                                            class="font-medium text-yellow-600 hover:underline">Survey Kepuasan</a>
                                    @elseif($submission->status === 'pending' || $submission->survey)
                                        <a href="{{ route('profile-submission.show', $submission->id) }}"
                                            class="font-medium text-blue-600 hover:underline">Lihat Pengajuan</a>
                                    @elseif($submission->status === 'rejected')
                                        <form action="{{ route('profile-submission.create') }}"
                                        {{-- <form action="{{ route('profile-submission.destroy', $submission->id) }}" --}}
                                            method="GET">
                                            @csrf
                                            {{-- @method('DELETE') --}}
                                            <button type="submit" class="font-medium text-red-600 hover:underline"
                                                onclick="return confirm('Apakah anda ingin mengajukan ulang postingan?')">Ajukan
                                                Ulang</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </section>
@endsection

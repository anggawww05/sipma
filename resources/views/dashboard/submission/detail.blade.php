@extends('layout.dashboard')

@section('content')
    @if (session()->has('success'))
        <div class="mb-[16px] w-full text-[0.913rem] text-green-400 bg-green-400/[0.08] p-3 rounded-[3px]" role="alert">
            {{ session('success') }}
        </div>
    @elseif(session()->has('failed'))
        <div class="mb-[16px] w-full text-[0.913rem] text-red-400 bg-red-400/[0.08] p-3 rounded-[3px]" role="alert">
            {{ session('failed') }}
        </div>
    @endif
    <form class="grid lg:grid-cols-2 gap-3 p-4 rounded-[4px] border border-[#0d1117]/[0.12]">
        <div class="lg:col-span-2">
            <label for="image_path" class="block text-sm font-medium">Foto Pengajuan</label>
            <div class="wrapper mt-2">
                <img src="{{ $submission->image_path ? asset('storage/' . $submission->image_path) : 'https://placehold.co/400x400?text=Image+Not+Found' }}"
                    alt="Foto Pengajuan"
                    class="w-[100px] aspect-square rounded-[4px] object-cover border border-[#0d1117]/[0.12]">
            </div>
        </div>
        <div class="lg:col-span-2">
            <label for="title" class="block text-sm font-medium">Judul</label>
            <input type="text" id="title" name="title" value="{{ $submission->title }}"
                class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" readonly>
        </div>
        <div>
            <label for="username" class="block text-sm font-medium">Pembuat</label>
            <input type="text" id="username" name="username" value="{{ $submission->user->username }}"
                class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" readonly>
        </div>
        <div>
            <label for="name" class="block text-sm font-medium">Kategori</label>
            <input type="text" id="name" name="name" value="{{ $submission->category->name }}"
                class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" readonly>
        </div>
        <div>
            <label for="status" class="block text-sm font-medium">Status</label>
            <input type="text" id="status" name="status" value="{{ $submission->status }}"
                class="capitalize w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]"
                readonly>
        </div>
        <div>
            <label for="available" class="block text-sm font-medium">Status Publish</label>
            <input type="text" id="available" name="available" value="{{ $submission->available }}"
                class="capitalize w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]"
                readonly>
        </div>
        <div class="lg:col-span-2">
            <label for="description" class="block text-sm font-medium">Konten</label>
            <textarea id="description" name="description"
                class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" readonly
                rows="6">{{ $submission->description }}</textarea>
        </div>
        <div class="lg:col-span-2">
            <label for="description" class="block text-sm font-medium">Survey</label>
            <textarea id="description" name="description"
                class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" readonly
                rows="6">{{ $submission->survey ? $submission->survey : 'Survey belum ditambah' }}</textarea>
        </div>
        <div>
            <label for="estimated_date" class="block text-sm font-medium">Estimasi Tanggal</label>
            <input type="text" id="estimated_date" name="estimated_date"
            value="{{ $submission->estimated_date ? \Carbon\Carbon::parse($submission->estimated_date)->translatedFormat('d F Y') : 'Belum ada estimasi' }}"
            class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" readonly>
        </div>
        <a href="{{ route('dashboard.submission.index') }}"
            class="lg:col-span-2 bg-transparent hover:bg-[#0d1117]/[0.04] text-[#0d1117] p-3 rounded-[4px] focus:outline-none text-[0.875rem] border border-[#0d1117]/[0.12] hover:border-[#0d1117]/[0.24] w-fit">
            Kembali ke Halaman Pengajuan
        </a>
    </form>
    @if ($submission->status === 'approved')
        <h2 class="text-[1.5rem] font-semibold mt-8">Daftar Seluruh Pengajuan Timeline</h2>
        <form method="GET" class="mb-4 flex items-center gap-[8px] mt-4">
            <input type="text" id="search" name="search" value="{{ $search }}" placeholder="Cari timeline..."
                class="w-full p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]">
            @if ($hasSelesai)
                <a href="#"
                    class="text-nowrap bg-gray-400 cursor-not-allowed text-white p-3 rounded-[4px] focus:outline-none text-[0.875rem] border w-fit pointer-events-none">
                    Timeline Sudah Selesai
                </a>
            @else
                <a href="{{ route('dashboard.timeline.create', ['submission' => $submission->id]) }}"
                    class="text-nowrap bg-[#A91D3A] hover:bg-[#CA3453] text-white p-3 rounded-[4px] focus:outline-none text-[0.875rem] border w-fit">
                    Tambah Timeline
                </a>
            @endif
        </form>
        <div class="relative overflow-x-auto border border-[#0d1117]/[0.12] rounded-[4px]">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-[0.875rem] text-[#0d1117] bg-[#0d1117]/[0.04] border-b border-[#0d1117]/[0.12]">
                    <tr>
                        <td class="px-6 py-3 font-medium">
                            Judul
                        </td>
                        <td class="px-6 py-3 font-medium">
                            Status
                        </td>
                        <td class="px-6 py-3 font-medium">
                            Urutan
                        </td>
                        <td class="px-6 py-3 font-medium"></td>
                    </tr>
                </thead>
                <tbody>
                    @if (count($submissionTimelines) === 0)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                            <td colspan="4" class="px-6 py-4 text-center">
                                Tidak ada data pengajuan timeline!
                            </td>
                        </tr>
                    @else
                        @foreach ($submissionTimelines as $timeline)
                            <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    {{ $timeline->title }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $timeline->status }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $timeline->order }}
                                </td>
                                <td class="px-6 py-4 text-right flex items-center gap-[8px]">
                                    <a href="{{ route('dashboard.timeline.show', ['submission' => $submission->id, 'timeline' => $timeline->id]) }}"
                                        class="font-medium text-blue-600 hover:underline">Detail</a>
                                    <a href="{{ route('dashboard.timeline.edit', ['submission' => $submission->id, 'timeline' => $timeline->id]) }}"
                                        class="font-medium text-yellow-600 hover:underline">Edit</a>
                                    <form
                                        action="{{ route('dashboard.timeline.destroy', ['submission' => $submission->id, 'timeline' => $timeline->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 hover:underline"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus pengajuan timeline ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    @endif
@endsection

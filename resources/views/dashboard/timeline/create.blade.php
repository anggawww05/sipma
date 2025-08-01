@extends('layout.dashboard')

@section('content')
    @if(session()->has('failed'))
        <div class="mb-[16px] w-full text-[0.913rem] text-red-400 bg-red-400/[0.08] p-3 rounded-[3px]"
             role="alert">
            {{ session('failed') }}
        </div>
    @endif
    <form action="{{ route('dashboard.timeline.store', ['submission' => $submission->id]) }}" method="POST" class="grid lg:grid-cols-2 gap-3 p-4 rounded-[4px] border border-[#0d1117]/[0.12]" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ $submission->id }}" name="submission_id">
        {{-- <div>
            <label for="title" class="block text-sm font-medium">Judul</label>
            <input type="text" id="title" name="title" placeholder="Masukkan judul pengajuan timeline..." class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]">
            @error('title')
            <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
            @enderror
        </div> --}}
        <div>
            <label for="status" class="block text-sm font-medium">Status</label>
            <select id="status" name="status" class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" required>
                <option value="">Pilih status timeline...</option>
                <option value="Pengaduan Diterima">Pengaduan Diterima</option>
                <option value="Ditugaskan ke Departemen">Ditugaskan ke Departemen</option>
                <option value="Investigasi ke Lapangan">Investigasi ke Lapangan</option>
                <option value="Tindakan Eksekusi">Tindakan Eksekusi</option>
                <option value="Selesai">Selesai</option>
            </select>
            @error('status')
            <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
            @enderror
        </div>
        <div class="lg:col-span-2">
            <label for="order" class="block text-sm font-medium">Urutan</label>
            <input type="text" id="order" name="order" placeholder="Masukkan urutan pengajuan timeline..." value="{{ count($submission->timelines) + 1 }}" class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" required readonly>
            @error('order')
            <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
            @enderror
        </div>
        <div class="lg:col-span-2">
            <label for="description" class="block text-sm font-medium">Deskripsi</label>
            <textarea id="description" name="description" placeholder="Masukkan deskripsi pengajuan timeline..." class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" rows="6"></textarea>
            @error('description')
            <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
            @enderror
        </div>
        <div class="wrapper lg:col-span-2 flex items-center gap-[6px]">
            <button type="submit" class="cursor-pointer text-nowrap bg-[#A91D3A] hover:bg-[#CA3453] text-white p-3 rounded-[4px] focus:outline-none text-[0.875rem] border w-fit">
                Tambah Timeline
            </button>
            <a href="{{ route('dashboard.submission.show', $submission) }}" class="bg-transparent hover:bg-[#0d1117]/[0.04] text-[#0d1117] p-3 rounded-[4px] focus:outline-none text-[0.875rem] border border-[#0d1117]/[0.12] hover:border-[#0d1117]/[0.24] w-fit">
                Batal Tambah
            </a>
        </div>
    </form>
@endsection

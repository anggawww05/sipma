@extends('layout.dashboard')

@section('content')
    <form class="grid lg:grid-cols-2 gap-3 p-4 rounded-[4px] border border-[#0d1117]/[0.12]">
        <div>
            <label for="title" class="block text-sm font-medium">Judul</label>
            <input type="text" id="title" name="title" value="{{ $timeline->title }}" class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" readonly>
        </div>
        <div>
            <label for="status" class="block text-sm font-medium">Status</label>
            <input type="text" id="status" name="status" value="{{ $timeline->status }}" class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" readonly>
        </div>
        <div class="lg:col-span-2">
            <label for="order" class="block text-sm font-medium">Urutan</label>
            <input type="text" id="order" name="order" value="{{ $timeline->order }}" class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" readonly>
        </div>
        <div class="lg:col-span-2">
            <label for="description" class="block text-sm font-medium">Description</label>
            <textarea id="description" name="description" class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" readonly rows="6">{{ $timeline->description }}</textarea>
        </div>
        <a href="{{ route('dashboard.submission.show', $submission) }}" class="lg:col-span-2 bg-transparent hover:bg-[#0d1117]/[0.04] text-[#0d1117] p-3 rounded-[4px] focus:outline-none text-[0.875rem] border border-[#0d1117]/[0.12] hover:border-[#0d1117]/[0.24] w-fit">
            Kembali ke Halaman Pengajuan Timeline
        </a>
    </form>
@endsection

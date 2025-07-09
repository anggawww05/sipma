@extends('layout.dashboard')

@section('content')
    <form class="grid lg:grid-cols-2 gap-3 p-4 rounded-[4px] border border-[#0d1117]/[0.12]">
        <div class="lg:col-span-2">
            <label for="image_path" class="block text-sm font-medium">Foto Blog</label>
            <div class="wrapper mt-2">
                <img src="{{ $blog->image_path ? asset('storage/' . $blog->image_path) : 'https://placehold.co/400x400?text=Image+Not+Found' }}" alt="Foto Blog" class="w-[100px] aspect-square rounded-[4px] object-cover border border-[#0d1117]/[0.12]">
            </div>
        </div>
        <div class="lg:col-span-2">
            <label for="title" class="block text-sm font-medium">Judul</label>
            <input type="text" id="title" name="title" value="{{ $blog->title }}" class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" readonly>
        </div>
        <div class="lg:col-span-2">
            <label for="description" class="block text-sm font-medium">Konten</label>
            <textarea rows="6" id="description" name="description" class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" readonly>{{ $blog->description }}</textarea>
        </div>
        <a href="{{ route('dashboard.blog.index') }}" class="lg:col-span-2 bg-transparent hover:bg-[#0d1117]/[0.04] text-[#0d1117] p-3 rounded-[4px] focus:outline-none text-[0.875rem] border border-[#0d1117]/[0.12] hover:border-[#0d1117]/[0.24] w-fit">
            Kembali ke Halaman Blog
        </a>
    </form>
@endsection

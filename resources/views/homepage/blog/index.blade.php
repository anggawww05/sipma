@extends('layout.main')

@section('content')
    <div class="w-screen h-screen p-30">
        <h1 class="text-[20px] font-semibold text-center mb-2">Seluruh Berita Terupdate</h1>
        <div class="mb-8 flex justify-center">
            <form method="GET" class="mb-4 flex items-center gap-[8px] w-full max-w-2xl">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari blog disini..." class="w-full p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]">
                <button type="submit" class="bg-[#A91D3A] hover:bg-[#CA3453] text-white p-3 rounded-[4px] focus:outline-none text-[0.875rem] border w-fit">
                    Cari
                </button>
            </form>
        </div>
        <div class="grid grid-cols-4 gap-4">
            @if(count($blogs) === 0)
                <p class="col-span-4 w-full text-center text-[0.913rem] text-[#0d1117]/[0.42] mt-8">Data blog tidak ada.</p>
            @else
                @foreach($blogs as $blog)
                    <div class="w-full rounded-[12px] overflow-hidden border border-[#0d1117]/[0.12] bg-white shadow max-w-sm mx-auto flex flex-col">
                        <div class="overflow-hidden h-48">
                            <img src="{{ asset('storage/' . $blog->image_path) }}" alt="Dummy Image" class="w-full h-full object-cover transition-transform duration-300 ease-in-out hover:scale-105">
                        </div>
                        <div class="flex-1 flex flex-col p-4">
                            <h2 class="text-[1.125rem] font-semibold mb-2 text-[#0d1117]">{{ $blog->title }}</h2>
                            <a href="{{ route('blog.show', $blog->id) }}" class="mt-auto block w-full text-center bg-black hover:bg-gray-700 text-white py-2 rounded-[6px] font-medium transition-colors duration-200">Selengkapnya</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

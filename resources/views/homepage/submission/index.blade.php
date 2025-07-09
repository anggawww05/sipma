@extends('layout.main')

@section('content')
    <div class="w-screen h-full p-30">
        <h1 class="text-[20px] font-semibold text-center mb-2">Daftar Pengaduan Mahasiswa</h1>
        <div class="mb-8 flex justify-center">
            <form method="GET" class="mb-4 flex items-center gap-[8px] w-full max-w-2xl">
                <input type="text" name="search" value="{{ $filter->search }}" placeholder="Cari pengaduan disini..." class="w-full p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]">
                <button type="submit" class="bg-[#A91D3A] hover:bg-[#CA3453] text-white p-3 rounded-[4px] focus:outline-none text-[0.875rem] border w-fit">
                    Cari
                </button>
            </form>
        </div>
        <div class="wrapper w-full flex gap-4">
            <div class="wrapper w-[300px] p-4 bg-white rounded-[4px] border border-[#0d1117]/[0.12]">
                <h6 class="text-[1.125rem] font-semibold mb-4 pb-2 border-b border-[#0d1117]/[0.12]">Filter Pengajuan</h6>
                <form method="GET" class="wrapper flex flex-col gap-3">
                    <div class="wrapper">
                        <h6 class="text-[0.913rem] font-semibold mb-2">Tahun Upload</h6>
                        <div class="wrapper flex flex-wrap gap-1">
                            @foreach($years as $i => $year)
                                <div class="flex items-center gap-2 p-2 border border-gray-200 rounded-sm">
                                    <input @checked($year == $filter->year) id="year-{{ $i }}" type="radio" value="{{ $year }}" name="year" class="w-3 h-3 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="year-{{ $i }}" class="w-full text-sm font-medium text-[#0d1117]/[0.62]">{{ $year }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="wrapper">
                        <h6 class="text-[0.913rem] font-semibold mb-2">Bulan Upload</h6>
                        <div class="wrapper flex flex-wrap gap-1">
                            @foreach($months as $i => $month)
                                <div class="flex items-center gap-2 p-2 border border-gray-200 rounded-sm">
                                    <input @checked($month == $filter->month) id="month-{{ $i }}" type="radio" value="{{ $month }}" name="month" class="w-3 h-3 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="month-{{ $i }}" class="w-full text-sm font-medium text-[#0d1117]/[0.62]">{{ $month }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="wrapper">
                        <h6 class="text-[0.913rem] font-semibold mb-2">Kategori</h6>
                        <div class="wrapper flex flex-wrap gap-1">
                            @foreach($categories as $i => $category)
                                <div class="flex items-center gap-2 p-2 border border-gray-200 rounded-sm">
                                    <input @checked($category->name == $filter->category) id="category-{{ $i }}" type="radio" value="{{ $category->name }}" name="category" class="w-3 h-3 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="category-{{ $i }}" class="w-full text-sm font-medium text-[#0d1117]/[0.62]">{{ $category->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="wrapper">
                        <h6 class="text-[0.913rem] font-semibold mb-2">Jenis Postingan</h6>
                        <div class="wrapper flex flex-wrap gap-1">
                            <div class="flex items-center gap-2 p-2 border border-gray-200 rounded-sm">
                                <input @checked('favorite' == $filter->type) id="type-1" type="radio" value="favorite" name="type" class="w-3 h-3 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="type-1" class="w-full text-sm font-medium text-[#0d1117]/[0.62]">Favorit</label>
                            </div>
                            <div class="flex items-center gap-2 p-2 border border-gray-200 rounded-sm">
                                <input @checked('latest' == $filter->type) id="type-2" type="radio" value="latest" name="type" class="w-3 h-3 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="type-2" class="w-full text-sm font-medium text-[#0d1117]/[0.62]">Terbaru</label>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper flex gap-1">
                        <button type="submit" class="w-full text-nowrap cursor-pointer bg-[#A91D3A] hover:bg-[#CA3453] text-white p-3 rounded-[4px] focus:outline-none text-[0.875rem] border">
                            Terapkan
                        </button>
                        <button type="reset" class="w-full text-nowrap bg-transparent hover:bg-[#0d1117]/[0.04] text-[#0d1117] p-3 rounded-[4px] focus:outline-none text-[0.875rem] border border-[#0d1117]/[0.12] hover:border-[#0d1117]/[0.24]">
                            Bersihkan FIlter
                        </button>
                    </div>
                </form>
            </div>

            <div class="w-full grid grid-cols-3 gap-4">
                @if(count($submissionPosts) === 0)
                    <p class="col-span-4 w-full text-center text-[0.913rem] text-[#0d1117]/[0.42] mt-8">Data pengajuan postingan tidak ada.</p>
                @else
                    @foreach($submissionPosts as $submissionPost)
                        <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-200 border border-gray-200 flex flex-col">
                            <div class="w-full h-56 overflow-hidden rounded-t-lg"> {{-- h-40 -> h-56 --}}
                                <img class="w-full h-full object-cover object-center transition-transform duration-200 hover:scale-105" src="{{ asset('storage/' . $submissionPost->image_path) }}" alt="Image">
                            </div>
                            <div class="flex flex-col flex-1 p-4">
                                <h3 class="font-semibold text-base md:text-lg mb-1 md:mb-2 text-[#0d1117] line-clamp-2">{{ $submissionPost->title }}</h3>
                                <p class="text-gray-500 text-sm mb-3 md:mb-4 line-clamp-3 flex-1">{{ $submissionPost->description }}</p>
                                <a href="{{ route('submission.show', $submissionPost->id) }}"
                                   class="mt-auto inline-block text-white bg-[#A91D3A] hover:bg-[#CA3453] py-2 px-4 rounded transition-colors duration-150 text-sm font-medium text-center">
                                    Lihat Pengaduan
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection

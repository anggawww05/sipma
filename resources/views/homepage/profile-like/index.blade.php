@extends('layout.main')

@section('content')
    <div class="w-screen h-full bg-[#F5F5F5] p-30">
        <h1 class="text-[20px] font-semibold text-center mb-8">Daftar Pengajuan Disukai</h1>
        <div class="mb-8 flex justify-center">
            <form method="GET" class="flex items-center">
                <input type="text" name="search" placeholder="Cari pengaduan disini..." value="{{ $search }}"
                    class="w-96 px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-[#A91D3A]">
                <button type="submit" class="px-4 py-2 bg-[#A91D3A] text-white rounded-r-lg hover:bg-[#CA3453] transition">
                    Cari
                </button>
            </form>
        </div>
        <div class="wrapper w-full flex gap-4">
            <div class="w-full grid grid-cols-4 gap-4">
                @if(count($submission_posts) === 0)
                    <p class="col-span-4 w-full text-center text-[0.913rem] text-[#0d1117]/[0.42] mt-8">Data pengaduan postingan disukai tidak ada.</p>
                @else
                    @foreach($submission_posts as $submissionPost)
                        <div class="bg-white h-fit rounded-xl shadow-md overflow-hidden border border-gray-200">
                            <img class="w-full h-40 object-cover" src="{{ asset('storage/' . $submissionPost->image_path) }}" alt="Image">
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-2">{{ $submissionPost->title }}</h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $submissionPost->description }}</p>
                                <a href="{{ route('submission.show', $submissionPost->id) }}"
                                    class="inline-block text-white bg-[#A91D3A] hover:bg-[#CA3453] py-2 px-4 rounded">Lihat
                                    Pengaduan</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection

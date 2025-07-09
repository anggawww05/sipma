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
        <input type="text" id="search" name="search" value="{{ $search }}" placeholder="Cari blog..." class="w-full p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]">
        <a href="{{ route('dashboard.blog.create') }}" class="text-nowrap bg-[#A91D3A] hover:bg-[#CA3453] text-white p-3 rounded-[4px] focus:outline-none text-[0.875rem] border w-fit">
            Tambah Blog
        </a>
    </form>
    <div class="relative overflow-x-auto border border-[#0d1117]/[0.12] rounded-[4px]">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-[0.875rem] text-[#0d1117] bg-[#0d1117]/[0.04] border-b border-[#0d1117]/[0.12]">
            <tr>
                <td class="px-6 py-3 font-medium">
                    Pembuat
                </td>
                <td class="px-6 py-3 font-medium">
                    Judul
                </td>
                <td class="px-6 py-3 font-medium">
                    Konten
                </td>
                <td class="px-6 py-3 font-medium"></td>
            </tr>
            </thead>
            <tbody>
            @if(count($blogs) === 0)
                <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                    <td colspan="4" class="px-6 py-4 text-center">
                        Tidak ada data blog!
                    </td>
                </tr>
            @else
                @foreach($blogs as $blog)
                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-4">
                            {{ $blog->user->username }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $blog->title }}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Illuminate\Support\Str::limit($blog->description, 50) }}
                        </td>
                        <td class="px-6 py-4 text-right flex items-center gap-[8px]">
                            <a href="{{ route('dashboard.blog.show', $blog) }}" class="font-medium text-blue-600 hover:underline">Detail</a>
                            <a href="{{ route('dashboard.blog.edit', $blog) }}" class="font-medium text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('dashboard.blog.destroy', $blog) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:underline" onclick="return confirm('Apakah anda yakin ingin menghapus blog ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection

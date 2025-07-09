@extends('layout.main')

@section('content')
    <div class = "container mx-auto flex justify-center flex-col">
        <div class = "my-40">
            <h1 class="text-[20px] text-center font-semibold">Profil Akun</h1>
            @if(session()->has('success'))
                <div class="mb-[16px] w-[600px] text-[0.913rem] text-green-400 bg-green-400/[0.08] p-3 rounded-[3px] mx-auto"
                     role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session()->has('failed'))
                <div class="mb-[16px] w-[600px] text-[0.913rem] text-red-400 bg-red-400/[0.08] p-3 rounded-[3px] mx-auto"
                     role="alert">
                    {{ session('failed') }}
                </div>
            @endif
            <div class ="flex items-center mt-5 mx-auto justify-between w-[600px] h-[120px] bg-white outline outline-[#AAAAAA] rounded-xl p-4"
                data-aos="fade-up" id="profil">
                <div class = "flex items-center space-x-4">
                    <img src="{{ auth()->user()->student->image_path ? asset('storage/' . auth()->user()->student->image_path) : 'https://placehold.co/400x400?text=Image+Not+Found' }}" alt="#"
                        class="h-16 w-16 object-cover rounded-full overflow-hidden border-2 border-black">
                    <div class="item-center">
                        <h1 class=" text-[26px] font-semibold">{{ auth()->user()->student->full_name }}</h1>
                        <p>{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}"
                    class="bg-[#A91D3A] h-[35px] w-[100px] text-[15px] text-white px-4 py-2 rounded hover:bg-[#CA3453] transition">Edit
                    Profil</a>
            </div>
            <div class="flex flex-col items-center gap-2 mt-4 " data-aos="fade-up">
                <a href="{{ route('profile-submission.index') }}">
                    <div
                        class="w-[600px] h-[40px] bg-white outline outline-[#AAAAAA] rounded-lg p-2 hover:bg-gray-200 transition">
                        <h1>Pengaduan Saya</h1>
                    </div>
                </a>
                <a href="{{ route('profile-like.index') }}">
                    <div
                        class="w-[600px] h-[40px] bg-white outline outline-[#AAAAAA] rounded-lg p-2 hover:bg-gray-200 transition">
                        <h1>Daftar Postingan Disukai</h1>
                    </div>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-[600px] h-[40px] bg-white outline outline-[#AAAAAA] rounded-lg p-2 hover:bg-[#DB2F27] hover:text-white transition text-left"
                        data-aos="fade-up">Log out
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

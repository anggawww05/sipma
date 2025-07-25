@extends('layout.auth')

@section('content')
    <main
        class="auth bg-[#0d1117] w-full min-h-screen h-fit py-[32px] flex flex-col gap-[12px] items-center justify-center">
        <div class="border border-white/[0.08] text-white w-full max-w-md p-4 rounded-[6px]">
            <img src="{{ asset('images/full-logo-sipma.png') }}" alt="SIPMA Logo" class="w-[320px] mx-auto">
            <h1 class="text-[2rem] font-semibold text-center">Halo, selamat datang!</h1>
            <p class="text-[1rem] text-white/[0.42] text-center mb-[16px]">Silahkan lengkapi data untuk pendaftaran akun.</p>
            @if(session()->has('failed'))
                <div class="mb-[16px] w-full text-[0.913rem] text-red-400 bg-red-400/[0.08] p-3 rounded-[3px]"
                     role="alert">
                    {{ session('failed') }}
                </div>
            @endif
            <form action="{{route('register.store')}}" method="POST" class="flex flex-col gap-2">
                @csrf
                <div>
                    <label for="username" class="block text-sm font-medium">Nama Pengguna</label>
                    <input type="text" id="username" name="username"
                           class="w-full mt-2 p-3 rounded-black text-white border border-white/[0.12] rounded-[4px]"
                           required placeholder="Enter your username...">
                    @error('username')
                        <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input type="email" id="email" name="email"
                           class="w-full mt-2 p-3 rounded-black text-white border border-white/[0.12] rounded-[4px]"
                           required placeholder="Enter your email...">
                    @error('email')
                    <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium">Kata Sandi</label>
                    <input type="password" id="password" name="password"
                           class="w-full mt-2 p-3 rounded-black text-white border border-white/[0.12] rounded-[4px]"
                           required placeholder="Enter your password...">
                    @error('password')
                    <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="confirm_password" class="block text-sm font-medium">Konfirmasi Kata Sandi</label>
                    <input type="password" id="confirm_password" name="confirm_password"
                           class="w-full mt-2 p-3 rounded-black text-white border border-white/[0.12] rounded-[4px]"
                           required placeholder="Enter your confirm password...">
                    @error('confirm_password')
                    <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-between mt-4 mb-4">
                    <button type="submit"
                            class="cursor-pointer bg-[#A91D3A] hover:bg-[#CA3453] text-white p-3 rounded-[4px] focus:outline-none w-full">
                        Daftar
                    </button>
                </div>
                <p class="text-center text-sm">Sudah memiliki akun?
                    <a href="{{route('login.index')}}" class="text-[#A91D3A] hover:underline">Login disini</a>
                </p>
            </form>
        </div>
    </main>
@endsection

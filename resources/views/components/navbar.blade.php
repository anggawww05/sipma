<nav class="bg-[#0d1117] fixed w-full z-50">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <img src="{{ asset('images/full-logo-sipma.png') }}" alt="Rekonser logo" class="h-8">
        <div class="flex flex-row justify-end order-2 gap-2">
            @if (!auth()->user())
                <a href="{{ route('register.index') }}"
                    class="bg-[#A91D3A] py-1 px-6 rounded-lg text-white hover:bg-[#CA3453] text-[16px]">Daftar</a>
                <a href="{{ route('login.index') }}"
                    class="text-[#A91D3A] border-2 border-[#A91D3A] rounded-lg py-1 px-6 hover:bg-[#A91D3A] hover:text-white text-[16px]">Masuk</a>
            @else
                <a href="{{ route('profile.index') }}"
                    class="bg-[#A91D3A] py-1 px-6 rounded-lg text-white hover:bg-[#CA3453] text-[16px]">Profil</a>
            @endif
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky ">
            <ul class="flex gap-7">
                <li>
                    <a href="{{ route('main.index') }}"
                        class="block py-2 px-3 text-white bg-[#0d1117] text-[16px] hover:underline @if (Route::is('main.index')) underline @endif"
                        aria-current="page">Beranda</a>
                </li>
                <li>
                    <a href="{{ route('submission.index') }}"
                       class="block py-2 px-3 text-white bg-[#0d1117] text-[16px] hover:underline @if (Route::is('submission.*')) underline @endif">Pengaduan</a>
                </li>
                <li>
                    <a href="{{ route('blog.index') }}"
                        class="block py-2 px-3 text-white bg-[#0d1117] text-[16px] hover:underline @if (Route::is('blog.*')) underline @endif">Berita</a>
                </li>
                <li>
                    <a href="{{ route('track.index') }}"
                        class="block py-2 px-3 text-white bg-[#0d1117] text-[16px] hover:underline @if (Route::is('track.*')) underline @endif">Timeline Pengaduan</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

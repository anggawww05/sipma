<aside class="sidebar bg-[#0d1117] fixed top-0 left-0 bottom-0 z-40 w-[280px] min-h-screen h-fit">
    <div class="sidebar-menu flex flex-col p-4">
        <img src="{{ asset('images/full-logo-sipma.png') }}" class="w-[200px] mx-auto" alt="logo rekonser">
        <hr class="my-4 border border-white/[0.08]">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('dashboard.index') }}" class="cursor-pointer w-full flex items-center px-3 py-2 text-white rounded-[4px] bg-white/[0.04] hover:bg-[#CA3453] {{ Route::is('dashboard.index') ? '!bg-[#CA3453]' : '' }}">
                    <i class="fa-solid fa-house"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap text-start">Dashboard</span>
                </a>
            </li>
            @if(auth()->user()->admin_id)
                <li>
                    <a href="{{ route('dashboard.admin.index') }}" class="cursor-pointer w-full flex items-center px-3 py-2 text-white rounded-[4px] bg-white/[0.04] hover:bg-[#CA3453] {{ Route::is('dashboard.admin*') ? '!bg-[#CA3453]' : '' }}">
                        <i class="fa-solid fa-user"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap text-start">Admin</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ route('dashboard.operator.index') }}" class="cursor-pointer w-full flex items-center px-3 py-2 text-white rounded-[4px] bg-white/[0.04] hover:bg-[#CA3453] {{ Route::is('dashboard.operator*') ? '!bg-[#CA3453]' : '' }}">
                    <i class="fa-solid fa-user"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap text-start">Operator</span>
                </a>
            </li>
            @if(auth()->user()->admin_id)
                <li>
                    <a href="{{ route('dashboard.student.index') }}" class="cursor-pointer w-full flex items-center px-3 py-2 text-white rounded-[4px] bg-white/[0.04] hover:bg-[#CA3453] {{ Route::is('dashboard.student*') ? '!bg-[#CA3453]' : '' }}">
                        <i class="fa-solid fa-user"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap text-start">Siswa</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ route('dashboard.submission.index') }}" class="cursor-pointer w-full flex items-center px-3 py-2 text-white rounded-[4px] bg-white/[0.04] hover:bg-[#CA3453] {{ Route::is('dashboard.submission.*') || Route::is('dashboard.timeline*') ? '!bg-[#CA3453]' : '' }}">
                    <i class="fa-regular fa-folder-open"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap text-start">Pengaduan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.submission-post.index') }}" class="cursor-pointer w-full flex items-center px-3 py-2 text-white rounded-[4px] bg-white/[0.04] hover:bg-[#CA3453] {{ Route::is('dashboard.submission-post*') ? '!bg-[#CA3453]' : '' }}">
                    <i class="fa-solid fa-file-lines"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap text-start">Postingan Pengaduan</span>
                </a>
            </li>
            @if(auth()->user()->admin_id)
                <li>
                    <a href="{{ route('dashboard.blog.index') }}" class="cursor-pointer w-full flex items-center px-3 py-2 text-white rounded-[4px] bg-white/[0.04] hover:bg-[#CA3453] {{ Route::is('dashboard.blog*') ? '!bg-[#CA3453]' : '' }}">
                        <i class="fa-solid fa-file-lines"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap text-start">Blog</span>
                    </a>
                </li>
            @endif
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="cursor-pointer w-full flex items-center px-3 py-2 text-white rounded-[4px] bg-white/[0.04] hover:bg-[#CA3453]">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap text-start">Keluar</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>

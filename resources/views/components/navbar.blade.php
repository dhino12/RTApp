<nav
    class="{{ $className }}"
>
    <div class="flex justify-between items-center">
        <a href="/">
            <div class="flex flex-col">
                <h1
                    class="font-afacad font-bold text-2xl"
                >
                    Informasi Warga
                </h1>
                <p class="font-afacad text-sm">
                    RT002/RW02 Jatibening Baru
                </p>
            </div>
        </a>
        <div class="lg:hidden">
            <button data-collapse-toggle="navbar-default">
                <svg
                    class="w-6 h-6 {{ str_contains($className, "fill-white") ? 'fill-white' : '' }}"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
            </button>
        </div>
    </div>
    <div
        class="p-5 justify-around lg:flex flex-col hidden lg:flex-row lg:py-0"
        id="navbar-default"
    >
        <div class="dropdown inline-block relative transition-all duration-300">
            <button class="font-semibold py-2 px-4 rounded inline-flex items-center">
                <a href="/#about-us" class="mr-1">Tentang Kami</a>
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
            </button>
            <ul class="dropdown-menu backdrop-blur-2xl rounded-lg relative md:absolute hidden pt-1 text-gray-700">
                <li class="">
                    <a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="/categories">
                        Categories
                    </a>
                </li>
            </ul>
        </div>
        <div class="relative">
            <a href="/#syarat-prosedur" class="font-semibold hover:text-blue-700 py-2 px-4 rounded inline-flex items-center">
                Syarat & Prosedur
            </a>
        </div>
        <div class="relative">
            <a href="/#gallery-kegiatan" class="font-semibold hover:text-blue-700 py-2 px-4 rounded inline-flex items-center">
                Galeri Kegiatan
            </a>
        </div>
        <div class="relative">
            <a href="/#data-laporan" class="font-semibold hover:text-blue-700 py-2 px-4 rounded inline-flex items-center">
                Data & Laporan
            </a>
        </div>
        <div class="relative">
            <a href="/#info-warga" class="font-semibold hover:text-blue-700 py-2 px-4 rounded inline-flex items-center">
                Info Warga
            </a>
        </div> 
    </div>
</nav>
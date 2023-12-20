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
                <p class="font-afacad text-xl">
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
        class="p-5 justify-around lg:flex flex-col hidden lg:flex-row gap-5 lg:py-0"
        id="navbar-default"
    >
        <span class="font-afacad text-xl">Tentang Kami</span>
        <span class="font-afacad text-xl">
            Syarat & Prosedur
        </span>
        <span class="font-afacad text-xl">
            Galeri Kegiatan
        </span>
        <span class="font-afacad text-xl">
            Data & Laporan
        </span>
        <span class="font-afacad text-xl">Info Warga</span>
    </div>
</nav>
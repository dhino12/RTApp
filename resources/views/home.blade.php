@extends('layouts/main')

@section('header')
    @include('components/navbar', [
        "className" => "container mt-5 mx-auto p-4 w-full fixed text-slate-800 px-12 z-20 left-0 right-0 rounded-t-[50px] rounded-b-[50px] bg-[#ffffffcc] backdrop-blur-2xl flex flex-col justify-between transition-all duration-200 lg:flex-row lg:items-center lg:w-[80rem]"
    ])
    @include('components/header-jumbotron')
@endsection

@section('container')
<style>
    @layer utilities {
        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    }
</style>
@php
    function getImage($data): string {
        $pattern = '/&quot;url&quot;:&quot;([^&]*)&quot;/';
        preg_match($pattern, $data->body, $bodyImageMatch);
        $bodyImageMatch = count($bodyImageMatch) == 0 ? 'https://source.unsplash.com/1000x600?football' : $bodyImageMatch[1];
        $galleryImages = count($data->images) == 0 || preg_match('/\.mp4$/', $data->images[0]->name) ? 
            false : '/images/' . $data->images[0]->name;
        $image = $galleryImages ?: $bodyImageMatch ;
        return $image;
    }
@endphp
    <div class="container bg-gradient-to-b from-white via-slate-200 via-80% to-white sm:max-w-full mt-5 mx-auto">
        <div class="mx-5 md:mx-10 pt-4 bg-[#ffffffcc]/80 backdrop-blur-2xl rounded-3xl shadow-md sm:-mt-32 md:-mt-44 md:max-w-screen-md md:mx-auto xl:max-w-screen-lg">
            <h1 class="text-center mt-2 font-bold text-4xl font-afacad bg-gradient-to-t from-cyan-500 to-blue-600 bg-clip-text text-transparent">
                Informasi Penduduk
            </h1>
            <div class="grid grid-cols-2 gap-2 sm:grid-cols-4">
                <div class="flex items-center flex-col p-5">
                    <span class="material-symbols-outlined bg-white text-3xl px-3 py-2 rounded-2xl text-blue-400 shadow-md">male</span>
                    <h1 class="counter text-5xl mt-3 font-bold bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text text-transparent font-afacad">
                        0
                    </h1>
                    <p class="font-semibold text-center">Laki-Laki</p>
                </div>
                <div class="flex items-center flex-col p-5">
                    <span class="material-symbols-outlined bg-white text-3xl px-3 py-2 rounded-2xl text-blue-400 shadow-md" >female</span>
                    <h1 class="counter text-5xl mt-3 font-bold bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text text-transparent font-afacad">
                        0
                    </h1>
                    <p class="font-semibold text-center">Perempuan</p>
                </div>
                <div class="flex items-center flex-col p-5">
                    <span class="material-symbols-outlined bg-white text-3xl px-3 py-2 rounded-2xl text-blue-400 shadow-md">badge</span>
                    <h1 class="counter text-5xl mt-3 font-bold bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text text-transparent font-afacad">
                        0
                    </h1>
                    <p class="font-semibold text-center">Total Warga</p>
                </div>
                <div class="flex items-center flex-col p-5">
                    <span class="material-symbols-outlined bg-white text-3xl px-3 py-2 rounded-2xl text-blue-400 shadow-md">
                        family_restroom
                    </span>
                    <h1 class="counter text-5xl mt-3 font-bold bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text text-transparent font-afacad">
                        0
                    </h1>
                    <p class="font-semibold text-center">Keluarga</p>
                </div>
            </div>
        </div>
        <div class="mt-20 mx-5 md:mx-12 lg:max-w-7xl lg:mx-auto lg:px-8">
            <div class="mx-auto text-center">
                <span class="material-symbols-outlined text-3xl px-3 py-2 rounded-2xl shadow-lg bg-gradient-to-r from-cyan-400 to-blue-600 text-white">holiday_village</span>
            </div>
            <h1 id="about-us" class="font-bold text-3xl font-afacad text-center bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text text-transparent lg:text-4xl">
                Tentang Kami
            </h1>
            <h2 class="font-semibold text-center text-2xl font-afacad">Lingkungan</h2>
            <p class="mx-5 md:mx-8 mt-3 text-center lg:w-[120vh] lg:mx-auto">
                {{ strip_tags($about->description) }}
            </p>
            <div class="grid grid-cols-1 mt-10 lg:mx-5 md:grid-cols-2 md:gap-8 items-center">
                <div class="h-80 rounded-2xl overflow-hidden border-red-700 card-hover shadow-lg md:mt-2 md:h-full lg:max-h-[80vh]">
                    <img src="{{ $about->path_image }}" alt="" class="w-full h-full object-cover object-top">
                </div>
                <div class="">
                    <h2 class="font-semibold text-2xl font-afacad">Visi & Misi RT 002 RW 02</h2>
                    <div class="my-5 border-l-4 border-blue-500 rounded-md pl-4 py-2">
                        <h3 class="text-2xl font-semibold font-afacad">Visi</h3>
                        <p class="text-justify font-inter">
                            {{ strip_tags($about->visi) }}
                        </p>
                    </div>
                    <div class="border-l-4 border-blue-500 rounded-md pl-4 py-2">
                        <h3 class="text-2xl font-semibold font-afacad">Misi</h3>
                        {!! $about->misi !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-20 relative">
            <div class="h-[128vh] xl:h-[90vh] sm:h-[120vh] bg-gradient-to-r from-cyan-400 to-blue-600">
                <img src="https://source.unsplash.com/random" alt="" class="w-full h-full object-cover object-center mix-blend-soft-light opacity-75">
            </div>
            <div class="flex flex-col md:flex-row absolute top-20 left-0 right-0">
                <div class="md:w-[70vh] md:ml-32 md:mr-24 md:mb-auto mx-10 mb-10 my-auto text-white">
                    <h1 class="text-center mb-5 font-bold text-3xl relative lg:text-4xl">
                        Layanan & Kegiatan
                    </h1>
                    <p class="md:text-xl">
                        Setelah perjalanan panjang dari Aceh hingga Papua, lahirlah visi dengan semangat perubahan yang diimpikan oleh jutaan rakyat: "Indonesia Adil Makmur untuk Semua."
                    </p>
                    <div class="flex gap-3">
                        <button id="prev" class="rounded-full bg-white p-2 mt-2">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                            >
                                <path fill="none" d="M0 0h24v24H0V0z" />
                                <path d="M15.61 7.41L14.2 6l-6 6 6 6 1.41-1.41L11.03 12l4.58-4.59z" />
                            </svg>
                        </button>
                        <button id="next" class="rounded-full bg-white p-2 mt-2">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                            >
                                <path fill="none" d="M0 0h24v24H0V0z" />
                                <path d="M10.02 6L8.61 7.41 13.19 12l-4.58 4.59L10.02 18l6-6-6-6z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div id="carousel" class="w-full px-10 overflow-x-auto no-scrollbar scroll-smooth my-auto">
                    <div id="content" class="flex space-x-8 h-[70vh]"> 
                        <div class="w-80 flex-shrink-0 bg-blue-700/40 backdrop-blur-lg px-4 py-5 rounded-3xl shadow-md">
                            <span class="material-symbols-outlined px-2 py-1 rounded-xl shadow-lg bg-white text-3xl text-blue-600 mb-4">folder_open</span>
                            <h2 class="font-semibold text-white text-xl">Administratif Warga</h2>
                            <p class="text-slate-200 text-[17px] text-justify">Membuat Aturan Tata tertib, Pendataan Warga Tetap dan Tidak Tetap, Pencatatan Pindah Alamat dan Kependudukan, Pencatatan Warga yang Meninggal Dunia, Membuat Agenda Lingkungan.</p>
                        </div>
                        <div class="w-80 flex-shrink-0 bg-blue-700/40 backdrop-blur-lg px-4 py-5 rounded-3xl shadow-md">
                            <span class="material-symbols-outlined px-2 py-1 rounded-xl shadow-lg bg-white text-3xl text-blue-600 mb-4">demography</span>
                            <h3 class="font-semibold text-white text-xl">Pelayanan Warga</h3>
                            <p class="text-slate-200 text-[17px] text-justify">Pengurusan Permintaan Surat Pengantar, Ubah Kartu Keluarga, Pengurusan Akta Kelahiran dan Kematian, Membuat Surat Keterangan Domisili, Membuat Surat Keterangan Ahli Waris, Sengketa Warga, dan lain-lain.</p>
                        </div>
                        <div class="w-80 flex-shrink-0 bg-blue-700/40 backdrop-blur-lg px-4 py-5 rounded-3xl shadow-md">
                            <span class="material-symbols-outlined px-2 py-1 rounded-xl shadow-lg bg-white text-3xl text-blue-600 mb-4">partner_exchange</span>
                            <h3 class="font-semibold text-white text-xl">Gotong Royong</h3>
                            <p class="text-slate-200 text-[17px] text-justify">Pelaksanaan Kerja Bakti Massal, Pembangunan dan Kebersihan, Perbaikan Saluran Air, Pemasangan Penerangan Lingkungan, Ketertiban dan Keamanan Lingkungan</p>
                        </div>
                        <div class="w-80 flex-shrink-0 bg-blue-700/40 backdrop-blur-lg px-4 py-5 rounded-3xl shadow-md">
                            <span class="material-symbols-outlined px-2 py-1 rounded-xl shadow-lg bg-white text-3xl text-blue-600 mb-4">partner_exchange</span>
                            <h3 class="font-semibold text-white text-xl">Gotong Royong</h3>
                            <p class="text-slate-200 text-[17px] text-justify">Pelaksanaan Kerja Bakti Massal, Pembangunan dan Kebersihan, Perbaikan Saluran Air, Pemasangan Penerangan Lingkungan, Ketertiban dan Keamanan Lingkungan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-20 lg:max-w-7xl lg:mx-auto">
            <div class="mx-5 md:mx-12 flex flex-col justify-between items-center md:mx-16 mb-12 sm:flex-row sm:gap-5">
                <div class="mb-7 sm:w-96">
                    <h1 class="font-semibold text-3xl font-afacad lg:text-4xl">Features</h1>
                    <p class="line-clamp-3 text-slate-600">Temukan berita dan kegiatan komunitas terkini di web Informasi RT dengan navigasi yang mudah dan cepat!</p>
                </div>
                <a href="#contact">
                    <button class="px-4 py-3 font-bold text-white bg-gradient-to-r from-cyan-400 to-blue-600 rounded-lg uppercase">Contact Us</button>
                </a>
            </div>
            <div class="mx-5 md:mx-12 sm:grid sm:grid-cols-2 md:grid-cols-3 md:mx-16 gap-12">
                <div class="mb-7">
                    <span class="material-symbols-outlined text-4xl bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text text-transparent">
                        inventory
                    </span>
                    <h2 class="text-2xl mb-2 font-semibold text-slate-800">Syarat & Prosedur</h2>
                    <p class="text-slate-800 line-clamp-3 text-justify">Mendapatkan info tata cara dalam proses pengurusan administrasi. Pilih menu "Syarat & Prosedur"</p>
                </div>
                <div class="mb-7">
                    <span class="material-symbols-outlined text-4xl bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text text-transparent">
                        diversity_3
                    </span>
                    <h2 class="text-2xl mb-2 font-semibold text-slate-800">Info Warga</h2>
                    <p class="text-slate-800 line-clamp-3 text-justify">Mendapatkan berita terbaru seputar lingkungan RT05/RW02. Pilih menu "Info Warga"</p>
                </div>
                <div class="mb-7">
                    <span class="material-symbols-outlined text-4xl bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text text-transparent">
                        bar_chart
                    </span>
                    <h2 class="text-2xl mb-2 font-semibold text-slate-800">Data & Laporan</h2>
                    <p class="text-slate-800 line-clamp-3 text-justify">Mendapatkan informasi data dan laporan dari pengurus RT05/RW02. Pilih menu "Data & Laporan"</p>
                </div>
                <div class="mb-7">
                    <span class="material-symbols-outlined text-4xl bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text text-transparent">
                        gallery_thumbnail
                    </span>
                    <h2 class="text-2xl mb-2 font-semibold text-slate-800">Galeri Kegiatan</h2>
                    <p class="text-slate-800 line-clamp-3 text-justify">Melihat dokumentasi kegiatan yang telah dilaksanakan di lingkungan RT05/RW02. Pilih menu "Galeri Kegiatan"</p>
                </div>
                <div class="">
                    <span class="material-symbols-outlined text-4xl bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text text-transparent">
                        perm_phone_msg
                    </span>
                    <h2 class="text-2xl mb-2 font-semibold text-slate-800">Hubungi Kami</h2>
                    <p class="text-slate-800 line-clamp-3 text-justify">Mendapatkan bantuan serta melakukan pelaporan seputar lingkungan RT05/RW02. Pilih menu "Hubungi Kami"</p>
                </div>
            </div>
        </div>
        <div class="pt-20 lg:max-w-7xl lg:mx-auto">
            <div class="mx-5 md:mx-12">
                <h1 id="syarat-prosedur" class="font-semibold text-2xl md:text-3xl font-afacad text-center lg:text-4xl capitalize">syarat dan prosedur pengurusan dokumen</h1>
                <div class="grid grid-cols-1 mt-5 gap-2 sm:grid-cols-2" id="accordion">
                    @foreach ($askedQuestions as $question)
                        <div class="item hover:shadow-lg hover:scale-105 transition-all rounded-lg overflow-hidden">
                            <div class="header p-6 bg-slate-200 font-bold flex justify-between items-center cursor-pointer rounded-lg">
                                <div>
                                    <h2>{{ $question->title }}</h2>
                                </div>
                                
                                <span class="activeIcon material-symbols-outlined">keyboard_arrow_down</span>
                                <span class="inactiveIcon material-symbols-outlined">keyboard_arrow_up</span>
                            </div>
                            <div class="content text-slate-500 transition-all duration-500" style="height: 0;">
                                <p class="mb-5">
                                    {!! $question->body !!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="/faqs">
                    <button class="block mx-auto mt-5 px-4 py-3 shadow-md active:scale-[0.95] hover:scale-[1.05] transition-all text-white font-semibold bg-gradient-to-r from-cyan-400 to-blue-600 rounded-lg uppercase">Selengkapnya</button>
                </a>
            </div>
        </div>
        <div class="pt-20 lg:max-w-7xl lg:mx-auto">
            <div class="mx-5 md:mx-12">
                <h1 id="gallery-kegiatan" class="text-2xl md:text-3xl font-bold font-afacad text-center mb-3 bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text text-transparent lg:text-4xl">
                    <span class="material-symbols-outlined animate-spin bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text">
                        camera
                    </span>
                    Galeri Kegiatan
                    <span class="material-symbols-outlined animate-spin bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text">
                        camera
                    </span>
                </h1>
                <p class="text-center">Potret kebersamaan dalam galeri kegiatan masyarakat. 📷✨ #GotongRoyong</p>
                <div class="my-7 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @include('components/card-image', [
                        "data" => $galleryActivities[0],
                    ])
                    <div class="sm:row-span-2 lg:row-span-3">
                        <a href="/post/gallery/{{ $galleryActivities[1]->slug }}" class="block relative z-10 card-hover rounded-2xl overflow-hidden mb-3">
                            <div class="bg-gradient-to-b from-slate-400 to-slate-900 h-96 md:h-[84vh]">
                                <img src="{{ getImage($galleryActivities[1]) }}" alt="" class="mix-blend-overlay w-full h-full object-cover">
                            </div>
                            <div class="absolute bottom-0 mb-5 mx-5 text-white">
                                <h2 class="text-2xl font-afacad font-semibold mb-4 line-clamp-2">
                                    {{ $galleryActivities[1]->title }}
                                </h2>
                                <p class="line-clamp-2">
                                    {{ strip_tags($galleryActivities[1]->body) }}
                                </p>
                            </div>
                        </a>
                        <a href="/post/gallery/{{ $galleryActivities[2]->slug }}" class="block relative card-hover rounded-2xl overflow-hidden">
                            <div class="bg-gradient-to-b from-slate-400 to-slate-900 h-96 md:h-[70vh]">
                                <img src="{{ getImage($galleryActivities[2]) }}" alt="" class="mix-blend-overlay w-full h-full object-cover">
                            </div>
                            <div class="absolute bottom-0 mb-5 mx-5 text-white">
                                <h2 class="text-2xl font-afacad font-semibold mb-4 line-clamp-2">
                                    {{ $galleryActivities[2]->title }}
                                </h2>
                                <p class="line-clamp-2">
                                    {{ strip_tags($galleryActivities[2]->body) }}
                                </p>
                            </div>
                        </a>
                    </div>
                    @foreach ($galleryActivities->skip(3) as $galleryActivity)
                        @include('components/card-image', [
                            "data" => $galleryActivity,
                            "className" => ($loop->last)? '' : ''
                        ])
                    @endforeach
                </div>
                <a href="/posts/gallery">
                    <button class="block mx-auto mt-5 px-4 py-3 shadow-md active:scale-[0.95] hover:scale-[1.05] transition-all text-white font-semibold bg-gradient-to-r from-cyan-400 to-blue-600 rounded-lg uppercase">Selengkapnya</button>
                </a>
            </div>
        </div>
        <div class="pt-20 lg:mx-auto">
            <div class="mx-2 py-5 h-52 bg-gradient-to-r from-cyan-400 to-blue-600 rounded-2xl relative">
                <h1 id="data-laporan" class="text-3xl font-bold font-afacad text-white text-center lg:text-4xl">Data & Laporan</h1>
                <img src="https://source.unsplash.com/1000x600?indonesia" alt="" class="w-full h-full absolute top-0 object-cover object-bottom mix-blend-soft-light opacity-75">
            </div>
            <div class="lg:mx-36 -translate-y-32 mx-12 px-5">
                <table id="report" class="display responsive nowrap bg-slate-100 rounded-2xl overflow-hidden mt-4" width="100%">
                    <thead>
                        <tr>
                            <th class="bg-slate-300/75 text-black backdrop-blur-md">Data & Laporan</th>
                            <th class="bg-slate-300/75 text-black backdrop-blur-md">Tanggal</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="lg:max-w-7xl lg:mx-auto">
            <div class="text-center">
                <h1 id="info-warga" class="text-3xl font-afacad font-bold text-center mb-3 bg-gradient-to-l from-cyan-400 to-blue-600 bg-clip-text text-transparent lg:text-4xl">Berita Terkini</h1>
                <span class="inline-block mx-auto after:absolute after:border-[2px] after:-right-14 after:top-3 after:border-blue-400 after:w-10 before:absolute before:border-[2px] before:-left-14 before:top-3 before:border-blue-400 before:w-10 relative">
                    <span class="material-symbols-outlined text-3xl text-blue-600 animate-showUpIcon">breaking_news</span>
                </span>
            </div>
            <div class="mx-auto lg:px-5 mt-5">
                <div class="flex flex-wrap lg:grid lg:grid-cols-4 justify-center gap-4 items-center">
                    @foreach ($blogs as $blog)
                        <a href="/post/blog/{{ $blog->slug }}">
                            <div class="max-w-[18rem] sm:max-w-[22rem] mb-12 transition-all hover:scale-[1.02]">
                                <div class="h-56 bg-red-200">
                                    <img src="{{ getImage($blog) }}" alt="" class="w-full h-full rounded-lg shadow-lg object-cover object-top">
                                </div>
                                <div class="flex justify-between flex-col items-start h-40 rounded-2xl pb-5">
                                    <span>
                                        <h2 class="min-h-[4rem] mt-3 mb-0 font-semibold text-slate-800 text-2xl font-afacad line-clamp-2 capitalize">
                                            {{ $blog->title }}
                                        </h2>
                                        <p class="min-h-[4.5rem] text-justify line-clamp-3 font-sans-serif">
                                            {{ strip_tags($blog->body) }}
                                        </p>
                                    </span>
                                    <button class="font-semibold font-afacad text-blue-500 text-xl mt-2 mb-0 flex items-center justify-between w-full">Baca Selengkapnya
                                        <span class="activeIcon material-symbols-outlined">keyboard_arrow_right</span>
                                    </button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <a href="/posts/blog">
                <button class="block mx-auto mt-5 px-4 py-3 shadow-md active:scale-[0.95] hover:scale-[1.05] transition-all text-white font-semibold bg-gradient-to-r from-cyan-400 to-blue-600 rounded-lg uppercase">Selengkapnya</button>
            </a>
        </div>
        <div id="contact" class="mt-20 pb-20 lg:max-w-7xl lg:mx-auto flex flex-col md:flex-row justify-center gap-3">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.077714847132!2d106.94027197480351!3d-6.2534912937349745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698ce2118760c3%3A0x38ecc86d284b2a58!2sJl.%20H.%20Namat%20No.RT%20002%2C%20RT.002%2FRW.002%2C%20Jatibening%20Baru%2C%20Kec.%20Pd.%20Gede%2C%20Kota%20Bks%2C%20Jawa%20Barat%2017412!5e0!3m2!1sid!2sid!4v1704603836555!5m2!1sid!2sid" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
                class="w-3/4 max-h-[70vh]"
            ></iframe>
            <div class="mx-8 sm:mx-auto sm:w-3/4 lg:w-[115vh]">
                <blockquote class="block text-center font-bold font-afacad text-3xl mb-2 lg:text-4xl">Butuh Bantuan <span class="inline-block animate-bounce">?</span></blockquote>
                <p class="after:content-['”'] before:content-['”'] md:w-2/3 mx-auto text-center">
                    Terkendala atau pertanyaan? Jangan ragu untuk menghubungi kami. Kami di sini untuk membantu 📧📞
                </p>
                <div class="mb-4 mt-7 px-4">
                    <form action="" class="grid gap-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="fullName" class="block">Nama Lengkap <span class="text-red-800">*</span></label>
                                <input type="text" name="fullName" id="fullName" class="w-full shadow-sm border-2 border-slate-200 rounded-md h-10 px-2 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-500 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer" placeholder="masukan nama kamu ..." required>
                            </div>
                            <div>
                                <label for="email" class="block ">Email <span class="text-red-800">*</span></label>
                                <input type="email" name="email" id="email" class="w-full shadow-sm rounded-md h-10 px-2 py-2 border-2 border-slate-200 block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-red-500 invalid:focus:ring-red-700 invalid:focus:border-red-700 peer" placeholder="masukan email.." required>
                            </div>
                        </div>
                        <div>
                            <label for="description" class="block">Apa yang bisa dibantu ?</label>
                            <textarea name="description" id="description" cols="50" rows="8" class="w-full border-2 border-slate-200 shadow-sm rounded-md py-2 px-2" placeholder="?? ....."></textarea>
                        </div>
                        <button class="block mx-auto mt-5 px-4 py-3 shadow-md active:scale-[0.95] hover:scale-[1.05] transition-all text-white font-semibold bg-gradient-to-r from-cyan-400 to-blue-600 rounded-lg uppercase">
                            📩 Kirim
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function counterAnimate(item, total, targetClass) {
                const targetElement = document.querySelectorAll(targetClass)[item];
                let upTo = 0
                let counts = setInterval(updated, 20);
                function updated() {
                    targetElement.innerHTML = ++upTo
                    if (upTo == total) {
                        console.log('clear');
                        clearInterval(counts)
                    }
                }
        }
        document.addEventListener('DOMContentLoaded', (e) => {
            counterAnimate(0, {{ $censusPopulation->male ?? 1 }}, '.counter')
            counterAnimate(1, {{ $censusPopulation->female ?? 1 }}, '.counter')
            counterAnimate(2, {{ $censusPopulation->total_population ?? 1 }}, '.counter')
            counterAnimate(3, {{ $censusPopulation->total_family ?? 1 }}, '.counter')
        })
    </script>
@endsection

@section('footer')
    @include('components/footer-landing')
@endsection

@section('scripts')
    
<script>
    let documents = []
    async function getAllDocuments() {
        const response = await fetch("/api/documents");
        const rawData = await response.json();
        
        const filterDocuments = rawData.map((document, index) => {
            const data = [];
            let newIndicator = ''
            if (index == 0) {
                newIndicator = `after:absolute after:content-['new'] after:-right-10 after:text-xs after:font-bold after:text-red-700 after:bg-white relative`
            }
            data.push(`
                <a href="/post/document/${document.slug}" class="text-blue-800 hover:underline ${newIndicator}">
                    ${document.title}
                </a>`)
            const isoDate = new Date(document.created_at);

            // Menggunakan metode toLocaleDateString untuk mendapatkan format tanggal yang dapat dipahami
            const dateHumanReadable = isoDate.toLocaleDateString();
            const timeHumanReadable = isoDate.toLocaleTimeString();
            data.push(dateHumanReadable + '-' + timeHumanReadable)
            return data
        });

        // Menggunakan metode sort dengan fungsi pembanding compareDates
        // const newestDocuments = filterDocuments.sort((a, b) => a[1].localeCompare(b[1])).reverse();
        const dataTable = new DataTable('#report', {
            data: filterDocuments,
            responsive: {
                details: false
            },
            searching: false,
            aoColumns: [
                { "sWidth": "95px", "sClass": " font-sans-serif text-center" },
                { "sWidth": "95px", "sClass": " font-sans-serif text-center" },
            ],
            order: [[1, 'desc']],  
        });
        return rawData;
    }
    getAllDocuments();
</script>
<script> 
    const gap = 16;

    const carousel = document.getElementById("carousel"),
    contentData = document.getElementById("content"),
    next = document.getElementById("next"),
    prev = document.getElementById("prev");

    next.addEventListener("click", e => {
        carousel.scrollBy(width + gap, 0);
        if (carousel.scrollWidth !== 0) {
            prev.style.display = "flex";
        }
        if (contentData.scrollWidth - width - gap <= carousel.scrollLeft + width) {
            next.style.display = "none";
        }
    });
    prev.addEventListener("click", e => {
        carousel.scrollBy(-(width + gap), 0);
        if (carousel.scrollLeft - width - gap <= 0) {
            prev.style.display = "none";
        }
        if (!contentData.scrollWidth - width - gap <= carousel.scrollLeft + width) {
            next.style.display = "flex";
        }
    });

    let width = carousel.offsetWidth;
    window.addEventListener("resize", e => (width = carousel.offsetWidth));
</script>
@endsection
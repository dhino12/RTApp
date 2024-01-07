@extends('layouts/main')

@section('header')
    <div class="w-full">
        <div
            class="absolute -z-10 w-full top-0 h-96 overflow-hidden"
        >
            <div class="w-full h-full bg-gradient-to-r from-cyan-700 to-blue-800 relative">
                <img src="https://source.unsplash.com/1000x600?indonesia" alt="" class="w-full h-full mix-blend-overlay object-cover object-top">
            </div>
            <div class="w-full absolute bottom-0 start-0 end-0" style="transform: scale(2);transform-origin: top center;color: #fff;">
                <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>
        @include('components/navbar', [
            "className" => "relative container mt-5 mx-auto p-4 px-10 fill-white sm:px-[20vh] flex flex-col justify-between text-slate-200 transition-all duration-200 lg:flex-row lg:items-center"
        ])
        
        <div class="my-20 w-2/3 mx-auto text-center text-white">
            <p class="font-inter font-semibold">
                Data & Document
            </p>
            <h1 class="font-bold text-3xl mb-4">{{ $gallery->title }}</h1>
            <p class="font-inter font-semibold">
                By: 
                <b><a href="/posts?author={{ $gallery->author->username }}">{{ $gallery->author->name }}</a></b>
            </p>
            <p class="font-medium">{{ $gallery->created_at->diffForHumans() }}</p>
        </div>
    </div>
@endsection

@section('container')
<div class="bg-gradient-to-b from-transparent z-20 via-slate-100 via-20% to-slate-100">
    <div class="mt-52 mx-10 sm:w-3/4 sm:mx-auto">
        <div class="lg:w-3/4 mx-auto text-black text-sm md:text-[17px] leading-7 font-sans-serif">
            <p class="">
                {{-- {!! $gallery->body !!} --}}
                {!!  $gallery->body  !!}
            </p>
        </div>
    </div>

    <div class="container w-64 pb-5 flex justify-between mx-auto lg:w-96 mt-20 items-center">
        @if($prev)
        <a href="{{ $prev->slug }}">
            <span class="material-symbols-outlined text-2xl px-3 py-2 rounded-full shadow-lg bg-gradient-to-r from-cyan-400 to-blue-600 text-white active:scale-[0.95] hover:scale-[1.05] transition-all">
                arrow_back_ios_new
            </span>
        </a>
        @endif
        <a href="/" class="block mx-auto px-4 py-3 shadow-md active:scale-[0.95] hover:scale-[1.05] transition-all text-white font-semibold bg-gradient-to-r from-cyan-400 to-blue-600 rounded-lg uppercase">
            Home
        </a>
        @if($next)
        <a href="{{ $next->slug }}">
            <span class="material-symbols-outlined text-2xl px-3 py-2 rounded-full shadow-lg bg-gradient-to-r from-cyan-400 to-blue-600 text-white active:scale-[0.95] hover:scale-[1.05] transition-all">
                arrow_forward_ios
            </span>
        </a>
        @endif
    </div>
    <script>
    // Ambil semua elemen figure di dalam konten Trix Editor
    const figureElements = document.querySelectorAll('figure');
    const getIframes = document.querySelectorAll('figure[data-trix-content-type="application/pdf"] iframe')

    // Iterasi melalui setiap elemen figure
    figureElements.forEach((figureElement) => {
        // Ambil data lampiran dari elemen figure
        const attachmentData = JSON.parse(figureElement.getAttribute('data-trix-attachment'));
        console.log(attachmentData);
        const note = document.createElement('p');
        note.innerText = "pastikan mematikan IDM / Downloader sejenis untuk dapat mereview PDF tanpa download";
        note.setAttribute('class', 'text-center text-blue-500 font-semibold mt-2 capitalize')

        if (attachmentData.contentType == 'application/pdf') {
            figureElement.parentNode.appendChild(note)
            figureElement.querySelector('iframe').className="w-full h-[90vh]"
            // getIframes.forEach(getIframe => getIframe.className="w-full h-[90vh]")
        }
    });
    </script>
</div>
@endsection

@section('footer')
    @include('components/footer-wave')
@endsection
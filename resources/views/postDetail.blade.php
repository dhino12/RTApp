@extends('layouts/main')

@section('header')
    <div class="w-full">
        <div
            class="absolute z-10 w-full top-0 bg-gradient-to-b from-[#141727] to-[#3a416f] h-96 overflow-hidden"
        >
            <div class="h-72"></div>
        </div>
        @include('components/navbar', [
            "className" => "relative container z-20 mt-5 mx-auto p-4 px-10 fill-white sm:px-[20vh] flex flex-col justify-between text-slate-200 transition-all duration-200 lg:flex-row lg:items-center"
        ])
    </div>
@endsection

@section('container')
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
<div class="bg-slate-100">
    <img
        src="{{ getImage($gallery) }}"
        alt=""
        class="relative z-20 mx-auto h-[65vh] w-4/5 mt-5 rounded-3xl overflow-hidden object-cover object-center"
    />

    <div class="mt-8 mx-10 sm:w-3/4 sm:mx-auto">
        <h4 class="font-semibold text-center text-lg text-blue-600">
            <a href="/posts?category={{ $gallery->category->slug }}">{{ $gallery->category->title }}</a>
        </h4>
        <h1 id="title" class="sm:w-2/3 sm:mx-auto text-3xl font-bold text-center capitalize my-3 bg-gradient-to-l from-cyan-400 to-blue-600 bg-clip-text text-transparent">
            {{ $gallery->title }}
        </h1>
        <div class="flex mx-auto justify-center gap-5 mb-3">
            <p>By:
                <b><a href="/posts?author={{ $gallery->author->username }}">{{ $gallery->author->name }}</a></b>, 
            </p>
            <p class="font-medium">{{ $gallery->created_at->diffForHumans() }}</p>
        </div>
        <div id="body" class="lg:w-3/4 mx-auto text-black text-sm md:text-[18px] tracking-wide leading-7 font-sans-serif">
            <p class="">
                {{-- {!! $gallery->body !!} --}}
                {!!  $gallery->body  !!}
            </p>
        </div>
    </div>

    <!---Modal --> 
    <div id="modal" class="fixed z-10 hidden top-0 bottom-0 insert-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <article class="relative top-5 mx-auto p-5 border shadow-lg rounded-md bg-slate-200 w-fit">
            <embed src="" alt="" class="w-full object-contain h-[80vh] rounded-md lg:max-w-[140vh] lg:min-w-[140vh]">
            <div class="mt-3 text-center text-slate-800">
                <h1>Hello World</h1>
                <p class="text-lg md:max-w-[80vh] mx-auto">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, voluptatem.</p>
            </div>
            {{-- <div class="nav-slider absolute top-[40%] w-full flex justify-between">
                <button class="rounded-full text-slate-800 bg-white p-2">next</button>
                <button class="rounded-full text-slate-800 bg-white p-2">prev</button>
            </div>  --}}
        </article>
    </div>

    <div class="p-5 sm:p-8 mt-8 md:mx-16 mx-auto">
        <div id="open-btn" class="columns-1 gap-5 sm:columns-1 md:columns-2 sm:gap-8 lg:columns-2 2xl:columns-sm [&>img:not(:first-child)]:mt-8">
            @foreach ($gallery->images as $image)
                <article class="mb-4 rounded-lg overflow-hidden card-hover shadow-md shadow-gray-400 relative">
                    <embed src="/images/{{ $image->name }}" autoplay=0 class="max-w-[100vh] h-full min-h-[55vh] max-h-[85vh] w-full object-cover object-center"/>
                    <div class="absolute bottom-0 bg-gradient-to-b from-slate-400/10 to-slate-900/80 w-full min-h-20 p-4 text-white">
                        <h2 class="font-bold text-xl">
                            {{ $image->title }}
                        </h2>
                        <p class="line-clamp-2">
                            {!! $image->description !!}
                        </p>
                    </div>
                </article>
            @endforeach
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

    // Iterasi melalui setiap elemen figure
    figureElements.forEach((figureElement) => {
        // Ambil data lampiran dari elemen figure
        const attachmentData = JSON.parse(figureElement.getAttribute('data-trix-attachment'));
        console.log(attachmentData.href += "#toolbar=0");
        const note = document.createElement('p');
        note.innerText = "pastikan mematikan IDM / Downloader sejenis untuk dapat mereview PDF tanpa download";
        note.setAttribute('class', 'text-center text-blue-500 font-semibold mt-2 capitalize')

        if (attachmentData.contentType == 'application/pdf') {
            figureElement.parentNode.appendChild(note)
        }
    });
    </script>
    
    <script>
        // modal
        let modal = document.getElementById('modal');
        let btn = document.getElementById('open-btn');
        let button = document.getElementById('ok-btn');
        const embedHtml = '<embed src="" alt="" class="w-full object-contain h-[80vh] rounded-md lg:max-w-[140vh] lg:min-w-[140vh]">'
        
        document.addEventListener('DOMContentLoaded', () => {
            btn.addEventListener('click', (e) => {
                if (!e.target.closest('.card-hover')) return
                const parrentNode = e.target.closest('.card-hover')
                const imgSrc = parrentNode.querySelector('embed').src
                const title = parrentNode.querySelector('h2').innerText
                const description = parrentNode.querySelector('p').innerText
                modal.querySelector('embed').src = imgSrc
                modal.querySelector('h1').innerText = title
                modal.querySelector('p').innerText = description
                modal.style.display = 'block';
            })
        })
        
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
                modal.querySelector('#modal embed').remove()
                modal.querySelector('#modal article div:first-child')
                    .insertAdjacentHTML('beforeBegin', embedHtml)
            }
        }    
    </script>
</div>
@endsection

@section('footer')
    @include('components/footer-wave')
@endsection
@php
    $pattern = '/&quot;url&quot;:&quot;([^&]*)&quot;/';
    preg_match($pattern, $data->body, $bodyImageMatch);
    $bodyImageMatch = count($bodyImageMatch) == 0 ? 'https://source.unsplash.com/1000x600?football' : $bodyImageMatch[1];
    $galleryImages = count($data->images) == 0 ? false : '/images/' . $data->images[0]->name;
    $image = $galleryImages ?: $bodyImageMatch ;
@endphp
<a href="/post/gallery/{{ $data->slug }}" class="{{ $className ?? '' }} block relative card-hover rounded-2xl overflow-hidden md:min-h-[50vh]">
    <div class="bg-gradient-to-b from-slate-400 to-slate-900 h-96 md:h-full">
        <img src="{{ $image }}" alt="" class="mix-blend-overlay w-full h-full object-cover">
    </div>
    <div class="absolute bottom-0 mb-5 mx-5 text-white">
        <h2 class="text-2xl font-afacad font-semibold mb-4 line-clamp-2">{{ $data->title }}</h2>
        <p class="line-clamp-2">{{ strip_tags($data->body) }}</p>
    </div>
</a>
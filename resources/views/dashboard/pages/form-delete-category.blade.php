@extends('dashboard/layouts/main')

@section('container')
<div class="w-full px-6 py-6 mx-auto">
    
    <!-- breadcrumb -->
    @include('dashboard/components/navbar')
    <!-- cards row 4 -->
    <div class="flex flex-col -mx-3 gap-5">
        <div class="flex-1 px-5 md:w-2/3 mx-auto mt-5"> 
            <div id="profile" class="flex flex-col gap-5 p-5 mb-8 bg-white shadow-xl shadow-slate-100 rounded-xl">
                <h1 class="font-bold text-xl tracking-normal">Delete Category: {{ $post->title }}</h1>
                <p>Sebelum delete, perlu diperhatikan ada beberapa postingan yang terkait dengan category ini</p>
                <div class="bg-orange-200 border border-orange-400 text-green-800 px-4 py-3 rounded relative mb-5" role="alert">
                    <strong class="font-bold">Peringatan: </strong>
                    <p>Pastikan sudah memindahkan semua postingan terkait dengan categori ini, ke categori lainnya</p>
                </div>
                @if(session()->has('error'))
                    <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded relative mb-5" role="alert">
                        <strong class="font-bold">Failed: </strong>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ Request::getRequestUri() }}" method="post" class="inline-block">
                    @method("delete")
                    @csrf
                    <span class="w-full">
                        <label for="body" class="block font-bold text-black text-sm">Yakin Delete ?</label>
                        @if (count($gallery) != 0 || count($blogs) != 0)
                        <button 
                            class="my-2 bg-gradient-to-tl from-gray-600 to-black-400 px-2.5 text-sm rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white transition-all active:scale-[0.95] hover:scale-[1.05]"
                            onclick="return confirm('yakin delete ?')"
                            disabled
                        >
                            Delete
                        </button>
                        @else
                        <button
                            class="my-2 bg-gradient-to-tl from-red-600 to-red-400 px-2.5 text-sm rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white transition-all active:scale-[0.95] hover:scale-[1.05]"
                            onclick="return confirm('yakin delete ?')"
                        >
                            Delete
                        </button>
                        @endif
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <a href="/dashboard/categories" class="my-2 bg-gradient-to-tl from-gray-600 to-black-400 px-2.5 text-sm rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white transition-all active:scale-[0.95] hover:scale-[1.05]">
                            Cancle
                        </a>
                    </span>
                </form>
            </div>
        </div>
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Blogs Table</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                @include('dashboard/components/table', [
                    "theads" => ["Author", "Title", "Category", "Dibuat"],
                    "posts" => $blogs,
                ])
            </div>
        </div>
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Gallery Table</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                @include('dashboard/components/table', [
                    "theads" => ["Author", "Title", "Category", "Dibuat"],
                    "posts" => $gallery,
                ])
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function previewImage() {
        const image = document.querySelector("#image");
        const imgPreview = document.querySelector(".img-preview");

        imgPreview.style.display = "block";
        const offReader = new FileReader();
        offReader.readAsDataURL(image.files[0]);

        offReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection
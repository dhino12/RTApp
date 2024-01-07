@extends('dashboard/layouts/main')

@section('container')
<div class="w-full px-6 py-6 mx-auto">
    
    <!-- breadcrumb -->
    @include('dashboard/components/navbar')
    <!-- cards row 4 -->
    <div class="flex-1 px-5 md:w-2/3 mx-auto mt-5"> 
        <div id="profile" class="flex flex-col gap-5 p-5 mb-8 bg-white text-slate-800 font-medium shadow-xl shadow-slate-100 rounded-xl">
            <h1 class="font-bold text-xl tracking-normal">About RT 02/02</h1>
            <p>Tuliskan visi / misi, dan bagaimana keadaan lingkungan di RT02 jelaskan secara singkat, form ini hanya terlihat oleh admin / superadmin</p>
            <p>Terakhir di modifikasi oleh: <b>{{ $about->author[0]->name }}</b> (admin)</p>
            @if(session()->has('success'))
                <div class="bg-lime-100 border border-green-400 text-green-800 px-4 py-3 rounded relative mb-5" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="/dashboard/about/{{ $about->id }}" enctype="multipart/form-data" method="post" class="flex justify-center flex-col my-5 gap-5 w-full">
                @method('put')
                @csrf
                <span class="w-full">
                    <label for="body" class="font-bold text-black text-sm">Tentang RT002</label>
                    <textarea 
                        type="text" 
                        name="description" 
                        class="w-full mt-2 rounded-md px-2 py-2 border-2 border-slate-200 block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-red-500 invalid:focus:ring-red-700 invalid:focus:border-red-700 peer"
                        id="body" 
                        rows="2"
                        placeholder="Tentang RT002, lingkungan, atau kegiatan, dll"
                        required
                    >{{ old('description', $about->description) }}</textarea>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </span>
                <span class="w-full">
                    <label for="visi" class="font-bold text-black text-sm">Visi</label>
                    <textarea 
                        type="text"
                        name="visi"
                        id="visi"
                        rows="8"
                        placeholder="masukan visi"
                        class="w-full mt-2 rounded-md px-2 py-2 border-2 border-slate-200 block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-red-500 invalid:focus:ring-red-700 invalid:focus:border-red-700 peer"
                        required
                    >{{ old('visi', $about->visi) }}</textarea>
                    @error('visi')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </span>
                <span class="w-full">
                    <label for="misi" class="font-bold text-black text-sm">Misi</label>
                    <input 
                        type="hidden"
                        name="misi"
                        id="misi"
                        value="{{ old('misi', $about->misi) }}"
                        placeholder="masukan misi"
                        required
                    >
                    <trix-editor input="misi" placeholder="masukan visi"></trix-editor>
                </span>
                <span class="w-full">
                    <label for="image" class="form-label">Image Image</label>
                    <img alt="" src="{{ $about->path_image }}" class="img-preview my-2 md:h-full card-hover rounded-2xl sm:bg-red-200 md:max-h-[50vh] shadow-lg shadow-slate-300">
                    <input
                        class="w-full block mt-8 @error('image') @enderror"
                        type="file"
                        id="image" 
                        name="image"
                        onchange="previewImage()"
                        accept="image/png,image/jpg,image/jpeg"
                    >
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </span>
                <div class="mt-5"> 
                    <button type="submit" class="bg-gradient-to-l from-cyan-400 to-blue-600 px-4 py-2 mt-3 rounded-lg font-semibold text-white active:scale-[0.95] hover:scale-[1.05] transition-all lg:mt-0">
                        Simpan
                    </button>
                </div>
            </form>
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
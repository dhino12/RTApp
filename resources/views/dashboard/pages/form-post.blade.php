@extends('dashboard/layouts/main')

@section('container')
<div class="w-full py-6 mx-auto">
    
    <!-- breadcrumb -->
    <div class="px-6">
        @include('dashboard/components/navbar')
    </div>
    
    <!-- cards row 4 -->
    <div class="px-6 py-7 my-10 shadow-soft-sm lg:w-9/12 mx-10 md:mx-auto rounded-xl bg-white">
        <h1 class="text-xl font-bold font-sans-serif capitalize">Tambah {{ request()->segment(2) }}</h1>
        <p>Form Tambah {{ request()->segment(2) }}</p>
        <form action="{{ str_replace('/create', '', Request::getRequestUri()) }}" method="post" enctype="multipart/form-data" class="flex justify-center flex-col my-5 gap-5 w-full">
            @csrf
            <div class="flex gap-5">
                <div class="w-full">
                    <label for="title" class="font-semibold">Title <span class="text-red-500 font-bold">*</span></label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        class="w-full mt-2 rounded-md h-10 px-2 py-2 border-2 border-slate-200 block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-red-500 invalid:focus:ring-red-700 invalid:focus:border-red-700 peer" 
                        placeholder="Judul"
                        required
                        value="{{ old('title') }}"
                    >
                    @error('title')
                        <div class="text-red-500 font-bold">
                            {{ $message }}
                        </div>
                    @enderror
                    <input 
                        type="text" 
                        name="slug" 
                        id="slug" 
                        class="w-full invisible"
                        value="{{ old('slug') }}"
                        placeholder="Slug" 
                        alt="slug"
                        required 
                        readonly
                    >
                    @error('slug')
                        <div class="text-red-500 font-bold">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div>
                <label for="category_id" class="font-semibold">Category <span class="text-red-500 font-bold">*</label>
                <span class="text-red-500 block">Tolong isikan category, agar postingan rapih terkelompok</span>
                <select name="category_id" id="category_id" class="w-full choice" placeholder="Category" required></select>
                @error('category_id')
                    <div class="text-red-500 font-bold">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="body" class="font-semibold">Description</label>
                <input
                    type="hidden"
                    name="body" 
                    id="body" 
                    placeholder="masukan konten deskripsi"
                    value="{{ old('body') }}"
                    class="w-full mt-2 rounded-md h-10 px-2 py-2 border-2 border-slate-200 block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-red-500 invalid:focus:ring-red-700 invalid:focus:border-red-700 peer"
                >
                <trix-editor input="body" placeholder="masukan konten deskripsi"></trix-editor>
                @error('body')
                    <div class="text-red-500 font-bold">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="images" class="font-semibold">Gambar Files</label>
                <div class="text-red-500 text-sm font-semibold">
                    Max file upload: <b>50MB</b>
                </div>
                <input
                    type="file" 
                    class="filepond"
                    name="images"
                    multiple
                >
            </div>
            <div class="mx-auto mt-10 w-fit">
                <button type="reset" class="bg-slate-200 px-7 py-2 rounded-lg font-semibold shadow-soft-xs mt-3 active:scale-[0.95] hover:scale-[1.05] transition-all lg:mt-0 mx-5">
                    Batal
                </button>
                <button type="submit" id="submit" class="capitalize bg-gradient-to-l from-cyan-400 to-blue-600 px-4 py-2 rounded-lg font-semibold text-white mt-3 active:scale-[0.95] hover:scale-[1.05] transition-all lg:mt-0">
                    Tambah {{ request()->segment(2) }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<!-- Drag & Drop Files Config  -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="/js/attachmentTrixEditor.js"></script>
<script> 
    function getCategories() {
        const categories = fetch(`http://127.0.0.1:8000/api/categories`)
            .then(response => response.json())
            .then(dataArray => {
                const element = document.querySelector('.choice');
                const choices = new Choices(element, {
                    removeItems: true,
                    removeItemButton: true,
                    placeholder: true,
                    maxItemCount: 1,
                    items: ['hello', 'world'],
                    choices: dataArray.map(item => ({ value: item.id, label: item.title })),
                    searchPlaceholderValue: "Cari kategori disini",
                    allowHTML: false,
                    sorter: (a,b) => {},
                    addItemText: (value) => {
                        if (dataArray.includes(value)) {
                            // Jika ada, izinkan penambahan
                            return `Tekan enter untuk tambah <b>"${value}"</b>`;
                        } else {
                            // Jika tidak ada, berikan pesan kustom
                            return `Hanya dapat memilih dari opsi yang ada`;
                        }
                    },
                    placeholderValue: 'Isikan kategori',
                    classNames: { 
                        containerInner: 'border-2',
                    }
                });
            })
            .catch(error => console.error(error));
        return categories;
    }
    getCategories()

    window.addEventListener('beforeunload', function (event) {
        return confirmationMessage;
    });
    
    window.addEventListener('load', function (event) {
        // delete tmp
        console.log('adaada');
        fetch('/delete-tmp', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                username: '{{ auth()->user()->username }}'
            })
        })
            .then(response => response.json())
            .then(data => console.log(data))
    });
</script>
<script>
    // We want to preview images, so we register
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginFileValidateSize,
        FilePondPluginFileValidateType
    );

    // create() to turn it into a pond
    const inputElement = document.querySelector('input[type="file"]');
    const pond = FilePond.create(inputElement, {
        allowFileSizeValidation: true,
        labelMaxFileSizeExceeded: 'File terlalu besar',
        maxFileSize: '50MB',
        acceptedFileTypes: ['image/png',"image/gif","image/jpeg"],
    });
    FilePond.setOptions({
        server: {
            process: '/upload',
            revert: '/delete',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    })

    // How to use with Pintura Image Editor:
    // https://pqina.nl/pintura/docs/latest/getting-started/installation/filepond/
</script>
<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function() {
        fetch('/api/blogs/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    })
</script>
<script> 
</script>
@endsection
@extends('dashboard/layouts/main')

@section('container')
<div class="w-full py-6 mx-auto">
    
    <!-- breadcrumb -->
    <div class="px-6">
        @include('dashboard/components/navbar')
    </div>
    <!-- cards row 4 -->
    <div class="mx-10 px-6 py-7 my-10 shadow-soft-sm lg:w-9/12 mx-10 lg:mx-auto rounded-xl bg-white">
        @if(session()->has('success'))
            <div class="bg-lime-100 border border-green-400 text-green-800 px-4 py-3 rounded relative mb-5" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1 class="text-xl font-bold font-sans-serif capitalize">Edit {{ request()->segment(2) }}</h1>
        <p>Form Edit {{ request()->segment(2) }}</p>
        <form action="{{ str_replace('/edit', '', Request::getRequestUri()) }}" method="post" enctype="multipart/form-data" class="flex justify-center flex-col my-5 gap-5 w-full">
            @method('put')
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
                        value="{{ old('title', $post->title) }}"
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
                        value="{{ old('slug', $post->slug) }}"
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
                <select name="category_id" id="category_id" class="w-full choice" placeholder="Category" required>
                    @if (old('category_id') == $post->category->id)
                        <option value="{{ $post->category->id }}" selected>{{ $post->category->title }}</option>
                    @endif
                </select>
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
                    value="{{ old('body', $post->body) }}"
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
            <div class="flex gap-5 flex-col md:flex-row items-center mt-10 w-full">
                <a href="/dashboard/{{ request()->segment(2) }}"class="bg-slate-200 px-7 py-2 rounded-lg font-semibold shadow-soft-xs active:scale-[0.95] hover:scale-[1.05] transition-all lg:mt-0">
                    Batal
                </a>
                <button type="submit" id="submit" class="capitalize bg-gradient-to-l from-cyan-400 to-blue-600 px-4 py-2 rounded-lg font-semibold text-white active:scale-[0.95] hover:scale-[1.05] transition-all lg:mt-0">
                    Edit {{ request()->segment(2) }}
                </button>
            </div>
        </form>
    </div>

    <!-- Card Image  -->
    <div class="mt-10 mx-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        @foreach($post->images as $image)
        <article class="relative">
            <div class="absolute top-3 right-3 z-10">
                <button data-action="edit" class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-sm rounded-1.8 py-1.4 font-bold uppercase text-white transition-all active:scale-[0.95] hover:scale-[1.05] hover:cursor-pointer">
                    Edit
                </button>
                <form action="/delete-file?id={{ $image->id }}" method="POST" class="inline-block">
                    @method("delete")
                    @csrf
                    <input type="hidden" value="{{ $post->slug }}" name="slug">
                    <button onclick="return confirm('yakin delete ?')" class="bg-gradient-to-tl from-red-600 to-red-400 px-2.5 text-sm rounded-1.8 py-1.4 font-bold uppercase text-white transition-all active:scale-[0.95] hover:scale-[1.05] hover:cursor-pointer">
                        Delete
                    </button>
                </form>
            </div>
            <div class="bg-gradient-to-b from-slate-400 to-slate-900 h-96 md:h-full card-hover rounded-2xl overflow-hidden sm:bg-red-200 md:min-h-[50vh] shadow-lg shadow-slate-300">
                <embed src="/images/{{ $image->name }}" alt="" class="mix-blend-overlay w-full h-full object-cover">
            </div>
            <div class="absolute bottom-0 mb-5 mx-5">
                <h2 class="text-2xl text-white font-sans-serif font-semibold mb-4 line-clamp-2">{{ $image->title }}.</h2>
                <p class="text-white line-clamp-2">{{ strip_tags($image->description) }}</p>
            </div> 

            <!-- Modal  -->
            <div class="relative z-20 invisible" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="fixed h-screen w-screen inset-0 bg-gray-500 bg-opacity-75 transition-opacity" data-action="cancle"></div>
            
                <div class="fixed inset-0 z-60 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div class="transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-fit">
                            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"
                                            />
                                        </svg>
                                    </div>
                                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Deactivate account</h3>
                                        <div class="mt-2">
                                            <form action="/update-file?id={{ $image->id }}" method="post" class="w-full">
                                                @method("put")
                                                @csrf
                                                <input type="hidden" value="{{ $post->slug }}" name="slug">
                                                <div class="mb-5">
                                                    <label for="body">Judul</label>
                                                    <input 
                                                        type="text" 
                                                        name="title" 
                                                        id="title" 
                                                        class="w-full mt-2 rounded-md h-10 px-2 py-2 border-2 border-slate-200 block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-red-500 invalid:focus:ring-red-700 invalid:focus:border-red-700 peer" 
                                                        placeholder="Judul"
                                                        required
                                                        value="{{ old('title', $image->title) }}"
                                                    >
                                                </div>
                                                <div>
                                                    <label for="body">Description</label>
                                                    <input
                                                        type="text"
                                                        name="description"
                                                        id="description" 
                                                        placeholder="masukan konten deskripsi"
                                                        value="{{ old('description', $image->description) }}"
                                                        class="w-full mt-2 rounded-md h-10 px-2 py-2 border-2 border-slate-200 block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-red-500 invalid:focus:ring-red-700 invalid:focus:border-red-700 peer"
                                                    >
                                                    {{-- <trix-editor input="description" placeholder="masukan konten deskripsi"></trix-editor> --}}
                                                </div>
                                                <div class="mx-auto mt-10 w-fit">
                                                    <button type="reset" data-action="cancel" class="bg-slate-200 px-7 py-2 rounded-lg font-semibold shadow-soft-xs mt-3 active:scale-[0.95] hover:scale-[1.05] transition-all lg:mt-0 mx-5">
                                                        Batal
                                                    </button>
                                                    <button type="submit" id="submit" class="capitalize bg-gradient-to-l from-cyan-400 to-blue-600 px-4 py-2 rounded-lg font-semibold text-white mt-3 active:scale-[0.95] hover:scale-[1.05] transition-all lg:mt-0">
                                                        Edit {{ request()->segment(2) }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        @endforeach
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
    const actionButtons = document.querySelectorAll('[data-action]');
    function toggleModalVisibility(modal) {
        modal.classList.toggle("invisible");
    }
    function handleButtonClick(event) {
        const action = event.target.dataset.action;
        const modal = event.target.closest('.relative');
        console.log(action);
        if (action === 'edit') {
            toggleModalVisibility(modal.querySelector('[role="dialog"]'));
        }
        if (action === 'cancel') {
            toggleModalVisibility(modal)
        }
    }

    document.body.addEventListener('click', function (event) {
        if (event.target.matches('[data-action]')) {
            handleButtonClick(event);
        }
    });

</script>
@endsection
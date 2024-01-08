<div class="overflow-x-auto">
    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
        <thead class="align-bottom">
            <tr>
                <th
                    class="px-6 py-3 font-bold tracking-normal text-left uppercase bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-800 opacity-70"
                >
                    No
                </th>
                @foreach ($theads as $thead)
                <th
                    class="px-6 py-3 font-bold tracking-normal text-left uppercase bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-800 opacity-70"
                >
                    {{ $thead }}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr class="hover:bg-slate-100">
                    <td
                        class="font-sans-serif text-black text-wrap text-left px-5 py-2 text-sm leading-normal bg-transparent border-b border-slate-300 whitespace-nowrap md:whitespace-normal">
                        {{ $loop->iteration }}
                    </td>
                    <td 
                        class="font-sans-serif text-black text-wrap text-left px-5 py-2 text-sm leading-normal bg-transparent border-b border-slate-300 whitespace-nowrap md:whitespace-normal">
                        {{ auth()->user()->name }}
                    </td>
                    <td
                        class="w-82 font-sans-serif text-black text-wrap max-w-[40vh] text-left px-5 py-2 text-sm leading-normal bg-transparent border-b border-slate-300 whitespace-nowrap md:whitespace-normal">
                        {{ $post->male }}
                    </td>
                    <td
                        class="font-sans-serif text-black text-wrap max-w-[30vh] text-left px-5 py-2 text-sm leading-normal bg-transparent border-b border-slate-300 whitespace-nowrap md:whitespace-normal">
                        {{ $post->female }}
                    </td>
                    <td
                        class="font-sans-serif text-black text-wrap max-w-[30vh] text-left px-5 py-2 text-sm leading-normal bg-transparent border-b border-slate-300 whitespace-nowrap md:whitespace-normal">
                        {{ $post->total_population }}
                    </td>
                    <td
                        class="font-sans-serif text-black text-wrap max-w-[30vh] text-left px-5 py-2 text-sm leading-normal bg-transparent border-b border-slate-300 whitespace-nowrap md:whitespace-normal">
                        {{ $post->total_family }}
                    </td>
                    <td
                        class="font-sans-serif text-black text-wrap text-left px-5 py-2 text-sm leading-normal bg-transparent border-b border-slate-300 whitespace-nowrap md:whitespace-normal">
                        {{ $post->created_at }}
                    </td>
                    @if(!Request::is('dashboard'))
                    <td
                        class="font-sans-serif text-black text-left px-5 py-2 text-sm leading-normal bg-transparent border-b border-slate-300 whitespace-nowrap md:whitespace-normal">
                        <a href="{{ Request::getRequestUri() }}/{{ $post->id }}/edit" class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-sm rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white transition-all active:scale-[0.95] hover:scale-[1.05]">
                            Edit
                        </a>
                        <form action="{{ Request::getRequestUri() }}/{{ $post->id }}" method="post" class="inline-block">
                            @method("delete")
                            @csrf
                            <button 
                                class="bg-gradient-to-tl from-red-600 to-red-400 px-2.5 text-sm rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white transition-all active:scale-[0.95] hover:scale-[1.05]"
                                onclick="return confirm('yakin delete ?')"
                            >
                                Delete
                            </button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
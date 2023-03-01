@auth
    <x-panel>
        <form method="POST" action="/posts/{{ $post->slug }}/comments
    ">
            @csrf
            <header class="flex items-center">
                <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" alt="" style="width: 50px; height: 50px;"
                    class="rounded-full">

                <h2 class="ml-4">Want to participate?</h2>
            </header>
            <div>
                <textarea name="body" cols="20" rows="5" class="w-full text-sm focus:outline-none focus:ring"
                    placeholder="Say something!" required></textarea>

                @error('body')
                    <span class="text-red text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-end mt-5 border-gray-200 pt-6">
                <button
                    class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl houver:bg-blue-100"
                    type="submit"> Post</button>
            </div>
        </form>
    </x-panel>
@else
    <div class="bg-red-100 border border-round-xl p-10">
        <a class="hover:underline" href="/register">
            <h2 class="font-bold text-center">Para comentar Log In/Registar</h2>
        </a>
    </div>
@endauth

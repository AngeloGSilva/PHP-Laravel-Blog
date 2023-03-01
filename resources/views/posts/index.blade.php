{{-- @extends('layout')

@section('content') --}}

<x-layout>
    {{-- @foreach ($posts ?? [] as $post)
    <article>
        <h1>
                {{$post->title}}
            </a>
        </h1>
        <p>
            @dd({{$post->category->name}})
            By <a href="/authors/{{ $post->author->username}}">{{$post->author->name}}</a> in <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a>
        </p>
        <div>
            {{$post->excerpt}}
        </div>
    </article>
    @endforeach
@endsection --}}
    {{-- <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <img src="./images/logo.svg" alt="Laracasts Logo" width="165" height="16">
                </a>
            </div>

            <div class="mt-8 md:mt-0">
                <a href="/" class="text-xs font-bold uppercase">Home Page</a>

                <a href="#" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Subscribe for Updates
                </a>
            </div>
        </nav> --}}

    @include('posts._header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if ($posts->count())
            <x-posts-grid :posts="$posts" />
            {{ $posts->links() }}
        @else
            <p class="text-center">No posts yet.</p>
        @endif
    </main>
</x-layout>

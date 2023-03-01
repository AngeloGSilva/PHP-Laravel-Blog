@props(['comment'])

<x-panel class="bg-gray-100">
<article class="flex bg-gray-100 space-x-4">
    <div style="flex-shrink: 0;">
        <img src="https://i.pravatar.cc/60?u={{ $comment->user_id }}" alt="" style="width: 80px; height: 80px;" class="rounded-xl">
    </div>
    <div>
        <header class="m-4">
            <h3 class="font-bold">{{ $comment->author->username }}</h3>
            <p class="text-xs">
                Posted
            <time> {{ $comment->created_at->diffForHumans() }}</time>
            </p>
        </header>
        <p>
            {{ $comment->body }}
        </p>
    </div>
</article>
</x-panel>

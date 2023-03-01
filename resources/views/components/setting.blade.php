@props(['heading'])

<section class="py-8 max-w-4xl mx-auto">

    <h1 class="text-lg font-bold mb-4 text-center border-b">
        {{ $heading }}
    </h1>

    <div class="flex">
    <aside class="w-48 flex-shrink-0">
        <h3 class="font-bold mb-4 border-b">Dash Links</h3>
        <ul>
            <li>
                <a href="/admin/posts/create" class="{{ request()->is('admin/posts/create') ? 'text-blue-500' : '' }} font-semibold"> New Post</a>
            </li>
            <li>
                <a href="/admin/posts" class="{{ request()->is('admin/posts') ? 'text-blue-500' : '' }} font-semibold">All Post</a>
            </li>
        </ul>
    </aside>
</div>
    <main class="flex-1">
    <x-panel>
        {{ $slot }}
    </x-panel>

</main>

</section>

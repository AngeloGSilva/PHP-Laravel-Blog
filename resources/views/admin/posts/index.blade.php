<x-layout>
    <x-setting heading="Manage Posts">

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($posts as $post)
                                    <tr>
                                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                            <div class="flex items-center">

                                                    <a href="/posts/{{ $post->slug }}" class="text-gray-900 whitespace-no-wrap">
                                                        {{ $post->title }}
                                                    </a>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $post->created_at }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                                <span aria-hidden="true"
                                                    class="absolute inset-0 bg-green-200 rounded-full opacity-50">
                                                </span>
                                                <span class="relative">
                                                    Publicado
                                                </span>
                                            </span>
                                        </td>
                                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                            <a href="/admin/posts/{{ $post->id }}/edit" class="text-blue-500">Edit</a>
                                        </td>
                                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                            <form method="POST" action="/admin/posts/{{ $post->id }}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="text-gray-400">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-setting>
</x-layout>

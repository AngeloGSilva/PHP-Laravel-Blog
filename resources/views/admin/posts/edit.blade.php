<x-layout>

    <x-setting :heading="'Edit New Post: '.$post->title">
        <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" value="{{ $post->title }}"/>

            <x-form.input name="slug" value="{{ $post->slug }}"/>

                <div class="flex mt-6">
                    <div class="flex-1">
                        <x-form.input name="thumbnail" type="file" value="$post->tumbnail"/>
                    </div>
                    <img src="{{ asset('storage/'.$post->thumbnail) }}" alt="" width="100" class="rounded-xl ml-6">
                </div>

            <x-form.textarea name="excerpt">{{ $post->excerpt }}</x-form.textarea>

            <x-form.textarea name="body">{{ $post->body }}</x-form.textarea>


            <div class="mb-6">
                <x-form.label name="Category"/>

                <select name="category_id" id="category_id">
                    @foreach (\App\Models\Category::all() as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}
                        >{{ ucwords($category->name) }}</option>
                    @endforeach
                </select>
                <x-form.error name="Category"/>
            </div>

            <x-submit-button>Update</x-submit-button>

        </form>
    </x-setting>



</x-layout>

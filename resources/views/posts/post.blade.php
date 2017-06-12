@foreach($posts as $post)
    <article>
        @include('posts.header')
        <div class="photo">
            <a href="{{ asset('uploads/' . $post->image) }}"><img src="{{ asset('uploads/' . $post->image) }}" alt="{{ $post->title }}"></a>
        </div>
    </article>
@endforeach
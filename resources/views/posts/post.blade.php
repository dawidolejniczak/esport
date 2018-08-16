@foreach($posts as $post)
    <article>
        @include('posts.header')
        <div class="photo">
            <a href="{{ route('posts.show', $post->title) }}">
                <img src="{{ asset('uploads/' . $post->image) }}" alt="{{ $post->title }}">
            </a>
        </div>
    </article>
@endforeach
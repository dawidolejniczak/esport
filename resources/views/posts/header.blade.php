<header>
    <h2><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h2>
    <ul class="social">
        <div class="fb-share-button" data-href="{{ route('posts.show', $post->id) }}"
             data-layout="button_count" data-size="small" data-mobile-iframe="true">
            <a class="fb-xfbml-parse-ignore" target="_blank"
               href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a>
        </div>
    </ul>
    <div class="comments">
        <a href="{{ route('posts.show', $post->id) }}">
            <i class="fa fa-comment" aria-hidden="true"></i>
            <span class="fb-comments-count" data-href="{{ route('posts.show', $post->id) }}"></span> comments
        </a>
    </div>
    <div class="links">
        @foreach($post->games as $game)
            <a href="">{{ $game->name }}</a>
        @endforeach
    </div>
</header>
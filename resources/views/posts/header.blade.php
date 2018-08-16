<header>
    <h2><a href="{{ route('posts.show', $post->title) }}">{{ $post->title }}</a></h2>
    <ul class="social">
        <li>
            <div class="fb-share-button" data-href="{{ route('posts.show', $post->title) }}"
                 data-layout="button_count" data-size="small" data-mobile-iframe="true">
                <a class="fb-xfbml-parse-ignore" target="_blank"
                   href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">
                    Share
                </a>
            </div>
        </li>
        <li>
            <div>
                <a class="twitter-share-button"
                   href="https://twitter.com/intent/tweet?text={{ $post->title }}">
                    Tweet</a>
            </div>
        </li>
        <li>
            <a href="//www.reddit.com/submit"
               onclick="window.location = '//www.reddit.com/submit?url=' + '{{ $post->title }}'; return false">
                <img src="//www.redditstatic.com/spreddit8.gif" alt="submit to reddit" border="0"/> </a>
        </li>
    </ul>
    <div class="comments">
        <a href="{{ route('posts.show', $post->title) }}">
            <i class="fa fa-comment" aria-hidden="true"></i>
            <span class="fb-comments-count" data-href="{{ route('posts.show', $post->title) }}"></span> comments
        </a>
    </div>
    <div class="links">
        @foreach($post->games as $game)
            <a href="?search=games.name:{{ $game->name }}">{{ $game->name }}</a>
        @endforeach
    </div>
</header>
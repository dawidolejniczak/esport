@foreach($posts as $post)
    <article>
        <header>
            <h2><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h2>
            <ul class="social">
                <div class="fb-share-button" data-href="{{ route('posts.show', $post->id) }}" data-layout="button_count" data-size="small" data-mobile-iframe="true">
                    <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a>
                </div>
                <!--<li><a href=""><img src="img/socials.jpg" alt=""></a></li>
                <li><a href="">facebook</a></li>
                <li><a href="">twitter</a></li>
                <li><a href="">reddit</a></li>-->
            </ul>
            <div class="comments"><a href=""><i class="fa fa-comment" aria-hidden="true"></i> 10
                    comments</a></div>
            <div class="links">
                @foreach($post->games as $game)
                    <a href="">{{ $game->name }}</a>
                @endforeach
            </div>
        </header>
        <div class="photo">
            <a href=""><img src="{{ asset('uploads/' . $post->image) }}" alt=""></a>
        </div>
    </article>
@endforeach
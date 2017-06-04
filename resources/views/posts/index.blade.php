@foreach($posts as $post)
    <article>
        <header>
            <h2><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h2>
            <ul class="social">
                <li><a href=""><img src="img/socials.jpg" alt=""></a></li>
                <!--<li><a href="">facebook</a></li>
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
<section id="filters">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <button class="link">Choose your games <i class="fa fa-angle-down" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
    <div class="panel filters">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <p class="counter"><span></span> games selected</p>
                    <form action="">
                        <ul>
                            @foreach($games as $game)
                            <li><input type="checkbox" class="gamesToCheck" name="game[]" id="game{{ $game->id }}" value="{{ $game->id }}"><label for="game{{ $game->id }}">{{ $game->name }}</label></li>
                            @endforeach
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
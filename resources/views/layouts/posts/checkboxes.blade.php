<div class="field">
    <label for="">Select game: </label>
    <ul class="checkbox-list">
        @foreach($games as $game)
            <li><input type="checkbox" id="game-{{ $game->id }}" name="game[]" value="{{ $game->id }}"><label
                        for="game-{{ $game->id }}">{{ $game->name }}</label></li>
        @endforeach
    </ul>
</div>
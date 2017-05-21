@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <form id="add" class="add-game col-sm-offset-3 col-sm-6 col-xs-12">
                    <div class="fieldset">
                        <div class="tab add">Add</div>
                        <div class="field"><label for="">Title</label><input type="text" placeholder="Some title"></div>
                        <div class="field">
                            <div class="upload">
                                <span>Add image/gif</span>
                                <input type="file" accept="image/*">
                            </div>
                        </div>
                        <div class="field">
                            <label for="">Youtube</label>
                            <span>
                                <span class="label">http://</span>
                                <input type="text">
                            </span>
                        </div>
                        <div class="field"><label for="">Embed code (twitch, oddshot etc.)</label><input type="text" placeholder="Some title"></div>
                        <div class="field">
                            <label for="">Select game: </label>
                            <ul class="checkbox-list">
                                <li><input type="checkbox" id="game-1"><label for="game-1">Game 1</label></li>
                                <li><input type="checkbox" id="game-2"><label for="game-2">Game 2</label></li>
                                <li><input type="checkbox" id="game-3"><label for="game-3">Game 3</label></li>
                                <li><input type="checkbox" id="game-4"><label for="game-4">Game 4</label></li>
                                <li><input type="checkbox" id="game-5"><label for="game-5">Game 5</label></li>
                                <li><input type="checkbox" id="game-6"><label for="game-6">Game 6</label></li>
                                <li><input type="checkbox" id="game-7"><label for="game-7">Game 7</label></li>
                                <li><input type="checkbox" id="game-8"><label for="game-8">Game 8</label></li>
                                <li><input type="checkbox" id="game-9"><label for="game-9">Game 9</label></li>
                                <li><input type="checkbox" id="game-10"><label for="game-10">Game 10</label></li>
                                <li><input type="checkbox" id="game-11"><label for="game-11">Game 11</label></li>
                                <li><input type="checkbox" id="game-12"><label for="game-12">Game 12</label></li>
                                <li><input type="checkbox" id="game-13"><label for="game-13">Game 13</label></li>
                            </ul>
                        </div>
                        <input type="submit" class="btn btn-go" value="Add now">
                    </div>

                </form>
            </div>

        </div>
    </main>
@endsection
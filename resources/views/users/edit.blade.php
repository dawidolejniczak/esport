@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <form id="add" method="post" action="{{ route('users.update', Auth::user()->id) }}"
                      class="add-game col-sm-offset-3 col-sm-6 col-xs-12" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <div class="fieldset">
                        <div class="tab add">My Profile</div>
                        {!! form_row($form->name) !!}
                        {!! form_row($form->email) !!}
                        <div class="field">
                            <div class="upload">
                                <span>Avatar</span>
                                {!! form_widget($form->image) !!}
                            </div>
                        </div>
                        {!! form_row($form->submit) !!}
                    </div>
                </form>
            </div>
        </div>
    </main>
    @if(isset($user->image))
        <script>
            $(document).ready(function () {
                $('.upload').css("background-image", "url('{{ asset('uploads/' . $user->image) }}')");
                $('.upload').css("background-size", "cover");
                $('.upload').css("background-position", "center center");
                $('.upload').css("height", '200px');
                $('.upload').find('span').text('');
            });
        </script>
    @endif
@endsection
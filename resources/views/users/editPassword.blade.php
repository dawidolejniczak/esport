@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <form id="add" method="post" action="{{ route('password.update', Auth::user()->id) }}"
                      class="add-game col-sm-offset-3 col-sm-6 col-xs-12" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <div class="fieldset">
                        <div class="tab add">Change Password</div>
                        {!! form_row($form->password) !!}
                        {!! form_row($form->password_confirmation) !!}
                        {!! form_row($form->submit) !!}
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
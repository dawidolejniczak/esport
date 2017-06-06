@extends('layouts.app')
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <main>
        <div class="container-fluid">
            <div class="row">
                <form id="add" method="post" action="{{ route('users.store') }}" class="add-game col-sm-offset-3 col-sm-6 col-xs-12" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="fieldset">
                        <div class="tab add">Add</div>
                        {!! form_row($form->name) !!}
                        {!! form_row($form->email) !!}
                        <div class="field">
                            <div class="upload">
                                <span>Add Avatar</span>
                                {!! form_widget($form->image) !!}
                            </div>
                        </div>
                        {!! form_row($form->password) !!}
                        {!! form_row($form->password_confirmation) !!}
                        {!! form_row($form->submit) !!}
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
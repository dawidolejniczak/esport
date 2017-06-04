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
                <form id="add" method="post" action="{{ route('posts.store') }}" class="add-game col-sm-offset-3 col-sm-6 col-xs-12" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="fieldset">
                        <div class="tab add">Add</div>
                        {!! form_row($form->title) !!}
                        <div class="field">
                            <div class="upload">
                                <span>Add image/gif</span>
                                {!! form_widget($form->image, $options = ['attr' => ['accept' => 'image/*']]) !!}
                            </div>
                        </div>
                        {!! form_row($form->youTube) !!}
                        {!! form_row($form->embeddedCode) !!}
                        {!! form_row($form->games) !!}
                        {!! form_row($form->submit) !!}
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
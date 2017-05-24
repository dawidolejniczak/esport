@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                {!! form_start($form) !!}
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
                {!! form_end($form) !!}
            </div>
        </div>
    </main>
@endsection
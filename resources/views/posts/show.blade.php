@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <section class="articles col-md-8 col-sm-12 col-xs-12">
                    <div class="tab"><a href=""><i class="fa fa-angle-left" aria-hidden="true"></i> Back</a></div>
                    <article>
                        @include('posts.header')
                        <div class="photo">
                            <a href="{{ asset('uploads/' . $post->image) }}"><img
                                        src="{{ asset('uploads/' . $post->image) }}" alt="{{ $post->title }}"></a>
                        </div>
                        @if(isset($youTube))
                            <div style="margin-top: 20px">
                                {!! $youTube !!}
                            </div>
                        @endif
                        @if(isset($embed))
                            <div style="margin-top: 20px">
                                {!! $embed !!}
                            </div>
                        @endif
                        <a href="/" class="btn btn-go">Go to main page</a>
                        <div class="fb-comments" data-width="710" data-href="{{ route('posts.show', $post->title) }}"
                             data-numposts="5"></div>
                    </article>
                </section>
                @include('layouts.sidebar')
            </div>
        </div>
    </main>
@endsection
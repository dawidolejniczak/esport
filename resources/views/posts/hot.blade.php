@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <section class="articles col-md-8 col-sm-12 col-xs-12">
                    <div class="tab"><a href="" class="hot">Hot</a></div>
                    @include('posts.index')
                    {{ $posts->links() }}
                </section>
                @include('layouts.sidebar')
            </div>
        </div>
    </main>
@endsection
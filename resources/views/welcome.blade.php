@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <section class="articles col-md-8 col-sm-12 col-xs-12">
                    <div class="tab"><a href="" class="hot">Hot</a></div>
                    <article>
                        <header>
                            <h2><a href="">Jakiś tytuł wpisu nie mam pojęcia jaki ale na pewno może być długi i nadal
                                    będzie czytelny.</a></h2>
                            <ul class="social">
                                <li><a href=""><img src="img/socials.jpg" alt=""></a></li>
                                <!--<li><a href="">facebook</a></li>
                                <li><a href="">twitter</a></li>
                                <li><a href="">reddit</a></li>-->
                            </ul>
                            <div class="comments"><a href=""><i class="fa fa-comment" aria-hidden="true"></i> 10
                                    comments</a></div>
                            <div class="links">
                                <a href="">CS:GO</a>
                            </div>
                        </header>
                        <div class="photo">
                            <a href=""><img src="img/a1.jpg" alt=""></a>
                        </div>
                    </article>
                    <article>
                        <header>
                            <h2><a href="">Jakiś tytuł wpisu nie mam pojęcia jaki ale na pewno może być długi i nadal
                                    będzie czytelny.</a></h2>
                            <ul class="social">
                                <li><a href=""><img src="img/socials.jpg" alt=""></a></li>
                                <!--<li><a href="">facebook</a></li>
                                <li><a href="">twitter</a></li>
                                <li><a href="">reddit</a></li>-->
                            </ul>
                            <div class="comments"><a href=""><i class="fa fa-comment" aria-hidden="true"></i> 10
                                    comments</a></div>
                            <div class="links">
                                <a href="">Overwatch</a>
                                <a href="">CS:GO</a>
                            </div>
                        </header>
                        <div class="photo">
                            <a href=""><img src="img/a2.jpg" alt=""></a>
                        </div>
                    </article>
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    Previous
                                </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">6</a></li>
                            <li><a href="#">7</a></li>
                            <li>
                                <a href="#" aria-label="Next">Next
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </section>
                @include('layouts.sidebar')
            </div>
        </div>
    </main>
@endsection
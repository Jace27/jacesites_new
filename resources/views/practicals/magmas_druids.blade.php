@extends('layouts.main')

@section('title')
Магмас ака Масяня - Друидский практикум @endsection

@section('head')
    <link rel="stylesheet" href="/css/practicals/magmas_druids.css">
    <script src="/js/pdf-pagination.js"></script>
    <link rel="stylesheet" href="/css/pdf-pagination.css">
@endsection

@section('content')
    <div class="preloader"><h1>Загрузка...</h1></div>

    <div class="page-change-btns">
        <div>
            <button class="btn btn-primary btn-page-prev"><</button>
            <button class="btn btn-primary btn-page-next">></button>
        </div>
    </div>

    <div id="page-container">
        <div id="pf1" class="pf w0 h0" data-page-no="1">
            <div class="pc pc1 w0 h0"><img class="bi x0 y0 w1 h1" alt=""
                <div class="t m0 x1 h2 y1 ff1 fs0 fc0 sc0 ls0 ws0">в<span class="_ _0"></span>е<span
                        class="_ _1"></span>д<span class="_ _2"></span>у<span class="_ _3"></span>щ<span
                        class="_ _4"></span>а<span class="_ _5"></span>я
                </div>
                <div class="t m1 x2 h3 y1 ff1 fs1 fc0 sc0 ls0 ws0">:<span class="_ _6"></span> <span
                        class="_ _7"></span>M<span class="_ _8"></span>A<span class="_ _9"></span>G<span
                        class="_ _a"></span>M<span class="_ _8"></span>A<span class="_ _2"></span>S
                </div>
                <div class="t m2 x3 h4 y2 ff2 fs2 fc0 sc0 ls0 ws0">«<span class="_ _b"></span>В<span
                        class="_ _1"></span>о<span class="_ _c"></span>з<span class="_ _d"></span>м<span
                        class="_ _e"></span>о<span class="_ _c"></span>ж<span class="_ _f"></span>н<span
                        class="_ _10"></span>о<span class="_ _c"></span>,<span class="_ _11"></span> <span
                        class="_ _12"></span>в<span class="_ _c"></span>а<span class="_ _13"></span>м<span
                        class="_ _e"></span> <span class="_ _12"></span>с<span class="_ _d"></span>ю<span
                        class="_ _14"></span>д<span class="_ _13"></span>а<span class="_ _c"></span>,
                </div>
                <div class="t m2 x3 h4 y3 ff2 fs2 fc0 sc0 ls0 ws0">п<span class="_ _c"></span>о<span
                        class="_ _c"></span>т<span class="_ _5"></span>о<span class="_ _c"></span>м<span
                        class="_ _e"></span>у<span class="_ _b"></span> <span class="_ _12"></span>ч<span
                        class="_ _b"></span>т<span class="_ _5"></span>о<span class="_ _c"></span> <span
                        class="_ _12"></span>и<span class="_ _c"></span>н<span class="_ _10"></span>ы<span
                        class="_ _2"></span>е<span class="_ _13"></span> <span class="_ _12"></span>д<span
                        class="_ _13"></span>о<span class="_ _c"></span>р<span class="_ _c"></span>о<span
                        class="_ _c"></span>г<span class="_ _d"></span>и<span class="_ _c"></span>,
                </div>
                <div class="t m2 x3 h4 y4 ff2 fs2 fc0 sc0 ls0 ws0">б<span class="_ _13"></span>е<span
                        class="_ _13"></span>з<span class="_ _d"></span> <span class="_ _12"></span>и<span
                        class="_ _c"></span>с<span class="_ _d"></span>с<span class="_ _15"></span>л<span
                        class="_ _c"></span>е<span class="_ _13"></span>д<span class="_ _13"></span>о<span
                        class="_ _c"></span>в<span class="_ _c"></span>а<span class="_ _13"></span>н<span
                        class="_ _10"></span>и<span class="_ _c"></span>я<span class="_ _c"></span> <span
                        class="_ _12"></span>и<span class="_ _c"></span> <span class="_ _12"></span>п<span
                        class="_ _c"></span>о<span class="_ _13"></span>з<span class="_ _d"></span>н<span
                        class="_ _10"></span>а<span class="_ _c"></span>н<span class="_ _10"></span>и<span
                        class="_ _c"></span>я<span class="_ _13"></span> <span class="_ _12"></span>с<span
                        class="_ _d"></span>е<span class="_ _13"></span>б<span class="_ _13"></span>я<span
                        class="_ _13"></span>,
                </div>
                <div class="t m2 x3 h4 y5 ff2 fs2 fc0 sc0 ls0 ws0">п<span class="_ _c"></span>р<span
                        class="_ _c"></span>и<span class="_ _c"></span>в<span class="_ _13"></span>е<span
                        class="_ _13"></span>д<span class="_ _13"></span>у<span class="_ _15"></span>т<span
                        class="_ _5"></span> <span class="_ _12"></span>в<span class="_ _13"></span>а<span
                        class="_ _c"></span>с<span class="_ _d"></span> <span class="_ _12"></span>к<span
                        class="_ _13"></span> <span class="_ _12"></span>б<span class="_ _c"></span>а<span
                        class="_ _c"></span>н<span class="_ _10"></span>а<span class="_ _13"></span>л<span
                        class="_ _10"></span>ь<span class="_ _13"></span>н<span class="_ _c"></span>о<span
                        class="_ _10"></span>й<span class="_ _c"></span> <span class="_ _12"></span>ж<span
                        class="_ _f"></span>и<span class="_ _c"></span>з<span class="_ _d"></span>н<span
                        class="_ _10"></span>и<span class="_ _c"></span>.<span class="_ _11"></span>»
                </div>
                <div class="t m3 x4 h5 y6 ff3 fs3 fc0 sc0 ls0 ws0">п<span class="_ _14"></span>р<span
                        class="_ _14"></span>а<span class="_ _16"></span>к<span class="_ _2"></span>т<span
                        class="_ _e"></span>и<span class="_ _17"></span>к<span class="_ _2"></span>у<span
                        class="_ _2"></span>м<span class="_ _18"></span> <span class="_ _d"></span>п<span
                        class="_ _14"></span>р<span class="_ _14"></span>о<span class="_ _14"></span>в<span
                        class="_ _16"></span>е<span class="_ _16"></span>д<span class="_ _14"></span>е<span
                        class="_ _16"></span>н<span class="_ _14"></span> <span class="_ _d"></span>н<span
                        class="_ _14"></span>а<span class="_ _16"></span> <span class="_ _d"></span>d<span
                        class="_ _14"></span>r<span class="_ _0"></span>e<span class="_ _2"></span>a<span
                        class="_ _16"></span>m<span class="_ _19"></span>h<span class="_ _14"></span>a<span
                        class="_ _2"></span>c<span class="_ _2"></span>k<span class="_ _9"></span>e<span
                        class="_ _2"></span>r<span class="_ _1"></span>s<span class="_ _1a"></span>.<span
                        class="_ _1b"></span>e<span class="_ _2"></span>u
                </div>
                <div class="t m3 x4 h5 y7 ff3 fs3 fc0 sc0 ls0 ws0">и<span class="_ _17"></span>з<span
                        class="_ _3"></span>д<span class="_ _14"></span>а<span class="_ _16"></span>н<span
                        class="_ _14"></span>о<span class="_ _14"></span> <span class="_ _15"></span>К<span
                        class="_ _17"></span>н<span class="_ _14"></span>и<span class="_ _17"></span>жн<span
                        class="_ _14"></span>ы<span class="_ _1c"></span>м<span class="_ _8"></span> <span
                        class="_ _d"></span>К<span class="_ _1d"></span>л<span class="_ _16"></span>у<span
                        class="_ _2"></span>б<span class="_ _14"></span>о<span class="_ _14"></span>м<span
                        class="_ _18"></span> <span class="_ _d"></span>Х<span class="_ _5"></span>а<span
                        class="_ _16"></span>к<span class="_ _2"></span>е<span class="_ _2"></span>р<span
                        class="_ _17"></span>о<span class="_ _14"></span>в<span class="_ _16"></span> <span
                        class="_ _d"></span>С<span class="_ _14"></span>н<span class="_ _17"></span>о<span
                        class="_ _14"></span>в<span class="_ _16"></span>и<span class="_ _17"></span>д<span
                        class="_ _14"></span>е<span class="_ _16"></span>н<span class="_ _14"></span>и<span
                        class="_ _17"></span>й
                </div>
                <div class="t m3 x5 h5 y8 ff3 fs3 fc0 sc0 ls0 ws0">e<span class="_ _2"></span>m<span
                        class="_ _19"></span>i<span class="_ _1b"></span>r<span class="_ _1"></span>i<span
                        class="_ _1b"></span>d<span class="_ _14"></span>a<span class="_ _2"></span>.<span
                        class="_ _1b"></span>e<span class="_ _2"></span>u
                </div>
            </div>
            <div class="pi" data-data='{"ctm":[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}'></div>
        </div>
    </div>
@endsection

@section('sidebar')
    <p>
        Страница:
        <input type="number" min="1" step="1" class="d-inline form-control" id="pdf-pagination-page">
    </p>

    <p><button class="btn btn-primary btn-download" data-file-link="/download/practicals/magmas_druids.pdf">Скачать (.pdf, 4015 КБ)</button></p>
@endsection
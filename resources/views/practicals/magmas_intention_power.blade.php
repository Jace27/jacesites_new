@extends('layouts.main')

@section('title')
    Магмас ака Масяня - Сила Намерения @endsection

@section('head')
    <link rel="stylesheet" href="/css/practicals/magmas_intention_power.css">
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
                <div class="t m0 x1 h2 y1 ff1 fs0 fc0 sc0 ls0 ws0">Место</div>
                <div class="t m0 x2 h2 y2 ff1 fs0 fc0 sc0 ls0 ws0">Аномального</div>
                <div class="t m0 x3 h2 y3 ff1 fs0 fc0 sc0 ls0 ws0">Синергетического</div>
                <div class="t m0 x4 h2 y4 ff1 fs0 fc0 sc0 ls0 ws0">Явления</div>
                <div class="t m0 x5 h3 y5 ff2 fs1 fc0 sc0 ls0 ws0">Издано<span class="ff3"> </span>Книжным<span
                        class="ff3"> </span>Клубом<span class="ff3"> </span>Хакеров<span class="ff3"> </span>Сновидений
                </div>
                <div class="t m0 x6 h3 y6 ff3 fs1 fc0 sc0 ls0 ws0">emirida.eu</div>
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

    <p><button class="btn btn-primary btn-download" data-file-link="/download/practicals/magmas_intention_power.pdf">Скачать (.pdf, 11 353 КБ)</button></p>
@endsection
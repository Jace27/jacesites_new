@extends('layouts.main')

@section('title')
Магмас ака Масяня - Создание магических существ @endsection

@section('head')
    <link rel="stylesheet" href="/css/practicals/magmas_creating_magical_creatures.css">
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
            <div class="pi" data-data="{&quot;ctm&quot;:[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}"></div>
        </div>
    </div>
@endsection

@section('sidebar')
    <p>
        Страница:
        <input type="number" min="1" step="1" class="d-inline form-control" id="pdf-pagination-page">
    </p>

    <p><button class="btn btn-primary btn-download" data-file-link="/download/practicals/magmas_creating_magical_creatures.pdf">Скачать (.pdf, 3471 КБ)</button></p>
@endsection
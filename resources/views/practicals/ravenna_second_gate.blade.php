@extends('layouts.main')

@section('title')
Равенна - Вторые врата @endsection

@section('head')
    <link rel="stylesheet" href="/css/practicals/ravenna_second_gate.css">
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

    <?php include $_SERVER['DOCUMENT_ROOT'].'/resources/practicals/ravenna_second_gate/ravenna_second_gate.html'; ?>
@endsection

@section('sidebar')
    <p>
        Страница:
        <input type="number" min="1" step="1" class="d-inline form-control" id="pdf-pagination-page">
    </p>

    <p><button class="btn btn-primary btn-download" data-file-link="/download/practicals/ravenna_second_gate.pdf">Скачать (.pdf, 11 628 КБ)</button></p>
@endsection

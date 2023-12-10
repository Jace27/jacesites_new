@extends('layouts.main')

@section('title')
Равенна - Охота на дубля @endsection

@section('head')
    <link rel="stylesheet" href="/css/practicals/ravenna_hunting_for_double.css">
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

	<?php include $_SERVER['DOCUMENT_ROOT'].'/resources/practicals/ravenna_hunting_for_double/ravenna_hunting_for_double.html'; ?>
@endsection

@section('sidebar')
    <p>
        Страница:
        <input type="number" min="1" step="1" class="d-inline form-control" id="pdf-pagination-page">
    </p>

    <p><button class="btn btn-primary btn-download" data-file-link="/download/practicals/ravenna_hunting_for_double.pdf">Скачать (.pdf, 6371 КБ)</button></p>
@endsection

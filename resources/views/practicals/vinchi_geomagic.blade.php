@extends('layouts.main')

@section('title')
Винчи - Геомагия @endsection

@section('head')
    <link rel="stylesheet" href="/css/practicals/vinchi_geomagic.css">
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

    <?php include $_SERVER['DOCUMENT_ROOT'].'/resources/practicals/vinchi_geomagic/vinchi_geomagic.html'; ?>
@endsection

@section('sidebar')
    <p>
        Страница:
        <input type="number" min="1" step="1" class="d-inline form-control" id="pdf-pagination-page">
    </p>

    <p>
        <button class="btn btn-primary btn-download"
                data-file-link="/download/practicals/vinchi_geomagic.pdf">Скачать (.pdf, 2678 КБ)
        </button>
    </p>
@endsection

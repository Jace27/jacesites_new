@extends('layouts.main')

@section('title')
Библиотека @endsection

@section('head')
    <link rel="stylesheet" href="/css/hider.css">
    <script type="text/javascript" src="/js/hider.js"></script>
    <style>
        .book {
            display: flex;
            flex-direction: column;
            text-align: center;
            background-color: white;
        }

        .book:hover {
            transition-duration: .3s;
            transition-timing-function: ease;
            border-radius: 5px;
            box-shadow: 0 0 3px 2px rgb(192, 192, 192);
            z-index: 999;
        }

        .book:not(.private-book) {
            cursor: pointer;
        }

        .book * {
            max-width: 150px !important;
        }
    </style>
@endsection

@section('content')
    @php $user = \Illuminate\Support\Facades\Auth::user(); @endphp
    @if(is_null($slug))
        <div class="text-block mt-3 d-flex flex-row flex-wrap">
            @foreach(\App\Models\Books::query()->get() as $book)
                <div class="p-2 book @if($book->private && is_null($user)) private-book @endif"
                     data-id="{{ $book->slug }}"
                     @if($book->private && is_null($user)) alt="Зарегистрируйтесь, чтобы получить доступ к этой книге"
                     title="Зарегистрируйтесь, чтобы получить доступ к этой книге" @endif>
                    @if(file_exists($_SERVER['DOCUMENT_ROOT'].'/storage/images/books/'.$book->slug.'.png'))
                        <img src="/storage/images/books/{{ $book->slug }}.png">
                    @else
                        <img src="/storage/images/books/no-image.png">
                    @endif
                    @if($book->author != null)
                        <span><b>{{ $book->author }}</b></span>
                    @endif
                    <span>{{ $book->title }} @if($book->year != null)
                            ({{ $book->year }} год)
                        @endif</span>
                </div>
            @endforeach
        </div>
        <script>
            $(document).ready(function () {
                $('.book:not(.private-book)').click(function () {
                    window.location.assign('/library/' + this.dataset.id);
                });
            });
        </script>
    @else
        <div class="text-block mt-3">
            @php
                $book = \App\Models\Books::whereSlug($slug)->first();
            @endphp

            @if($book->private && is_null($user))
                <h1>Зарегистрируйтесь, чтобы получить доступ к этой книге</h1>
            @else
                <div class="d-flex justify-content-center">
                    @if(file_exists($_SERVER['DOCUMENT_ROOT'].'/storage/images/books/'.$book->slug.'.png'))
                        <img src="/storage/images/books/{{ $book->slug }}.png"
                             style="max-width: 300px; max-height: 700px;">
                    @else
                        <img src="/storage/images/books/no-image.png" style="max-width: 300px; max-height: 700px;">
                    @endif
                </div>
                <p class="mt-3">@if($book->author != null)
                        <b>{{ $book->author }}</b> -
                    @endif {{ $book->title }} @if($book->year != null)
                        ({{ $book->year }} год)
                    @endif</p>
                <p>{{ $book->description }}</p>
                @php
                    $size = round(filesize($_SERVER['DOCUMENT_ROOT'].'/storage/books/'.$book->slug.'.zip') / 1024.0);
                @endphp
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary btn-download"
                            data-file-link="/storage/books/{{ $book->slug }}.zip">Скачать (.{{ $book->extension }}
                        .zip, {{ $size }} КБ)
                    </button>
                </div>
            @endif
        </div>
    @endif
@endsection

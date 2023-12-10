@php
    $user = auth()->user();
@endphp

@extends('layouts.main')

@section('title')
Статьи @endsection

@section('head')
    <link rel="stylesheet" href="/css/articles.css">
@endsection

@section('content')
    <div class="text-block mt-3">
        @if(is_null($slug))
            @php $articles = \App\Models\Articles::available(); @endphp
            @if(count($articles) < 1)
                <h3>Нет статей</h3>
            @else
                @foreach($articles as $article)
                    <div class="post__header">
                        <div class="post__header_author">{{ $article->author }}</div>
                        <div class="post__header_created-at">{{ $article->created_at }}</div>
                        <div class="post__header_title"><h3>{!! $article->title !!}</h3></div>
                        <div><a href="/article/{{ $article->slug }}">Читать</a></div>
                    </div>
                @endforeach
            @endif
        @else
            @php
                $article = \App\Models\Articles::whereSlug($slug)->firstOrFail();
            @endphp
            @if($article->is_available())
                @php
                    $article->read();
                @endphp
                <div class="post__header">
                    <div class="post__header_title"><h3>{!! $article->title !!}</h3></div>
                    <div class="post__header_author">{{ $article->author }}</div>
                    <div class="post__header_created-at">{{ $article->created_at }}</div>
                </div>
                <div class="post__content">{!! $article->content !!}</div>
            @else
                @php
                    $article = \App\Models\Articles::whereId($article->available_after)->firstOrFail();
                @endphp
                <h3>Статья недоступна. Сначала прочитайте предыдущую статью: <a href="/article/{{ $article->slug }}">{{ $article->title }}</a></h3>
            @endif
        @endif
    </div>
@endsection

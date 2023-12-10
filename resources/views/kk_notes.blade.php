@extends('layouts.main')

@section('title')
Записки Карлоса Кастанеды @endsection

@section('head')
    <link rel="stylesheet" href="/css/kk_notes.css">
    <script src="/js/search.js"></script>
@endsection

@section('content')
    @if(is_null($slug))
        <div class="text-block mt-3">
            <div class="d-flex flex-row">
                <input type="text" class="form-control mr-2" name="search" data-type="offline" data-target="kk_notes">
                <button class="btn btn-primary btn-page-search">Искать</button>
            </div>
        </div>

        <div id="search-results" class="text-block mt-3" style="display: none;"></div>
    @endif

    <div id="page" class="text-block mt-3">
        @if(is_null($slug))
            <div class="d-flex flex-row flex-wrap">
                @foreach(\App\Models\KkNotes::query()->orderBy('name')->get() as $note)
                    <span class="m-2 search-result @if($note->active == 0) search-hidden @endif">
                        <a href="/kk_notes/{{ $note->slug }}">{{ $note->name }}</a>
                    </span>
                @endforeach
            </div>
        @else
            @php $note = \App\Models\KkNotes::whereSlug($slug)->firstOrFail() @endphp
            <h1>{{ $note->name }}</h1>
            {!! $note->content !!}
        @endif
    </div>

    <div class="text-block mt-3"><b>Некоторые ссылки могут не работать. Если обнаружили такую, сообщите <a
                    href="http://vk.com/jace_dreamhacker" target="_blank">Денни</a></b></div>
@endsection

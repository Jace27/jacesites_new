@extends('layouts.main')

@php
    $user = \Illuminate\Support\Facades\Auth::user();
    $dream = \App\Models\DreamDiaryRecords::whereId($dream_id ?? null)->first();
    $page_header = $dream->user->name.' ';
    if($dream->date != null && $dream->date != '') $page_header = $page_header.date('d.m.Y', strtotime($dream->date));
    $page_header = $page_header.' - '.$dream->title;
@endphp

@section('title')
    {{ $page_header }} - Сон
@endsection

@section('head')
    <link rel="stylesheet" href="/css/dreams.css">
    <script src="/js/images.js"></script>
@endsection

@section('content')
    <div class="text-block mt-3">
        <div class="d-flex flex-row flex-wrap justify-content-between">
            <h2>
                {{ $dream->user->name }}
                @if($dream->date != null && $dream->date != '')
                    {{ date('d.m.Y', strtotime($dream->date)) }}
                @endif
                -
                {{ $dream->title }}
            </h2>
            @if(!is_null($user))
                @if($dream->user_id == $user->id)
                    <div class="tag-style ml-2" style="border-radius: 20px; height: 40px;">
                        <a href="/dream/{{ $dream->id }}/edit" style="color: white; font-size: 1.5em;">Редактировать</a>
                    </div>
                @endif
            @endif
            @if($dream->hidden == 1)
                <span style="color: dimgray">Сон скрыт</span>
            @endif
        </div>
        <div class="m-2 d-flex flex-row flex-wrap">
            @foreach($dream->images as $image)
                <div class="m-1"><img src="/images/dreams/{{ $dream->id }}/{{ $image->filename }}" class="viewable"
                                      style="max-width: 200px; max-height: 300px;"></div>
            @endforeach
        </div>
        <p>{!! $dream->description !!}</p>
        <div class="m-2 d-flex flex-row flex-wrap">
            @foreach($dream->tags as $tag)
                <div class="tag-style m-1"><a href="/dreams?search={{ $tag->name }}"
                                              style="color: white; text-decoration: none;">{{ $tag->name }}</a></div>
            @endforeach
        </div>
    </div>
@endsection

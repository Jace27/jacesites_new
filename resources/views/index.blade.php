@extends('layouts.main')

@section('title')
    Главная страница
@endsection

@section('content')
    <div class="text-block mt-3">
        @foreach (\App\Models\TitleEvents::query()->orderByDesc('id')->limit(20)->get() as $event)
            <p>
                <b><a href="{!! $event->page->link !!}">{!! $event->page->name !!}</a>: {!! $event->title !!}</b>
                {!! $event->description !!}
            </p>
        @endforeach
    </div>
@endsection

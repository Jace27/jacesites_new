@extends('layouts.main')

@section('title')
    Редактировать сон
@endsection

@section('head')
    <script src="/js/tinymce/tinymce.min.js"></script>
    <link rel="stylesheet" href="/css/dreams.css">
@endsection

@section('content')
    @php $dream = \App\Models\DreamdiaryRecords::whereId($dream_id ?? null)->first(); @endphp

    <div class="text-block mt-3">
        <form action="/api/dream/add" method="post" enctype="multipart/form-data">
            <div class="d-flex flex-row m-2">
                <span style="padding: .375rem .75rem">Дата:</span>
                <input type="date" class="form-control" value="{{ $dream->date }}" name="date">
            </div>
            <div class="d-flex flex-row m-2">
                <span style="padding: .375rem .75rem">Заголовок:</span>
                <input type="text" class="form-control" name="title" value="{{ $dream->title }}">
            </div>
            <div class="d-flex flex-column m-2">
                <span style="padding: .375rem .75rem">Зарисовки:</span>
                <div class="border mb-2 p-2" id="images">
                    @if(count($dream->images) == 0)
                        Нет изображений
                    @else
                        @foreach($dream->images as $image)
                            @php copy($_SERVER['DOCUMENT_ROOT'].'/images/dreams/'.$dream->id.'/'.$image->filename, $_SERVER['DOCUMENT_ROOT'].'/images/temp/'.$image->filename); @endphp
                            <img src="/images/temp/{{ $image->filename }}" data-filename="{{ $image->filename }}">
                        @endforeach
                    @endif
                </div>
                <input type="file" accept="image/*" multiple class="d-none" name="images">
                <button class="btn btn-primary btn-attach-image">Загрузить изображение</button>
            </div>
            <div class="d-flex flex-column m-2">
                <span style="padding: .375rem .75rem">Описание:</span>
                <textarea class="form-control w-100" style="min-height: 150px;"
                          name="description">{!! str_replace('<br>', "\r\n", $dream->description) !!}</textarea>
            </div>
            <div class="d-flex flex-column m-2">
                <span style="padding: .375rem .75rem">Теги:</span>
                <div>
                    <input type="text" class="form-control" name="tags_search">
                    <div class="position-relative">
                        <div class="tags__suggestions tags"></div>
                    </div>
                </div>
                <div class="tags__selected tags">
                    @foreach($dream->tags as $tag)
                        <div class="tag tag-style" data-id="{{ $tag->id }}"><span>{{ $tag->name }}</span></div>
                    @endforeach
                </div>
            </div>
            <div class="d-flex flex-row m-2 justify-content-center">
                <button class="btn btn-primary btn-save-dream">Сохранить сон</button>
                <div class="ml-2">
                    <label class="form-control" style="margin: 0 auto;">
                        <input type="checkbox" name="hide" @if($dream->hidden == 1) checked @endif>
                        <span>Скрыть сон</span>
                    </label>
                </div>
            </div>
        </form>
    </div>

    <script src="/js/dump.js"></script>
    <script>
        const url = '/api/dream/{{ $dream->id }}/edit';
        const dump_type = 'dream-edit';
    </script>
    <script src="/js/dreams.js"></script>
    <script>
        tags.elements = [
            @foreach($dream->tags as $tag)
                {
                    'id': '{{ $tag->id }}',
                    'name': '{{ $tag->name }}',
                },
            @endforeach
        ];
        files = [
            @foreach($dream->images as $image)
                '{{ $image->filename }}',
            @endforeach
        ];
    </script>
@endsection

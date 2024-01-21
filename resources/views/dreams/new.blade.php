@extends('layouts.main')

@section('title')
    Новый сон
@endsection

@section('head')
    <script src="/js/tinymce/tinymce.min.js"></script>
    <link rel="stylesheet" href="/css/dreams.css">
@endsection

@section('content')
    @php $all_records_count = (double)(\App\Models\DreamDiaryRecords::query()->count()?:1); @endphp
    <div class="text-block mt-3">
        <form action="/api/dream/add" method="post" enctype="multipart/form-data">
            <div class="d-flex flex-row m-2">
                <span style="padding: .375rem .75rem">Дата:</span>
                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="date">
            </div>
            <div class="d-flex flex-row m-2">
                <span style="padding: .375rem .75rem">Заголовок:</span>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="d-flex flex-column m-2">
                <span style="padding: .375rem .75rem">Зарисовки:</span>
                <div class="border mb-2 p-2" id="images">Нет изображений</div>
                <input type="file" accept="image/*" multiple class="d-none" name="images">
                <button class="btn btn-primary btn-attach-image">Загрузить изображение</button>
            </div>
            <div class="d-flex flex-column m-2">
                <span style="padding: .375rem .75rem">Описание:</span>
                <textarea class="form-control w-100" style="min-height: 150px;" name="description"></textarea>
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
                    @foreach(\App\Models\DreamDiaryTags::query()->get() as $tag)
                        @if((double)$tag->getUses() / $all_records_count > 0.9)
                            <div class="tag tag-style" data-id="{{ $tag->id }}"><span>{{ $tag->name }}</span></div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="d-flex flex-row m-2 justify-content-center">
                <button class="btn btn-primary btn-save-dream">Сохранить сон</button>
                <div class="ml-2">
                    <label class="form-control" style="margin: 0 auto;">
                        <input type="checkbox" name="hide">
                        <span>Скрыть сон</span>
                    </label>
                </div>
            </div>
        </form>
    </div>

    <script src="/js/dump.js"></script>
    <script>
        const url = '/api/dream/add';
        const dump_type = 'dream-add';
    </script>
    <script src="/js/dreams.js"></script>
    <script>
        tags.elements = [
            @foreach(\App\Models\DreamDiaryTags::query()->get() as $tag)
                @if((double)$tag->getUses() / $all_records_count > 0.9)
                    {
                        'id': '{{ $tag->id }}',
                        'name': '{{ $tag->name }}',
                    },
                @endif
            @endforeach
        ];
    </script>
@endsection

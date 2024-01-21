@extends('layouts.main')

@section('title')
    Сны
@endsection

@section('head')
    <link rel="stylesheet" href="/css/dreams.css">
@endsection

@section('content')
    <div class="text-block mt-3">
        <div class="d-flex flex-row">
            <input type="text" class="form-control mr-2" name="search" data-type="online" data-target="dreams"
                   @if(isset($_GET['search'])) value="{{ $_GET['search'] }}" @endif >
            <button class="btn btn-primary btn-page-search">Искать</button>
        </div>
    </div>

    <div id="search-results" class="text-block mt-3" style="display: none;"></div>

    <div class="text-block mt-3" id="page">
        @php
            $user = \Illuminate\Support\Facades\Auth::user();
            $paginator = \App\Models\DreamdiaryRecords::query()->orderByDesc('date')->paginate(10, ['*'], 'page');
            /** @var \App\Models\DreamdiaryRecords $dream */
        @endphp
        @foreach($paginator as $dream)
            @if($dream->hidden == 0 || ($user != null && $user->id == $dream->user_id))
                <div class="m-2 p-2 search-result" style="border: 1px solid gray; border-radius: 10px;"
                     onclick="window.location.assign('/dream/{{ $dream->id }}')">
                    <a href="/dream/{{ $dream->id }}"><b>
                            {{ $dream->user->name }}
                            @if($dream->date != null && $dream->date != '')
                                {{ date('d.m.Y', strtotime($dream->date)) }}
                            @endif
                            -
                            {{ $dream->title }}
                        </b></a>
                    @if($dream->hidden == 1)
                        <span style="color: dimgray">Сон скрыт</span>
                    @endif
                    <div class="d-flex flex-row flex-wrap">
                        @foreach($dream->tags as $tag)
                            <div class="tag-style m-1">{{ $tag->name }}</div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
        {{ $paginator->links('vendor.pagination.bootstrap-4') }}
    </div>

    <script src="/js/search.js"></script>
    <script>
        $(document).ready(function () {
            if ($('input[name=search]').val().trim() != '')
                search($('input[name=search]').val().trim());

            $('.tag-style').css('cursor', 'pointer');
            $('.tag-style').unbind('click');
            $('.tag-style').click(function (e) {
                e.stopPropagation();
                $('input[name=search]').val($(this).text());
                search($(this).text());
            });

            $('#search-results').on('DOMSubtreeModified', function (e) {
                $('.tag-style').css('cursor', 'pointer');
                $('.tag-style').unbind('click');
                $('.tag-style').click(function (e) {
                    e.stopPropagation();
                    $('input[name=search]').val($(this).text());
                    search($(this).text());
                });
            });
        });
    </script>
@endsection

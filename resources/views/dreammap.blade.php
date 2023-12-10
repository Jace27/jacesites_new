@extends('layouts.main')

@section('title')
Интерактивная карта сновиденного мира @endsection

@section('head')
    <script type="text/javascript">
        function show_hide(id) {
            var item = document.getElementById(id);
            if (items != null) {
                if (item.style.display == 'none') {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            }
        }

        function show(id) {
            var items = document.getElementById(id);
            if (items != null) {
                items.style.display = 'block';
                items.scrollIntoView();
            }
        }

        function hide(id) {
            var items = document.getElementById(id);
            if (items != null) items.style.display = 'none';
            document.getElementById('map').scrollIntoView();
        }

        function show_all() {
            document.getElementById('hideall').style.display = 'block';
            var elem = document.getElementById('select1').options.selectedIndex;
            var id = document.getElementById('select1').options[document.getElementById('select1').options.selectedIndex].id;
            var collect = document.getElementsByClassName(id);
            for (var i = 0; i < collect.length; i++) {
                collect[i].style.display = 'block';
                console.log(i);
                console.log(collect[i]);
            }
            document.getElementById('список').scrollIntoView();
        }

        function hide_all() {
            document.getElementById('hideall').style.display = 'none';
            var collect = document.getElementsByClassName('sel1optall');
            for (var i = 0; i < collect.length; i++) {
                collect[i].style.display = 'none';
            }
            document.getElementById('список').scrollIntoView();
        }
    </script>
    <style>
        body {
            padding-bottom: 30px;
            width: calc(100% - 15px)
        }

        h1 {
            text-align: center;
            font-size: 20px
        }

        img {
            margin: 5px
        }

        .text {
            width: 100%;
        }

        .menu {
            border-style: solid;
            border-width: 0px 0px 0px 5px;
            border-color: #A3B1C0;
            background-color: #fff;
            margin-top: 20px;
            margin-left: 30px;
            padding: 10px 10px 10px 20px;
            text-align: left;
            width: 500px
        }

        .to_start {
            background-color: #fff;
            top: 30px;
            right: 20px;
            position: fixed;
            width: 87px;
            height: 53px
        }

        .glava {
            font-size: 19px
        }

        .quote:not(.nav) {
            font-size: 19px;
            border-style: solid;
            border-width: 0px 0px 0px 5px;
            border-color: #A3B1C0;
            background-color: #fff;
            padding: 10px;
            width: calc(100% - 40px);
        }

        .hide {
            display: none;
            border-style: solid;
            border-width: 1px 1px 1px 1px;
            border-color: #000;
            padding: 5px;
            margin-right: 5px;
        }

        .quote_author {
            color: #ff0000;
            font-weight: bold
        }

        .smile {
            margin: -1px
        }

        .link_on_loc {
            min-width: 400px;
        }

        .iscopied {
            opacity: 0;
            margin-left: 15px;
            display: inline-block;
            vertical-align: middle;
            margin-top: inherit;
        }

        button {
            margin: 0.3em;
        }

        span a {
            color: inherit;
            text-decoration: underline;
        }
    </style>
@endsection

@section('content')
    <div class="text text-block mt-3">
        <h4>Кликните по месту на карте и, если об этой локации есть информация, вы ее увидите</h4>
        <h5 id="countloc">На данный момент страница содержит описание {{ count(\App\Models\DreamsLocations::all()) }}
            локаций</h5>
        <div class="glava">
            <a name="map"></a>
            <div
                style="overflow: scroll; height: 600px; width: 100%; border-style: solid; border-width: 1px 1px 1px 1px; border-color: #000">
                <img src="/resources/dreammap/WKsepu5N1Ho.jpg" style="width: 1624px" usemap="#dreammap" id="map">
                <map name="dreammap">
                    @foreach(\App\Models\DreamsLocations::where('map_coords', '<>', null)->get() as $location)
                        <area href="javascript:show('{{ $location->slug }}')" coords="{{ $location->map_coords }}"
                              shape="{{ $location->map_shape }}" title="{{ $location->name }}">
                    @endforeach
                </map>
            </div>
            Условные обозначения:<br>
            <img src="/resources/dreammap/lab.bmp"
                 style="border-style: solid; border-width: 1px 1px 1px 1px; border-color: #000; margin: -1px; height: 20px">
            зоны лабиринтов.<br>
            <img src="/resources/dreammap/lumin.bmp"
                 style="border-style: solid; border-width: 1px 1px 1px 1px; border-color: #000; margin: -1px; height: 20px">
            точки светимости.<br>
            <img src="/resources/dreammap/dlILkZpHgac.jpg"
                 style="border-style: solid; border-width: 1px 1px 1px 1px; border-color: #000; margin: -1px; height: 20px">
            ядро светимости.<br>
            <img src="/resources/dreammap/trans.bmp"
                 style="border-style: solid; border-width: 1px 1px 1px 1px; border-color: #000; margin: -1px; height: 20px">
            зоны трансмутаций.<br>
            <img src="/resources/dreammap/ally.bmp"
                 style="border-style: solid; border-width: 1px 1px 1px 1px; border-color: #000; margin: -1px; height: 20px">
            дружелюбные и нейтральные неорганические существа.<br>
            <img src="/resources/dreammap/transit.bmp"
                 style="border-style: solid; border-width: 1px 1px 1px 1px; border-color: #000; margin: -1px; height: 20px">
            транзит в отдаленную позицию ТС.<br><br>
            <a id="список"></a>
            <select id="select1" class="form-control">
                <option selected disabled id="dis">Выберите группу локаций для показа</option>
                <option id="sel1optall">Все</option>
                @foreach(\App\Models\DreamsLocationsTypes::all() as $type)
                    <option id="sel1opt{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            <button id="showall" onclick="show_all()" style="float: left" class="btn btn-primary">Показать описание
                выбранных локаций
            </button>
            <button id="hideall" onclick="hide_all()" style="display:none" class="btn btn-secondary">Скрыть описание
                всех локаций
            </button>
            <br><br>
            @foreach(\App\Models\DreamsLocations::all() as $location)
                <div
                    class="hide sel1optall @foreach($location->types as $type) sel1opt{{ $type->id }} @endforeach "
                    id="{{ $location->slug }}">
                    <h2>{{ $location->name }}</h2>
                    <span>Ссылка на локацию: </span><input type="text" class="link_on_loc" value=""><span
                        class="iscopied" id="is-copied-label">Скопировано!</span><br><br>
                    <div>{!! $location->description !!}</div>
                    <a href="javascript:hide('{{ $location->slug }}')">скрыть</a>
                </div>
            @endforeach
        </div>
        <script>
            var search = "";
            if (window.location.search !== "") {
                search = window.location.search.substring(1).split('&').map(function (item) {
                    return item.split('=');
                });

                for (var i = 0; i < search.length; i++) {
                    if (search[i][0] == 'location') {
                        show(search[i][1]);
                    }
                }
            }
        </script>
    </div>
    <script type="text/javascript">
        $('.link_on_loc').each(function (index, elem) {
            $(this).attr('value', window.location.origin + window.location.pathname + '?location=' + $(this).parent().attr('id'));
        });
        $('.link_on_loc').on('click', function () {
            $(this).select();
            document.execCommand('copy');
            $(this).next().animate({opacity: "1"}, 100);
            $(this).next().animate({opacity: "0"}, 3000);
        });
    </script>
@endsection

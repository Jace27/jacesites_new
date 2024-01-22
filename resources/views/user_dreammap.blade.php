@extends('layouts.main')

@section('title')
{{ $user->name }} - Карта сновиденного мира @endsection

@section('head')
    <style>
        .map {
            position: relative;
            border: 1px solid black;
        }

        .map-editor {
            display: flex;
        }

        .map-editor > * {
            margin: 0.5em;
        }

        .map-editor {
            flex-direction: column;
        }

        .images {
            max-height: 300px;
            overflow-x: hidden;
            overflow-y: auto;
            border: 1px black solid;
            border-radius: 3px;
            padding: 3px;
        }

        .images > div {
            text-align: center;
            align-content: center;
            border: 1px gray solid;
            border-radius: 3px;
            padding: 3px;
            margin-top: 3px;
        }

        .images span {
            word-wrap: break-spaces;
            max-width: 100px;
            overflow: hidden;
            line-height: 100%;
            margin: 3px auto;
        }

        .images .image-wrapper {
            width: 100px;
            height: 100px;
            background-position: center;
            background-size: cover;
        }

        .location-image-added {
            background-color: rgba(192,192,192,0.5);
        }

        canvas {
            width: 100%;
        }

        .scale_input {
            background-color: white;
            padding: 10px;
            border-radius: 3px;
            position: absolute;
            left: 20px;
            top: calc(50% - 150px);
        }

        input[type=range][orient=vertical] {
            writing-mode: bt-lr; /* IE */
            -webkit-appearance: slider-vertical; /* WebKit */
            width: 10px;
            height: 300px;
        }

        .location_settings { z-index: 1000; }
        .location_settings, .map_settings {
            grid-template-columns: 2fr 3fr;
        }
        .location_settings > *, .map_settings > * {
            padding: 0.25em;
            line-height: 1.2;
        }
        .location_settings input, .map_settings input {
            width: calc(100% - 2.2em);
            border-radius: 5px;
            border: 1px solid gray;
            padding: 0.25em;
        }
        .location_settings {
            position: fixed;
            bottom: 10px;
            left: 10px;
            right: 10px;
            height: 33%;
            overflow-y: auto;
        }
        /*.location_settings > div:nth-child(even):after {
            display: inline-block;
            content: '?';
            margin-left: 1em;
            padding: 0.01em 0.4em;
            background-color: rgba(192,192,192,0.5);
            color: rgb(96,96,96);
            border-radius: 0.6em;
            width: 1.2em;
            height: 1.2em;
        }*/
    </style>
@endsection

@section('content')
    <div class="text-block mt-3">
        <h3>Карта сновиденного мира {{ $user->name }}</h3>

        <div class="map-editor">
            @if($can_edit)
                <div class="images">
                    @foreach($user->dream_records()->orderBy('date')->get() as $dream)
                        @foreach($dream->images()->get() as $image)
                            <div class="d-inline-flex flex-column justify-content-between location-image"
                                 data-id="{{ $image->id }}"
                                 data-file-name="/images/dreams/{{ $dream->id }}/{{ $image->filename }}">
                                <div class="image-wrapper"
                                     style="background-image: url('/images/dreams/{{ $dream->id }}/{{ $image->filename }}')">
                                    &nbsp;
                                </div>
                                <span>
                                    <a href="/dream/{{ $dream->id }}" target="_blank">
                                        @if($dream->date != null && $dream->date != '')
                                            {{ date('d.m.Y', strtotime($dream->date)) }} <br>
                                        @endif
                                        {{ $dream->title }}
                                    </a>
                                </span>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            @endif
            <div class="map">
                <div class="scale_input"><input type="range" orient="vertical" min="1" max="100" step="0.001" value="100"></div>
                <canvas id="canvas"></canvas>
            </div>
            <div class="text-block location_settings" style="display: none;">
                <div>Положение по горизонтали:</div>
                <div><input type="number" step="0.000000000000000001" class="input-x"></div>
                <div>Положение по вертикали:</div>
                <div><input type="number" step="0.000000000000000001" class="input-y"></div>
                <div>Ширина:</div>
                <div><input type="number" step="0.000000000000000001" class="input-w"></div>
                <div>Высота:</div>
                <div><input type="number" step="0.000000000000000001" class="input-h"></div>
                <div>Поворот:</div>
                <div><input type="number" min="0" max="360" step="0.000000000000000001" class="input-r"></div>
                <div>Порядок:</div>
                <div><input type="number" min="0" max="0" step="1" class="input-z"></div>
                <div style="grid-column-start: 1; grid-column-end: 3;">
                    <button class="clear btn btn-outline-danger mr-2">Убрать с карты</button>
                    <button class="repair_ration btn btn-outline-primary">Восстановить соотношение сторон</button>
                </div>
            </div>
            <div class="map_settings" style="display: grid">
                <div>Качество отрисовки:</div>
                <div><input type="number" min="1" max="100" step="0.01" value="25" class="input-resolution"></div>
                <div>Отображать фоновую карту:</div>
                <div><input type="checkbox" checked class="input-map"></div>
                @if($can_edit)
                    <div class="m-2 justify-content-center">
                        <button class="btn btn-primary btn-save-map">Сохранено</button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        let resolution_scale = 0.25;
        let selection_color = 'blue';
        let viewfield_x = 0;
        let viewfield_y = 0;
        let viewfield_z = 100;

        let show_arch_map = true;
        let arch_map_ready = false;
        let arch_map = new Image();
        arch_map.src = '/resources/dreammap/WKsepu5N1Ho.jpg';
        arch_map.onload = function () {
            arch_map_ready = true;
            LoadMap();
            CreateBuffer();
            DrawCanvas();
        }

        let locations = [
            /*
            {
                id: 1,
                x: 0.001,
                y: 0.005,
                w: 0.003,
                h: 0.004,
                r: 45,
                z: 1,
                image: new Image()
            }
             */
        ];
        let selected_location = -1;

        let map = $('#canvas')[0];
        map.width = 1624;
        map.height = 1650;
        let map_ctx = map.getContext('2d');
        $('#canvas').css('width', '100%');

        let buffer, buffer_ctx;

        @if($can_edit)
        $('.btn-save-map').click(function(){
            SaveMap();
        });

        $('.image-wrapper').click(function () {
            $('.btn-save-map').html('Не сохранено');
            if ($(this).parent().hasClass('location-image-added')) {
                for (let l = 0; l < locations.length; l++) {
                    if (locations[l].id == $(this).parent()[0].dataset.id) {
                        selected_location = l;
                        DisplaySelectedLocation();
                        DrawCanvas();
                    }
                }
                return;
            }
            let img = {
                id: 0,
                x: viewfield_x / 100.0 + viewfield_z / 100.0 * 0.25,
                y: viewfield_y / 100.0 + viewfield_z / 100.0 * 0.25,
                w: viewfield_z / 100.0 * 0.5,
                h: viewfield_z / 100.0 * 0.5,
                r: 0,
                z: locations.length,
                image: new Image()
            };
            img.id = $(this).parent()[0].dataset.id;
            img.image.src = $(this).parent()[0].dataset.fileName;
            img.h = img.image.height / img.image.width * img.w;
            let ok = true;
            for (let l = 0; l < locations.length; l++) {
                if (locations[l].id == img.id) {
                    ok = false;
                }
            }
            if (ok) {
                locations.push(img);
                $('.location_settings .input-z').attr('max', locations.length - 1);
                selected_location = locations.length - 1;
                DisplaySelectedLocation();
                $(this).parent().addClass('location-image-added');
                DrawCanvas();
            }
        });

        $('.location_settings input').on('input', function(e){
            $('.btn-save-map').html('Не сохранено');
            let invalids = [];
            $('.location_settings input:invalid').each(function(){
                invalids.push(this.className);
            });
            if (invalids.indexOf(this.className) != -1)
                return;
            if ($(this).val() === undefined || $(this).val() === null || $(this).val().trim() === '')
                return;

            switch (this.className) {
                case 'input-x':
                    locations[selected_location].x = $(this).val() / 100.0;
                    break;
                case 'input-y':
                    locations[selected_location].y = $(this).val() / 100.0;
                    break;
                case 'input-w':
                    locations[selected_location].w = $(this).val() / 100.0;
                    break;
                case 'input-h':
                    locations[selected_location].h = $(this).val() / 100.0;
                    break;
                case 'input-r':
                    locations[selected_location].r = $(this).val();
                    break;
                case 'input-z':
                    if ($(this).val() < locations.length) {
                        let loc = locations[selected_location];
                        locations.splice(selected_location, 1);
                        locations.splice($(this).val(), 0, loc);
                        selected_location = $(this).val();
                        for (let l = 0; l < locations.length; l++)
                            locations[l].z = l;
                    }
                    break;
            }
            DrawCanvas();
        });

        $('.location_settings .clear').click(function(e){
            $('.btn-save-map').html('Не сохранено');
            $('.location-image-added').each(function(){
                if (locations[selected_location].id == $(this)[0].dataset.id){
                    $(this).removeClass('location-image-added');
                }
            });
            locations.splice(selected_location, 1);
            for (let l = 0; l < locations.length; l++){
                locations[l].z = l;
            }
            $('.location_settings .input-z').attr('max', locations.length - 1);
            selected_location = -1;
            DisplaySelectedLocation();
            DrawCanvas();
        });

        $('.location_settings .repair_ration').click(function(e){
            $('.btn-save-map').html('Не сохранено');
            locations[selected_location].h = locations[selected_location].image.height / locations[selected_location].image.width * locations[selected_location].w;
            DisplaySelectedLocation();
            DrawCanvas();
        });
        @endif

        $('.scale_input input[type=range]').on('input', function(e){
            viewfield_x -= ($(this).val() - viewfield_z) / 2;
            viewfield_y -= ($(this).val() - viewfield_z) / 2;
            viewfield_z = $(this).val();
            if ($('.map_settings .input-resolution').val() / 100.0 == 0.25 ||
                $('.map_settings .input-resolution').val() / 100.0 == 0.50 ||
                $('.map_settings .input-resolution').val() / 100.0 == 0.75 ||
                $('.map_settings .input-resolution').val() / 100.0 == 1.00) {
                if (viewfield_z > 0) resolution_scale = 1.00;
                if (viewfield_z > 25) resolution_scale = 0.75;
                if (viewfield_z > 50) resolution_scale = 0.50;
                if (viewfield_z > 75) resolution_scale = 0.25;
                $('.map_settings .input-resolution').val(resolution_scale * 100.0);
            }
            DrawCanvas();
        });

        $('.map_settings .input-resolution').on('input', function(e){
            let invalids = [];
            $('.map_settings input:invalid').each(function(){
                invalids.push(this.className);
            });
            if (invalids.indexOf(this.className) != -1)
                return;
            if ($(this).val() === undefined || $(this).val() === null || $(this).val().trim() === '')
                return;

            resolution_scale = $(this).val() / 100.0;
            CreateBuffer();
            DrawCanvas();
        });

        $('.map_settings .input-map').on('change', function(e){
            show_arch_map = $(this).prop('checked');
            DrawCanvas();
        });

        let moving_map = false;
        let moving_location = null;

        $('.map canvas').on('mousedown', function(e){
            let cursor = {
                top:  (((e.originalEvent.pageY - $('.map canvas').offset().top)  / $('.map canvas').height()) * (viewfield_z *  buffer.height / 100.0) + (viewfield_y * buffer.height / 100.0)) / buffer.height,
                left: (((e.originalEvent.pageX - $('.map canvas').offset().left) / $('.map canvas').width())  * (viewfield_z *  buffer.width  / 100.0) + (viewfield_x * buffer.width  / 100.0)) / buffer.width
            };

            @if($can_edit)
            for (let l = locations.length - 1; l >= 0; l--){
                if (locations[l].x < cursor.left && locations[l].x + locations[l].w > cursor.left &&
                    locations[l].y < cursor.top  && locations[l].y + locations[l].h > cursor.top){
                    moving_location = locations[l];
                    selected_location = l;
                    DisplaySelectedLocation();
                    DrawCanvas();
                    console.log('moving location');
                    return;
                }
            }
            @endif

            console.log('moving map');
            moving_map = true;
            selected_location = -1;
            DisplaySelectedLocation();
            DrawCanvas();
        });

        let last_cursor = null;
        $('.map canvas').on('mousemove', function(e){
            if (e.originalEvent.buttons !== 1){
                moving_map = false;
                last_cursor = null;
                return;
            }
            let new_cursor = {
                y: (((e.originalEvent.pageY - $('.map canvas').offset().top)  / $('.map canvas').height()) * (viewfield_z *  buffer.height / 100.0)) / buffer.height,
                x: (((e.originalEvent.pageX - $('.map canvas').offset().left) / $('.map canvas').width())  * (viewfield_z *  buffer.width  / 100.0)) / buffer.width
            };
            if (last_cursor !== null) {
                if (new_cursor.x != last_cursor.x || new_cursor.y != last_cursor.y) {
                    if (moving_map) {
                        viewfield_x = (viewfield_x - (new_cursor.x - last_cursor.x) * 100.0);
                        viewfield_y = (viewfield_y - (new_cursor.y - last_cursor.y) * 100.0);
                    }
                    @if($can_edit)
                    if (moving_location !== null) {
                        $('.btn-save-map').html('Не сохранено');
                        moving_location.x = moving_location.x + (new_cursor.x - last_cursor.x);
                        moving_location.y = moving_location.y + (new_cursor.y - last_cursor.y);
                    }
                    @endif
                    if (moving_map || moving_location) {
                        @if($can_edit) DisplaySelectedLocation(); @endif
                        DrawCanvas();
                    }
                }
            }
            last_cursor = new_cursor
        });

        $('.map canvas').on('mouseup', function(e){
            moving_map = false;
            moving_location = null;
            last_cursor = null;
        });

        function CreateBuffer(){
            buffer = document.createElement('canvas');
            buffer.width = 16240 * resolution_scale * 1.25;
            buffer.height = 16500 * resolution_scale * 1.25;
            buffer_ctx = buffer.getContext('2d');
            buffer_ctx.fillStyle = 'white';
            buffer_ctx.fillRect(0, 0, buffer.width, buffer.height);
        }

        function DrawCanvas() {
            buffer_ctx.fillStyle = 'white';
            buffer_ctx.fillRect(0, 0, buffer.width, buffer.height);

            if (show_arch_map) {
                buffer_ctx.drawImage(arch_map, 0, 0, buffer.width, buffer.height);
            }

            for (let l = 0; l < locations.length; l++) {
                DrawRotated(buffer_ctx, buffer, locations[l], selected_location == l);
                buffer_ctx.strokeStyle = selection_color;
                buffer_ctx.lineWidth = 5 * 1 / resolution_scale;
                if (selected_location == l) buffer_ctx.strokeRect((buffer.width * locations[l].x - buffer_ctx.lineWidth / 2), (buffer.height * locations[l].y - buffer_ctx.lineWidth / 2), buffer.width * locations[l].w + buffer_ctx.lineWidth, buffer.height * locations[l].h + buffer_ctx.lineWidth);
            }

            map_ctx.fillStyle = 'white';
            map_ctx.fillRect(0, 0, map.width, map.height);
            map_ctx.drawImage(buffer,
                              buffer.width * viewfield_x / 100.0, buffer.height * viewfield_y / 100.0,
                              buffer.width * viewfield_z / 100.0, buffer.height * viewfield_z / 100.0,
                              0, 0, map.width, map.height);
        }

        function DrawRotated(ctx, canvas, location, selected) {
            let x, y, w, h;
            x = canvas.width * location.x;
            y = canvas.height * location.y;
            w = canvas.width * location.w;
            h = canvas.height * location.h;
            ctx.save();
            ctx.translate(x + w / 2, y + h / 2);
            ctx.rotate(location.r * Math.PI / 180);
            ctx.drawImage(location.image, -w / 2, -h / 2, w, h);
            ctx.restore();
        }

        function LoadMap(){
            ajax({
                url: '/api/dreammap/load/{{ $user->name }}',
                method: 'get',
                success: function(data){
                    if (data.status == 'success'){
                        locations = [];
                        selected_location = -1;
                        moving_location = null;
                        for (let l = 0; l < data.locations.length; l++){
                            locations.push({
                                id: data.locations[l].id,
                                x: data.locations[l].x,
                                y: data.locations[l].y,
                                w: data.locations[l].w,
                                h: data.locations[l].h,
                                r: data.locations[l].r,
                                z: data.locations[l].z,
                                image: new Image()
                            });
                            locations[locations.length - 1].image.src = '' + data.locations[l].image;
                            $('.location_settings .input-z').attr('max', locations.length - 1);
                            $('.image-wrapper').each(function(){
                                if ($(this).parent()[0].dataset.id == data.locations[l].id){
                                    $(this).parent().addClass('location-image-added');
                                }
                            });
                        }
                        DrawCanvas();
                    } else if (data.message != null) {
                        show_message('Ошибка', data.message);
                    } else {
                        show_message('Ошибка', 'Неизвестная ошибка');
                    }
                }
            });
        }

        @if($can_edit)
        function DisplaySelectedLocation(){
            if (selected_location != -1) {
                let loc = locations[selected_location];
                $('.location_settings input.input-x').val(loc.x * 100);
                $('.location_settings input.input-y').val(loc.y * 100);
                $('.location_settings input.input-w').val(loc.w * 100);
                $('.location_settings input.input-h').val(loc.h * 100);
                $('.location_settings input.input-r').val(loc.r);
                $('.location_settings input.input-z').val(selected_location);
                $('.location_settings').css('display', 'grid');
            } else {
                $('.location_settings input').val(0);
                $('.location_settings').css('display', 'none');
            }
        }

        let saving = setInterval(SaveMap, 30000);
        function SaveMap(){
            $('.btn-save-map').html('Сохранение...');
            $('.btn-save-map').prop('disabled', true);
            let data = new FormData();
            data.append('user_id', {{ $user->id }});
            data.append('locations', JSON.stringify(locations));
            ajax({
                url: '/api/dreammap/save',
                method: 'post',
                data: data,
                success: function(data){
                    if (data.status == 'success'){
                        $('.btn-save-map').html('Сохранено');
                    } else if (data.message != null) {
                        show_message('Ошибка', data.message);
                        $('.btn-save-map').html('Произошла ошибка. Попробовать сохранить еще раз?');
                    } else {
                        show_message('Ошибка', 'Неизвестная ошибка');
                        $('.btn-save-map').html('Произошла ошибка. Попробовать сохранить еще раз?');
                    }
                    $('.btn-save-map').prop('disabled', false);
                }
            });
        }
        @endif
    </script>
@endsection

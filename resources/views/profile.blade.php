@extends('layouts.main')

@section('title')
Профиль @if(isset($requested_user)) - {{ $requested_user }} @endif @endsection

@section('head')
    <style>
        .tabs {
            padding-top: 1em;
        }

        .tabs_body {
            border: 1px solid #007bff;
            padding: 0.3em;
            margin-top: -1px;
            margin-left: -1px;
        }

        .tabs_body img {
            max-width: 200px;
            max-height: 200px;
        }

        .tabs_header_page {
            padding: 0.5em 1em;
            display: inline-block;
            border: 1px solid #007bff;
            margin-top: -1px;
            margin-left: -1px;
            cursor: pointer;
        }

        @media (min-width: 530px) {
            .tab_page table {
                width: 100%;
            }

            th:nth-child(1), td:nth-child(1) {
                width: calc(50% - 50px);
            }

            th:nth-child(2), td:nth-child(2) {
                width: calc(50% - 50px);
            }

            th:nth-child(3), td:nth-child(3) {
                text-align: center;
                width: 100px;
            }
        }

        @media (max-width: 529px) {
            th:nth-child(1), td:nth-child(1) {
                display: block;
                float: none;
                width: 100%;
            }

            th:nth-child(2), td:nth-child(2) {
                width: calc(100% - 39px);
                display: block;
                float: left;
            }

            th:nth-child(3), td:nth-child(3) {
                width: 39px;
                display: block;
                float: right;
                text-align: center;
                overflow: hidden;
            }
        }

        .form-control {
            max-width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="text-block mt-3">
        @php
            $user = "";
            $can_edit = false;
            $editor = \Illuminate\Support\Facades\Auth::user();

            if (isset($requested_user)) {
                $user = $requested_user;
            } else if (!is_null($editor)) {
                $user = $editor->name;
                $can_edit = true;
            } else {
                echo '<h1>Пустой запрос</h1>';
                die;
            }

            if (!is_null($editor)) {
                if (isset($requested_user) && $editor->name == $requested_user) {
                    $can_edit = true;
                }
            }

            /** @var \App\Models\User $user_data */
            $user_data = \App\Models\User::whereName($user)->first();
        @endphp
        @if (is_null($user_data))
            <h1>Пользователя не существует</h1>
        @else
            <br>
            <div class="tab_header">
                <div class="tabs_header_page" id="header_1" style="font-weight: 900">Личные данные</div>
                <div class="tabs_header_page" id="header_2" style="font-weight: 500">Статистика</div>
            </div>
            <div class="tabs_body">
                <div class="tab_page" id="page_1">
                    <table>
                        <tbody>
                        @if ($can_edit)
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Скрывать</th>
                            </tr>
                        @endif
                        <tr>
                            <td>Аватар</td>
                            <td><img id="avatar_img" src="{{ $user_data->getAvatarUrl() }}"></td>
                            @if ($can_edit)
                                <input name="avatar_filename" accept="image/*" class="d-none" type="file">
                            @endif
                            <td></td>
                        </tr>
                        @php /** @var \App\Models\Options $option */ @endphp
                        @foreach (\App\Models\Options::all() as $option)
                            @php
                                /** @var \App\Models\OptionsValues $value */
                                $value = $option->values()->where('user_id', $user_data->id)->firstOrNew(['user_id' => $user_data->id]);
                            @endphp
                            <tr>
                                <td>{{ $option->name }}</td>
                                <td>
                                    @if ($can_edit)
                                        <input name="{{ $option->name }}" class="form-control"
                                               value="{{ $value->value }}" {!! $option->input_attrs !!}>
                                    @elseif ($value->value != '' && $value->value != null)
                                        @if ($value->hidden)
                                            <span style="color: #aaa">Скрыто</span>
                                            @continue
                                        @endif
                                        {{ $value->value }}
                                    @else
                                        <p>Не указано</p>
                                    @endif
                                </td>
                                @if ($can_edit)
                                    <td>
                                        <input name="{{$option->name}}-hidden" type="checkbox"
                                               @if($value->hidden) checked @endif >
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        @if($can_edit)
                            <tr>
                                <td>Новый пароль</td>
                                <td>
                                    <input type="password" name="password" class="form-control">
                                </td>
                                <td></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="d-flex flex-row justify-content-center pt-1">
                        @if($can_edit)
                            <button class="btn btn-danger btn-flush-password mr-3">Сбросить пароль</button>
                            <button class="btn btn-primary btn-save-changes">Сохранить изменения</button>
                        @endif
                    </div>
                </div>
                <div class="tab_page" id="page_2">
                    <table>
                        <tbody>
{{--                        <tr>--}}
{{--                            <td>Всего снов</td>--}}
{{--                            <td>--}}
{{--                                @php $count = count($user_data->dream_records); @endphp--}}
{{--                                {{ count($user_data->dream_records) }}--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Первый сон</td>--}}
{{--                            <td>--}}
{{--                                @php--}}
{{--                                    $first = $user_data->dream_records()->whereNotNull('date')->orderBy('date')->first();--}}
{{--                                    if ($first != null) {--}}
{{--                                        $first = $user_data->dream_records()->whereNotNull('date')--}}
{{--                                            ->orderBy('date', 'asc')->first();--}}
{{--                                        if (!is_null($first)) $first = strtotime($first->date);--}}
{{--                                    }--}}
{{--                                @endphp--}}
{{--                                @if($first != null)--}}
{{--                                    {{ date('d.m.Y', $first) }}--}}
{{--                                @else--}}
{{--                                    Неизвестно--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Последний сон</td>--}}
{{--                            <td>--}}
{{--                                @php--}}
{{--                                    $last = $user_data->dream_records()->whereNotNull('date')->orderBy('date', 'desc')->first();--}}
{{--                                    if ($last != null) {--}}
{{--                                        $last = $user_data->dream_records()->whereNotNull('date')--}}
{{--                                            ->orderBy('date', 'desc')->first();--}}
{{--                                        $last = strtotime($last->date);--}}
{{--                                    }--}}
{{--                                @endphp--}}
{{--                                @if($last != null)--}}
{{--                                    {{ date('d.m.Y', $last) }}--}}
{{--                                @else--}}
{{--                                    Неизвестно--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Частота запоминания</td>--}}
{{--                            <td>--}}
{{--                                @if($first != null && $last != null)--}}
{{--                                    @php $delta = ($last - $first) / 86400; @endphp--}}
{{--                                    @if($delta != 0)--}}
{{--                                        {{ round($count / $delta, 2) }} в день--}}
{{--                                    @endif--}}
{{--                                @else--}}
{{--                                    Неизвестно--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Всего осознанных/контролируемых</td>--}}
{{--                            <td>--}}
{{--                                @php--}}
{{--                                    $count = 0;--}}
{{--                                    $dreams = $user_data->dream_records()->get();--}}
{{--                                    foreach ($dreams as $dream){--}}
{{--                                        $tags = $dream->tags()->get();--}}
{{--                                        foreach ($tags as $tag) {--}}
{{--                                            if ($tag->name == 'Осознанный' || $tag->name == 'Контролируемый'){--}}
{{--                                                $count++;--}}
{{--                                                break;--}}
{{--                                            }--}}
{{--                                        }--}}
{{--                                    }--}}
{{--                                @endphp--}}
{{--                                {{ $count }}--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    @if($can_edit)
        <div class="modal" tabindex="-1" role="dialog" id="confirmation_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Введите текущий пароль для обновления данных</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="password" name="old_pass" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary btn-save-changes">ОК</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        let pages = $('.tab_page');
        if (pages.length > 1) {
            for (let i = 1; i < pages.length; i++) {
                $(pages[i]).css('display', 'none');
            }
        }

        $('.tabs_header_page').click(function (e) {
            for (let i = 0; i < pages.length; i++) {
                if (pages[i].id.substring(5, pages[i].id.length) === e.target.id.substring(7, e.target.id.length)) {
                    $(pages[i]).css('display', 'block');
                } else {
                    $(pages[i]).css('display', 'none');
                }
            }
            let headers = $('.tabs_header_page');
            for (let i = 0; i < headers.length; i++) {
                if (headers[i].id === e.target.id) {
                    headers[i].style.fontWeight = '900';
                } else {
                    headers[i].style.fontWeight = '500';
                }
            }
        });

        @if ($can_edit)
            $('#avatar_img').click(function (e) {
                $('input[type=file][name=avatar_filename]').click();
            });
            $('input[type=file][name=avatar_filename]').change(function (e) {
                let data = new FormData();
                data.append('user', '{{ $user_data->name }}');
                data.append('avatar', this.files[0]);
                ajax({
                    url: '/api/user/avatar/upload',
                    method: 'post',
                    data: data,
                    success: function (data) {
                        if (data.status === 'success') {
                            window.location.reload();
                        } else {
                            show_message('Ошибка', data.message);
                        }
                    },
                    error: function (data) {
                        console.log(data);
                        show_message('Ошибка', data.responseJSON.message);
                    }
                })
            });

            $('.tabs_body .btn-save-changes').click(function () {
                if ($('input[name="password"]').val().trim() !== '') {
                    $('input[name="old_pass"]').val('');
                    $('#confirmation_modal').modal('show');
                } else {
                    $('#confirmation_modal .btn-save-changes').click();
                }
            });
            $('#confirmation_modal .btn-save-changes').click(function () {
                let data = new FormData();
                data.append('user', '{{ $user_data->name }}');
                if ($('input[name="password"]').val().trim() !== '') {
                    data.append('old_password', sha256($('input[name="old_pass"]').val().trim()));
                    data.append('password', sha256($('input[name="password"]').val().trim()));
                }
                $('.tabs_body input:not([name="avatar_filename"])').each(function (index, element) {
                    if ($(this).attr('name') === 'password') return;
                    if ($('input[name="' + $(this).attr('name') + '"]:invalid').length === 0) {
                        if ($(this).attr('name').indexOf('-hidden') === -1) {
                            data.append($(this).attr('name'), $(this).val().trim());
                        } else {
                            if ($(this).prop('checked') === false)
                                data.append($(this).attr('name'), '0');
                            else if ($(this).prop('checked') === true)
                                data.append($(this).attr('name'), '1');
                        }
                    }
                });
                ajax({
                    url: '/api/user/options/change',
                    method: 'post',
                    data: data,
                    success: function (data) {
                        if (data.status === 'success') {
                            window.location.reload();
                        } else {
                            show_message('Ошибка', data.message);
                        }
                    },
                    error: function (data) {
                        show_message('Ошибка', data.responseJSON.message);
                    }
                });
            });
        @endif

        @if((isset($requested_user) && $editor->name != $requested_user) && $can_edit)
        $('.btn-flush-password').click(function () {
            $('.btn-flush-password').prop('disabled', true);
            $('.btn-flush-password').html('Загрузка');
            ajax({
                url: '/api/user/{{ $user_data->id }}/password-flush',
                method: 'get',
                async: true,
                success: function (data) {
                    if (data.status === 'success') {
                        show_message('Новый пароль', data.password);
                    } else {
                        console.log(data);
                    }
                    if (data.message !== undefined) {
                        show_message('Ошибка', data.message);
                    }
                    $('.btn-flush-password').prop('disabled', false);
                    $('.btn-flush-password').html('Сбросить пароль');
                },
                error: function (data) {
                    console.log(data);
                    $('.btn-flush-password').prop('disabled', false);
                    $('.btn-flush-password').html('Сбросить пароль');
                }
            });
        });
        @endif
    </script>
@endsection

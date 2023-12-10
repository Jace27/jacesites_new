@extends('layouts.main')

@section('title')
Сохранения переписок @endsection

@section('content')
    <div class="d-flex flex-column text-block mt-3">
        <div class="d-flex flex-row p-2">
            <a href="/save/symbols1" class="text-decoration-none">
                <img src="/images/saves/symbols.jpg" class="rounded-circle" style="max-height: 50px;">
                <span class="mt-auto mb-auto ml-2">Исследование символов (25.10.2016 - 20.03.2017)</span>
            </a>
        </div>
        <div class="d-flex flex-row p-2">
            <a href="/save/campfire1" class="text-decoration-none">
                <img src="/images/saves/campfire.jpg" class="rounded-circle" style="max-height: 50px;">
                <span class="mt-auto mb-auto ml-2">Исследование Костра (13.11.2017 - 05.12.2017)</span>
            </a>
        </div>
    </div>
@endsection

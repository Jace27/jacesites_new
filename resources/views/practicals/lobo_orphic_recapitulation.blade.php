@extends('layouts.main')

@section('title')
    Lobo - Орфический перепросмотр @endsection

@section('head')
    <link rel="stylesheet" href="/css/practicals/lobo_orphic_recapitulation.css">
    <script src="/js/pdf-pagination.js"></script>
    <link rel="stylesheet" href="/css/pdf-pagination.css">
@endsection

@section('content')
    <div class="preloader"><h1>Загрузка...</h1></div>

    <div class="page-change-btns">
        <div>
            <button class="btn btn-primary btn-page-prev"><</button>
            <button class="btn btn-primary btn-page-next">></button>
        </div>
    </div>

    <div id="page-container">
        <div id="pf4a" class="pf w0 h0" data-page-no="1" style="display: none;">
            <div class="pc pc4a w0 h0"><img class="bi x2a y3b9 we h1e" alt=""
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAS0AAAABCAIAAAAEmG9AAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAEUlEQVQoz2NgGAWjYBQMNAAAA4gAASUU950AAAAASUVORK5CYII=">
                <div class="c x0 y1 w0 h1">
                    <div class="t m0 x2b h1f y3ba ffa fs8 fc0 sc0 ls0 ws0"><span class="_ _2b"></span><span class="ffb">Практикум<span
                                class="_ _1a"> </span><span class="ffa">Lobo</span></span></div>
                    <div class="t m0 x2c h1f y3bb ffa fs8 fc0 sc0 ls0 ws0">«<span class="ffb">О<span
                                class="_ _2c"> </span></span> <span class="_ _2d"> </span>»<span
                            class="_ _2e"></span><span class="ffb">рфический<span class="_ _1a"> </span>пересмотр</span>
                    </div>
                    <div class="t m0 x2d ha y3bc ff6 fs2 fc0 sc0 ls0 ws0">Период проведения: <span class="ff8">15.11.2010 – 20.12.2010 г.</span>
                    </div>
                    <div class="t m0 x2e h8 y3bd ff6 fs2 fc0 sc0 ls0 ws0">Место проведения:</div>
                    <div class="t m0 x2a ha y3be ff8 fs2 fc0 sc0 ls0 ws0">http://dreamhackers.eu/</div>
                    <div class="t m0 xe hb y3bf ff1 fs5 fc0 sc0 ls0 ws0">На<span class="_ _0"></span>чало</div>
                    <div class="t m0 x2 h8 y3c0 ff6 fs2 fc3 sc0 ls0 ws0">Anibus</div>
                    <div class="t m0 x2 h9 y3c1 ff7 fs4 fc0 sc0 ls0 ws0">&gt;&gt; Пн ноя 15, 2010 11:43 am</div>
                    <div class="t m0 x2 h20 y3c2 ff5 fs4 fc0 sc0 ls0 ws0"></div>
                    <div class="t m0 x8 ha y3c3 ff8 fs2 fc0 sc0 ls0 ws0">Я<span class="_ _a"></span> <span
                            class="_ _11"></span>уговорил<span class="_ _a"></span> <span class="_ _a"></span>Лоб<span
                            class="_ _1"></span>о<span class="_ _a"></span> <span class="_ _a"></span>уд<span
                            class="_ _1"></span>алить<span class="_ _a"></span> <span class="_ _11"></span>его<span
                            class="_ _a"></span> <span class="_ _11"></span>юморную<span class="_ _a"></span> <span
                            class="_ _a"></span>тему.<span class="_ _11"></span> <span class="_ _a"></span>Все<span
                            class="_ _11"></span> <span class="_ _a"></span>равно<span class="_ _a"></span> <span
                            class="_ _11"></span>ни<span class="_ _a"></span> <span class="_ _11"></span>к<span
                            class="_ _a"></span> <span class="_ _11"></span>чему
                    </div>
                    <div class="t m0 x2 ha y5 ff8 fs2 fc0 sc0 ls0 ws0">хорошему<span class="_ _11"></span> <span
                            class="_ _9"> </span>это<span class="_ _11"></span> <span class="_ _b"> </span>не<span
                            class="_ _b"> </span> <span class="_ _b"> </span>приведет.<span class="_ _b"></span> <span
                            class="_ _b"></span>Его<span class="_ _b"></span> <span class="_ _b"></span>работу<span
                            class="_ _11"></span> <span class="_ _b"> </span>просто<span class="_ _b"></span> <span
                            class="_ _b"></span>разграбят<span class="_ _11"></span> <span class="_ _b"> </span>в<span
                            class="_ _b"> </span> <span class="_ _b"> </span>свои<span class="_ _b"></span> <span
                            class="_ _b"></span>книжки
                    </div>
                    <div class="t m0 x2 ha y3c4 ff8 fs2 fc0 sc0 ls0 ws0">Медведевы-Реутовы,<span class="_ _2"></span>
                        <span class="_ _1"></span>Ком<span class="_ _1"></span>еди<span class="_ _2"></span> <span
                            class="_ _1"></span>клаб,<span class="_ _2"></span> <span class="_ _2"></span>Кривое<span
                            class="_ _2"></span> <span class="_ _1"></span>зеркало,<span class="_ _2"></span> <span
                            class="_ _2"></span>и<span class="_ _1"></span> <span class="_ _2"></span>в<span
                            class="_ _2"></span> <span class="_ _2"></span>конечном<span class="_ _1"></span> <span
                            class="_ _2"></span>счете<span class="_ _2"></span> <span class="_ _2"></span>он
                    </div>
                    <div class="t m0 x2 ha y2f5 ff8 fs2 fc0 sc0 ls0 ws0">останется<span class="_ _2"></span> <span
                            class="_ _2"></span>с<span class="_ _2"></span> <span class="_ _2"></span>носом.<span
                            class="_ _2"></span> <span class="_ _2"></span>Я<span class="_ _2"></span> <span
                            class="_ _2"></span>постоянно<span class="_ _a"></span> <span class="_ _2"></span>ругаю<span
                            class="_ _2"></span> <span class="_ _2"></span>своих<span class="_ _2"></span> <span
                            class="_ _2"></span>коллег.<span class="_ _2"></span> <span class="_ _2"></span>Вот<span
                            class="_ _2"></span> <span class="_ _2"></span>взять,<span class="_ _a"></span> <span
                            class="_ _2"></span>например,
                    </div>
                    <div class="t m0 x2 ha y3c5 ff8 fs2 fc0 sc0 ls0 ws0">Ивету.<span class="_ _d"> </span> <span
                            class="_ _10"> </span>Она<span class="_ _10"> </span> <span
                            class="_ _d"> </span>выложила<span class="_ _10"> </span> <span class="_ _10"> </span>в<span
                            class="_ _d"> </span> <span class="_ _10"> </span>сети<span class="_ _10"> </span> <span
                            class="_ _d"> </span>часть<span class="_ _10"> </span> <span
                            class="_ _10"> </span>своей<span class="_ _d"> </span> <span
                            class="_ _10"> </span>книги<span class="_ _d"> </span> <span class="_ _10"> </span>-<span
                            class="_ _10"> </span> <span class="_ _d"> </span>в<span class="_ _10"> </span> <span
                            class="_ _d"> </span>н<span class="_ _1"></span>адежде,<span class="_ _d"> </span> <span
                            class="_ _10"> </span>что
                    </div>
                    <div class="t m0 x2 ha y3c6 ff8 fs2 fc0 sc0 ls0 ws0">заинтересованные<span class="_ _1e"> </span>
                        <span class="_ _1c"> </span>издательства<span class="_ _1e"> </span> <span
                            class="_ _1c"> </span>обратятся<span class="_ _1e"> </span> <span
                            class="_ _1e"> </span>к<span class="_ _1c"> </span> <span class="_ _1e"> </span>н<span
                            class="_ _1"></span>ей<span class="_ _1e"> </span> <span class="_ _1e"> </span>и<span
                            class="_ _1c"> </span> <span class="_ _1e"> </span>пр<span class="_ _1"></span>едложат
                    </div>
                    <div class="t m0 x2 ha y3c7 ff8 fs2 fc0 sc0 ls0 ws0">сотрудничество.<span class="_ _1"></span> <span
                            class="_ _1"></span>Но<span class="_ _1"></span> <span class="_ _1"></span>материал<span
                            class="_ _1"></span> <span class="_ _1"></span>испо<span class="_ _1"></span>льзовал<span
                            class="_ _1"></span> <span class="_ _1"></span>Форчун<span class="_ _1"></span> <span
                            class="_ _1"></span>(книга<span class="_ _1"></span> <span class="_ _1"></span>Первые<span
                            class="_ _2"></span> врата),<span class="_ _1"></span> <span class="_ _2"></span>и
                    </div>
                    <div class="t m0 x2 ha y3c8 ff8 fs2 fc0 sc0 ls0 ws0">труд<span class="_ _1"></span> <span
                            class="_ _2"></span>Иветы<span class="_ _1"></span> <span class="_ _2"></span>был<span
                            class="_ _1"></span> <span class="_ _1"></span>сворован.<span class="_ _2"></span> <span
                            class="_ _1"></span>Или<span class="_ _2"></span> <span class="_ _1"></span>Мася<span
                            class="_ _1"></span> <span class="_ _2"></span>выложила<span class="_ _1"></span> <span
                            class="_ _2"></span>часть<span class="_ _1"></span> <span class="_ _2"></span>книги<span
                            class="_ _1"></span> <span class="_ _1"></span>"Мир,<span class="_ _2"></span> <span
                            class="_ _1"></span>упавший
                    </div>
                    <div class="t m0 x2 ha y3c9 ff8 fs2 fc0 sc0 ls0 ws0">на<span class="_ _a"></span> <span
                            class="_ _a"></span>ладони".<span class="_ _a"></span> <span class="_ _a"></span>Тоже<span
                            class="_ _a"></span> <span class="_ _a"></span>ведь<span class="_ _2"></span> <span
                            class="_ _11"></span>надеялась<span class="_ _a"></span> <span class="_ _a"></span>на<span
                            class="_ _2"></span> <span class="_ _a"></span>пред<span class="_ _1"></span>ложения<span
                            class="_ _a"></span> <span class="_ _a"></span>от<span class="_ _2"></span> <span
                            class="_ _a"></span>издательств.<span class="_ _11"></span> <span class="_ _a"></span>А<span
                            class="_ _2"></span> <span class="_ _a"></span>хер.
                    </div>
                    <div class="t m0 x2 ha y3ca ff8 fs2 fc0 sc0 ls0 ws0">Фрагмент<span class="_ _b"></span> <span
                            class="_ _b"></span>украли<span class="_ _b"></span> <span class="_ _b"> </span>аж<span
                            class="_ _b"></span> <span class="_ _b"></span>два<span class="_ _b"></span> <span
                            class="_ _b"> </span>писателя.<span class="_ _b"></span> <span class="_ _b"> </span>О<span
                            class="_ _b"> </span> <span class="_ _b"> </span>практах<span class="_ _b"> </span> <span
                            class="_ _9"> </span>Равенн<span class="_ _2"></span>ы <span class="_ _f"> </span>уже<span
                            class="_ _b"></span> <span class="_ _b"> </span>говорилось.
                    </div>
                    <div class="t m0 x2 ha y3cb ff8 fs2 fc0 sc0 ls0 ws0">Украдено. О материалах <span
                            class="_ _15"> </span>СИ<span class="_ _0"></span>...<span class="_ _15"> </span> Ук<span
                            class="_ _0"></span>рад<span class="_ _1"></span>ено Реутовым. Поэтому н<span
                            class="_ _1"></span>ельзя
                    </div>
                    <div class="t m0 x2 ha y3cc ff8 fs2 fc0 sc0 ls0 ws0">выкладывать<span class="_ _a"></span> <span
                            class="_ _11"></span>в<span class="_ _a"></span> <span class="_ _11"></span>сеть<span
                            class="_ _a"></span> <span class="_ _11"></span>незавершенное<span class="_ _a"></span>
                        <span class="_ _a"></span>произведе<span class="_ _1"></span>ние.<span class="_ _a"></span>
                        <span class="_ _11"></span>Нельзя!!!<span class="_ _a"></span> <span
                            class="_ _11"></span>Ни<span class="_ _a"></span> <span class="_ _a"></span>за<span
                            class="_ _11"></span> <span class="_ _a"></span>какие
                    </div>
                    <div class="t m0 x2 ha y3cd ff8 fs2 fc0 sc0 ls0 ws0">коврижки.</div>
                    <div class="t m0 x8 ha y3ce ff8 fs2 fc0 sc0 ls0 ws0">Но,<span class="_ _9"> </span> <span
                            class="_ _8"> </span>чтобы<span class="_ _8"> </span> <span
                            class="_ _8"> </span>успокоить<span class="_ _8"> </span> <span
                            class="_ _9"> </span>Лобо,<span class="_ _8"> </span> <span class="_ _8"> </span>я<span
                            class="_ _9"> </span> <span class="_ _8"> </span>предложил<span class="_ _8"> </span> <span
                            class="_ _8"> </span>ему<span class="_ _8"> </span> <span class="_ _9"> </span>пров<span
                            class="_ _1"></span>ести<span class="_ _9"> </span> <span class="_ _8"> </span>практ<span
                            class="_ _8"> </span> <span class="_ _8"> </span>по
                    </div>
                    <div class="t m0 x2 ha y3cf ff8 fs2 fc0 sc0 ls0 ws0">искусству<span class="_ _8"> </span> <span
                            class="_ _8"> </span>орфиков.<span class="_ _8"> </span> <span
                            class="_ _8"> </span>Плюс,<span class="_ _8"> </span> <span class="_ _8"> </span>присовокупить<span
                            class="_ _8"> </span> <span class="_ _8"> </span>к<span class="_ _8"> </span> <span
                            class="_ _8"> </span>этому<span class="_ _8"> </span> <span
                            class="_ _8"> </span>тематику<span class="_ _8"> </span> <span class="_ _8"> </span>пересмотра
                    </div>
                    <div class="t m0 x2 ha y3d0 ff8 fs2 fc0 sc0 ls0 ws0">личной<span class="_ _c"> </span> <span
                            class="_ _10"> </span>жизни. <span class="_ _10"> </span>Думаю,<span class="_ _c"> </span>
                        <span class="_ _c"> </span>так<span class="_ _10"> </span> будет<span class="_ _10"> </span>
                        <span class="_ _c"> </span>интересно.<span class="_ _c"> </span> <span class="_ _10"> </span>Если
                        <span class="_ _10"> </span>вам<span class="_ _c"> </span> <span class="_ _c"> </span>такая<span
                            class="_ _10"> </span> идея
                    </div>
                    <div class="t m0 x2 ha y3d1 ff8 fs2 fc0 sc0 ls0 ws0">покажется интересной, Лобо постарается. Он в
                        эдаких делишках спец.
                    </div>
                    <div class="t m0 x2 h8 y3d2 ff6 fs2 fc0 sc0 ls0 ws0">Ioneks</div>
                    <div class="t m0 x2 h9 y3d3 ff7 fs4 fc0 sc0 ls0 ws0">&gt;&gt; Пн ноя 15, 2010 2:18 pm</div>
                    <div class="t m0 x2 h8 y3d4 ff6 fs2 fc0 sc0 ls0 ws0"></div>
                    <div class="t m0 x2 ha y279 ff8 fs2 fc0 sc0 ls0 ws0">Большой интерес! Орфики+пересмотр!</div>
                    <div class="t m0 x2 h8 y3d5 ff6 fs2 fc0 sc0 ls0 ws0">Inmago</div>
                    <div class="t m0 x2 h9 y3d6 ff7 fs4 fc0 sc0 ls0 ws0">&gt;&gt; Пн ноя 15, 2010 2:27 pm</div>
                    <div class="t m0 x2 h8 y3d7 ff6 fs2 fc0 sc0 ls0 ws0"></div>
                    <div class="t m0 x2 ha y16a ff8 fs2 fc0 sc0 ls0 ws0">Всегда готов!</div>
                </div>
            </div>
            <div class="pi" data-data="{&quot;ctm&quot;:[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}"></div>
        </div>
    </div>
@endsection

@section('sidebar')
    <p>
        Страница:
        <input type="number" min="1" step="1" class="d-inline form-control" id="pdf-pagination-page">
    </p>

    <p>
        <button class="btn btn-primary btn-download"
                data-file-link="/download/practicals/lobo_orphic_recapitulation.pdf">Скачать (.pdf, 432 КБ)
        </button>
    </p>
@endsection

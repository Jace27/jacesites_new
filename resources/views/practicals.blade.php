@extends('layouts.main')

@section('title')
Сохранения практикумов @endsection

@section('head')
    <link rel="stylesheet" href="/css/hider.css">
    <style>
        .section * { font-size: 1.2rem; }
        .link { margin: 0.75em 0; }
    </style>
@endsection

@section('content')
    <div class="text-block mt-3">
        <div class="section">
            <div class="header"><span>Сновиденные</span></div>
            <div class="items">
                <div class="section">
                    <div class="header"><span>Уровень Первых Врат</span></div>
                    <div class="items">
                        <a href="/practical/ravenna_transfer_os_to_ks"><span class="link">Равенна - Практикум по превращению осознанных сновидений в контролируемые (20.07.2004 - 26.12.2004)</span></a>
                        <a href="/practical/ravenna_virtual_spaces"><span class="link">Равенна - Виртуальные пространства (01.08.2005 - 29.12.2005)</span></a>
                        <a href="/practical/ravenna_lucid_dreaming_together"><span class="link">Равенна - Практикум по совместным осознанным сновидениям(11.02.2007 - 23.05.2007)</span></a>
                        <a href="/practical/ravenna_tuning_controlled_dreams"><span class="link">Равенна - Настройка контролируемых сновидений (19.02.2010 - 26.06.2010)</span></a>
                        <a href="/practical/vachap_attention_basics"><span class="link">Vachap - Искусство Внимания (14.06.2016 - 05.11.2016)</span></a>
                        <a href="/practical/magmas_emissary_voice"><span class="link">Магмас ака Масяня - Голос эмиссара (16.01.2017 - 26.03.2017)</span></a>
                    </div>
                </div>
                <div class="section">
                    <div class="header"><span>Уровень Вторых Врат</span></div>
                    <div class="items">
                        <a href="/practical/ravenna_second_gate"><span class="link">Равенна - Вторые врата (02.09.2009 - 22.03.2010)</span></a>
                        <a href="/practical/ravenna_silver_way"><span class="link">Равенна - Серебряный путь (04.08.2011 - 08.10.2011)</span></a>
                        <a href="/practical/ravenna_hunting_for_double"><span class="link">Равенна - Охота на дубля, Поиски Винсенто, Хакерский фэн-шуй (31.01.2012 - 02.07.2012)</span></a>
                        <a href="/practical/magmas_hike_to_yondo"><span class="link">Магмас ака Масяня - Поход в Йондо, Часть 1 (07.04.2015 - ?)</span></a>
                        <a href="/practical/magmas_ally_world"><span class="link">Магмас ака Масяня - Мир эллайсов (06.02.2016 - 14.03.2016)</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="header"><span>Сталкерские</span></div>
            <div class="items">
                <a href="/practical/said_stalking"><span class="link">Аль Саид - Практикум сталкинга (12.06.2003 - 24.10.2003)</span></a>
                <a href="/practical/tambov_transcendent_vision"><span class="link">Тухлый ака Тамбов - Запредельное Видение (20.02.2009 - 24.03.2009)</span></a>
                <a href="/practical/magmas_new_causal_practical"><span class="link">Магмас ака Масяня - Новый каузальный практ (06.10.2013 - 04.12.2013)</span></a>
                <a href="/practical/raven"><span class="link">Практикум Рэйвена (20.01.2014 - 22.05.2014)</span></a>
                <a href="/practical/nebul_holes"><span class="link">Nebul - Дыры (07.03.2018 - 26.04.2018)</span></a>
                <a href="/practical/lucy_recapitulation_in_modern_life"><span class="link">Lucy - Перепросмотр в современной жизни (31.07.2018 - 28.11.2018)</span></a>
                <a href="/practical/dispetcher_stalking_for_begginers"><span class="link">DisPetcher - Сталкинг для начинающих (02.09.2018 - 18.12.2018)</span></a>
                <a href="/practical/lucy_third_abstract_core_stalking"><span class="link">Lucy - Третье абстрактное ядро - сталкинг (03.12.2018 - 06.05.2019)</span></a>
                <a href="/practical/lucy_adequacy"><span class="link">Lucy - Адекватность (19.02.2019 - 30.04.2019)</span></a>
                <a href="/practical/lucy_matryoshka_second_topic_about_stalking"><span class="link">Lucy - Матрешка (10.05.2019 - 26.06.2019)</span></a>
            </div>
        </div>
        <div class="section">
            <div class="header"><span>Энергетика</span></div>
            <div class="items">
                <a href="/practical/anibus_dreaming_location"><span class="link">Анибус - Локация сновидения (23.08.2010 - 16.03.2011)</span></a>
                <a href="/practical/kaa_attention_development"><span class="link">Kaa - Развитие внимания в тени плексусной системы (05.08.2017 - 04.09.2017)</span></a>
            </div>
        </div>
        <div class="section">
            <div class="header"><span>Магия</span></div>
            <div class="items">
                <a href="/practical/vachap_orphics_art"><span class="link">Vachap - Искусство орфиков (05.04.2006 - 30.03.2007)</span></a>
                <a href="/practical/vinchi_geomagic"><span class="link">Винчи - Геомагия (11.11.2006 - 10.05.2007)</span></a>
                <a href="/practical/magmas_creating_magical_creatures"><span class="link">Магмас ака Масяня - Создание магических существ (22.09.2008 - 30.10.2008)</span></a>
                <a href="/practical/lobo_orphic_recapitulation"><span class="link">Lobo - Орфический перепросмотр (15.11.2010 - 20.12.2010)</span></a>
                <a href="/practical/magmas_intention_power"><span class="link">Магмас ака Масяня - Сила Намерения (02.2011 - 03.2011)</span></a>
                <a href="/practical/magmas_druids"><span class="link">Магмас ака Масяня - Друидский практикум (01.2013 - 05.2013)</span></a>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/js/hider.js"></script>
@endsection

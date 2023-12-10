@extends('layouts.main')

@section('title')
Система испытаний @endsection

@section('head')
    <link rel="stylesheet" href="/css/tabs.css">
    <style>
        ol {
            margin-inline-start: 0;
            margin-block-start: 0;
            margin: 0;
            padding-inline-start: 0;
            padding-block-start: 0;
            padding: 0;
        }
        .tabs li {
            margin-left: 30px;
        }
        .red { color: rgb(142, 29, 29); }
        .green { color: rgb(29, 142, 29); }
    </style>
@endsection

@section('content')
    <div class="tabs text-block mt-3">
        <div class="tab_header">
            <div class="tabs_header_page" id="header_1" style="font-weight: 900;">Правила</div>
            <div class="tabs_header_page" id="header_2" style="font-weight: 500;">План испытаний</div>
            <div class="tabs_header_page" id="header_3" style="font-weight: 500;">Прогресс испытаний участников</div>
        </div>
        <div class="tabs_body">
            <div class="tab_page" id="page_1">
                <p>Испытание - квест на время. После выполнения или провала испытания необходимо отдохнуть некоторое время, указанное в описании испытания. </p>
                <p>Круг - фиксированная последовательность из нескольких испытаний.</p>
                <p>Уровень - повторение одного круга то количество раз, которое указано в плане. Первое испытание первого круга можно считать входным экзаменом: если оно будет трижды подряд провалено, то вы обязаны вернуться и пройти предыдущий уровень заново. Уровень считается пройденным если все круги успешно выполнены. Если вы прошли уровень, то приступаете к следующему, более сложному. Однако если считаете, что недостаточно отработали умение, можете остаться на текущем уровне; доступ к следующему сохраняется.</p>
                <p>Если вы справились с испытанием с первой попытки, вы можете приступать к следующему немедленно, в противном случае необходимо пройти штрафное испытание текущего уровня. Если штрафное испытание провалено, круг необходимо начать заново. Штрафное испытание не освобождает от выполнения проваленного ранее испытания. Три штрафа подряд на одном и том же испытании сбрасывают прогресс уровня.</p>
                <p>К системе испытаний можно присоединяться и уходить из нее в любое время, но ваш прогресс за текущий уровень будет сброшен, а также каждая неделя отдыха будет стоить одного уровня.</p>
                <p>На каждом уровне есть испытание-чекпоинт. В случае, если человек отошел от прохождения испытаний и потерял доступ к какому-либо уровню, он может пройти испытание-чекпоинт и сразу вернуться на данный уровень. Если испытание-чекпоинт провалено, то можно попытаться пройти чекпоинт предыдущего уровня и начать заново оттуда.</p>
                <p>Учет прогресса ведется администраторами системы, поэтому регулярная отчетность в соответствующей беседе ("Кунг-фу сновидений") обязательна.</p>
                <p>Вся эта система предназначена для того, чтобы а) все участники развивались; б) развивались в собственном темпе; в) был точно известен уровень каждого участника; г) все точно умели то, что должны уметь; д) оттачивать навыки до совершенства. Если вы что-то умеете - проскочите это быстро. Если нет - будете пробовать пока не научитесь.</p>
                <p>Спрашивать как проходить испытания, какие есть техники, как что-либо устроено ОБЯЗАТЕЛЬНО. Сами только лет через 10 разберетесь, а инструкции лучше давать лично.</p>
                <p>Программа испытаний со временем может меняться, администраторы уведомят вас если потребуется перепройти какой-то изменившийся уровень.</p>
            </div>
            <div class="tab_page" id="page_2">
                <ol>
                    <table border="1" cellspacing="0" cellpadding="10">
                        <tbody>
                        <tr>
                            <th>Уровень</th>
                            <th>Кругов</th>
                            <th>Испытание</th>
                            <th>Время выполнения</th>
                            <th>Время отдыха</th>
                        </tr>
                        <!---------------------- 1 ---------------------->
                        <tr><td colspan="5">Базовые навыки</td></tr>
                        <tr>
                            <td rowspan="6"><li>&nbsp;</li></td>
                            <td rowspan="5">2</td>
                        </tr>
                        <tr>
                            <td>Запомнить один сон</td>
                            <td>7 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Запомнить два сна</td>
                            <td>7 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Запомнить четыре сна</td>
                            <td>7 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Запомнить пять снов</td>
                            <td>5 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Штрафное испытание:</b><br>Запомнить на один сон больше, чем требовалось в проваленном испытании</td>
                            <td class="uncountable">10 дней</td><td class="uncountable">0 дней</td>
                        </tr>
                        <!---------------------- 2 ---------------------->
                        <tr>
                            <td rowspan="5"><li>&nbsp;</li></td>
                            <td rowspan="3">2</td>
                        </tr>
                        <tr>
                            <td>Запомнить два сна за ночь</td>
                            <td>7 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Запомнить три сна за ночь</td>
                            <td>14 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Штрафное испытание:</b><br>Запомнить 2 сна</td>
                            <td class="uncountable">2 дня</td><td class="uncountable">0 дней</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Испытание-чекпоинт:</b><br>Запомнить 5 снов</td>
                            <td class="uncountable">3 дня</td><td class="uncountable">0 дней</td>
                        </tr>
                        <!---------------------- 3 ---------------------->
                        <tr>
                            <td rowspan="6"><li>&nbsp;</li></td>
                            <td rowspan="4">3</td>
                        </tr>
                        <tr>
                            <td>
                                Зарисовать и описать 7 разных локаций <br>
                                Описание локации необходимо выкладывать в тот же день, когда локация приснилась. Выкладывать описания пачкой запрещенно.
                            </td>
                            <td>10 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Найти руки. Необходимо посмотреть на руки, посчитать кол-во пальцев и потереть их</td>
                            <td>10 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Запомнить диалог из сна в подробностях</td>
                            <td>10 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Штрафное испытание:</b><br>Запомнить 10 снов</td>
                            <td class="uncountable">7 дней</td><td class="uncountable">0 дней</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Испытание-чекпоинт:</b><br>Запомнить 10 снов</td>
                            <td class="uncountable">5 дней</td><td class="uncountable">0 дней</td>
                        </tr>
                        <!---------------------- 4 ---------------------->
                        <tr>
                            <td rowspan="5"><li>&nbsp;</li></td>
                            <td rowspan="3">5</td>
                        </tr>
                        <tr>
                            <td>Осознаться во сне</td>
                            <td>7 дней</td><td>1 день</td>
                        </tr>
                        <tr>
                            <td>Осознаться во сне дважды</td>
                            <td>7 дней</td><td>1 день</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Штрафное испытание:</b><br>Осознаться во сне</td>
                            <td class="uncountable">5 дней</td><td class="uncountable">1 день</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Испытание-чекпоинт:</b><br>Найти руки, посчитать пальцы</td>
                            <td class="uncountable">5 дней</td><td class="uncountable">0 дней</td>
                        </tr>
                        <!---------------------- 5 ---------------------->
                        <tr><td colspan="5">Развитие контроля над сновидением</td></tr>
                        <tr>
                            <td rowspan="8"><li>&nbsp;</li></td>
                            <td rowspan="6">3</td>
                        </tr>
                        <tr>
                            <td>Закрепиться в ОСе всеми методами: потереть руки, использовать полет колибри</td>
                            <td>7 дней</td><td>1 день</td>
                        </tr>
                        <tr>
                            <td>Создать и изменить предмет, удалить спрайтов, изменить погоду, время дня, время года</td>
                            <td>14 дней</td><td>2 дня</td>
                        </tr>
                        <tr>
                            <td>Полетать в ОСе, пройти сквозь стены, телепортироваться, использовать портал</td>
                            <td>14 дней</td><td>2 дня</td>
                        </tr>
                        <tr>
                            <td>Изменить сновиденное тело. Первое изменение - обязательно добавить сумку для вещей. Если сумка сохранилась на все следующие ночи, можете дальше декорировать тело на свой вкус</td>
                            <td>14 дней</td><td>2 дня</td>
                        </tr>
                        <tr>
                            <td>Внести предмет из яви в сон</td>
                            <td>7 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Штрафное испытание:</b><br>Запомнить 5 снов, из них дважды осознаться</td>
                            <td class="uncountable">5 дней</td><td class="uncountable">1 день</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Испытание-чекпоинт:</b><br>Осознаться трижды</td>
                            <td class="uncountable">6 дней</td><td class="uncountable">2 дня</td>
                        </tr>
                        <!---------------------- 6 ---------------------->
                        <tr>
                            <td rowspan="8"><li>&nbsp;</li></td>
                            <td rowspan="6">4</td>
                        </tr>
                        <tr>
                            <td>Усыпить тело не уснув сознанием</td>
                            <td>7 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Проснувшись заснуть снова, продолжив сон</td>
                            <td>7 дней</td><td>1 день</td>
                        </tr>
                        <tr>
                            <td>Внутри сна вспомнить предыдущие сны за ночь</td>
                            <td>7 дней</td><td>1 день</td>
                        </tr>
                        <tr>
                            <td>Стереть весь окружающий мир сна, остаться в пустом пространстве</td>
                            <td>7 дней</td><td>1 день</td>
                        </tr>
                        <tr>
                            <td>Войти в контролируемое сновидение напрямую при засыпании</td>
                            <td>21 день</td><td>2 дня</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Штрафное испытание:</b><br>Осознаться дважды за ночь (можно за один сон)</td>
                            <td class="uncountable">5 дней</td><td class="uncountable">1 день</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Испытание-чекпоинт:</b><br>Закрепиться в двух ОСах</td>
                            <td class="uncountable">3 дня</td><td class="uncountable">1 день</td>
                        </tr>
                        <!---------------------- 7 ---------------------->
                        <tr><td colspan="5">Изучение сновиденного мира</td></tr>
                        <tr>
                            <td rowspan="6"><li>&nbsp;</li></td>
                            <td rowspan="4">3</td>
                        </tr>
                        <tr>
                            <td>Посетить локацию в черте города</td>
                            <td>3 дня</td><td>0 день</td>
                        </tr>
                        <tr>
                            <td>Посетить локацию на окраинах города и около них</td>
                            <td>7 дней</td><td>1 дня</td>
                        </tr>
                        <tr>
                            <td>Посетить граничные локации</td>
                            <td>14 дней</td><td>2 дня</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Штрафное испытание:</b><br>Запомнить 6 снов</td>
                            <td class="uncountable">3 дня</td><td class="uncountable">0 дней</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Испытание-чекпоинт:</b><br>Войти в контролируемое сновидение напрямую при засыпании</td>
                            <td class="uncountable">21 день</td><td class="uncountable">2 дня</td>
                        </tr>
                        <!---------------------- 8 ---------------------->
                        <tr><td colspan="5">Северный путь</td></tr>
                        <tr>
                            <td rowspan="11"><li>&nbsp;</li></td>
                            <td rowspan="9">2</td>
                        </tr>
                        <tr>
                            <td>Посетить индустриальную зону</td>
                            <td>3 дня</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Посетить реку между городом и морем на востоке</td>
                            <td>5 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Посетить рыбацкий поселок</td>
                            <td>5 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Посетить завод</td>
                            <td>5 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Посетить Костер</td>
                            <td>5 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Посетить болото, зону религии</td>
                            <td>5 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Посетить ковбойский луна-парк</td>
                            <td>5 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Посетить электростанцию</td>
                            <td>5 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Штрафное испытание:</b><br>Повторить предыдущее пройденное испытание</td>
                            <td class="uncountable">5 дней</td><td class="uncountable">0 дней</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Испытание-чекпоинт:</b><br>Посетить Рынок</td>
                            <td class="uncountable">5 дней</td><td class="uncountable">0 дней</td>
                        </tr>
                        <!---------------------- 9 ---------------------->
                        <tr><td colspan="5">Путь в Рай</td></tr>
                        <tr>
                            <td rowspan="6"><li>&nbsp;</li></td>
                            <td rowspan="4">2</td>
                        </tr>
                        <tr>
                            <td>Посетить городскую площадь (возможно с бункером)</td>
                            <td>3 дня</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Посетить придорожное кафе, в котором произошло убийство. За ним стена с лианами, поднявшись уткнетесь в мост, а за ним транзит в рай</td>
                            <td>3 дня</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Посетить Рай</td>
                            <td>5 дней</td><td>3 дня</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Штрафное испытание:</b><br>Повторить предыдущее пройденное испытание</td>
                            <td class="uncountable">5 дней</td><td class="uncountable">0 дней</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Испытание-чекпоинт:</b><br>Посетить электростанцию</td>
                            <td class="uncountable">5 дней</td><td class="uncountable">0 дней</td>
                        </tr>
                        <!---------------------- 10 ---------------------->
                        <tr><td colspan="5">Сновиденные учителя (задания этого этапа засчитаются даже если самого учителя не встретите, здесь важно посетить саму локацию)</td></tr>
                        <tr>
                            <td rowspan="7"><li>&nbsp;</li></td>
                            <td rowspan="5">1</td>
                        </tr>
                        <tr>
                            <td>Посетить Винсенто</td>
                            <td>10 дней</td><td>2 дня</td>
                        </tr>
                        <tr>
                            <td>Посетить Ведьму</td>
                            <td>10 дней</td><td>2 дня</td>
                        </tr>
                        <tr>
                            <td>Посетить Дриаду</td>
                            <td>10 дней</td><td>2 дня</td>
                        </tr>
                        <tr>
                            <td>Посетить Дом Учителей</td>
                            <td>10 дней</td><td>2 дня</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Штрафное испытание:</b><br>Повторить предыдущее пройденное испытание</td>
                            <td class="uncountable">10 дней</td><td class="uncountable">2 дней</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Испытание-чекпоинт:</b><br>Посетить Рай</td>
                            <td class="uncountable">5 дней</td><td class="uncountable">3 дня</td>
                        </tr>
                        <!---------------------- 11 ---------------------->
                        <tr><td colspan="5">Последняя игра</td></tr>
                        <tr>
                            <td rowspan="7"><li>&nbsp;</li></td>
                            <td rowspan="5">1</td>
                        </tr>
                        <tr>
                            <td>Собрать одну или две точки светимости</td>
                            <td>14 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Каким-либо образом получить опендыры</td>
                            <td>7 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Создать тайник для переноса вещей между мирами. Сундучок, спрятанный в укромном месте и в реале, и во сне</td>
                            <td>3 дня</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td>Ограбить аэропорт по плану и спрятать ядро светимости в тайнике</td>
                            <td>7 дней</td><td>0 дней</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Штрафное испытание:</b><br>Повторить предыдущее пройденное испытание</td>
                            <td class="uncountable">10 дней</td><td class="uncountable">0 дней</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Испытание-чекпоинт:</b><br>Посетить Дом Учителей</td>
                            <td class="uncountable">10 дней</td><td class="uncountable">2 дня</td>
                        </tr>
                        <!---------------------- 12 ---------------------->
                        <tr>
                            <td rowspan="4"><li>&nbsp;</li></td>
                            <td rowspan="2">1</td>
                        </tr>
                        <tr>
                            <td>Собрать все точки светимости</td>
                            <td>25 дней</td><td></td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Штрафное испытание:</b><br>Повторить 11 уровень целиком</td>
                            <td class="uncountable">31 день</td><td class="uncountable">0 дней</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Испытание-чекпоинт:</b><br>Получить Ядро светимости (если уже получали, удостоверьтесь, что оно лежит на месте)</td>
                            <td class="uncountable">31 день</td><td class="uncountable">0 дней</td>
                        </tr>

                        <!--
						<tr><td colspan="5"></td></tr>
						<tr><td rowspan="2"><li>&nbsp;</li></td></tr>
						<tr>
							<td></td>
							<td></td><td></td>
						</tr>
						-->
                        </tbody>
                    </table>
                </ol>
                <span>Суммарное кол-во дней на программу:</span>
                <div id="summary"></div>
            </div>
            <div class="tab_page" id="page_3">
                <p>Оригинальная страница: <a href="https://docs.google.com/spreadsheets/d/e/2PACX-1vQ4cDk-KxMStcsRuKjsAw4TJU8k-cRpKAOH3jTpPB2L6UPMWcvfqmgSOE27Fk4myw/pubhtml" target="_blank">Google Sheets</a></p>
                <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQ4cDk-KxMStcsRuKjsAw4TJU8k-cRpKAOH3jTpPB2L6UPMWcvfqmgSOE27Fk4myw/pubhtml" frameborder="0" style="width: 100%; min-height: 400px;"></iframe>
            </div>
        </div>
    </div>
    <script>
        let work_days = 0;
        let relax_days = 0;

        let last_multiplier = 1;
        $('td:nth-child(2)').each(function(index, element){
            if ($(element).hasClass('uncountable')) return;
            if ($(element).attr('rowspan') !== undefined) {
                last_multiplier = +($(element).text());
            }
            if ($(element).attr('rowspan') === undefined) {
                let cur_days = $(element).text().split(' ')[0];
                if (cur_days.trim() == '')
                    cur_days = 0;
                else
                    cur_days = +cur_days;
                work_days += cur_days * last_multiplier;
            }
        });
        $('td:nth-child(3)').each(function(index, element){
            if ($(element).hasClass('uncountable')) return;
            let cur_days = $(element).text().split(' ')[0];
            if (cur_days.trim() == '') cur_days = "0";
            relax_days += cur_days * last_multiplier;
        });
        $('#summary').html('Рабочих дней: '+work_days+'<br>Выходных: '+relax_days+'<br>Всего: '+(work_days + relax_days));
    </script>
    <script src="/js/tabs.js"></script>
@endsection

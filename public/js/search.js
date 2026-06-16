let last_input_time = Date.now();

$(document).ready(function(){
    $('input[name=search]').on('input',function(e){
        if (Date.now() - last_input_time > 1000 && $(this).val().trim().length > 1) {
            search($(this).val().trim());
        }
        last_input_time = Date.now();
    });
    $('.btn-page-search').click(function () {
        search($('input[name=search]').val().trim());
    });
});
window.search = (text) => {
    if (text != ''){
        $('#search-results').html('<h3>Загрузка...</h3>');
        let search = text.toLowerCase();

        if ($('input[name=search]').attr('data-type') == 'offline') {
            let results = [];
            $('.search-result').each(function (i, e) {
                if ($(e).html().toLowerCase().indexOf(search) != -1)
                    results.push(e.outerHTML);
            });
            if (results.length != 0) {
                $('#search-results').html('<div>Найдено: '+results.length+'</div>');
                for (let i = 0; i < results.length; i++)
                    $('#search-results').append(results[i]);
            } else {
                $('#search-results').html('<h2>Ничего не найдено</h2>');
            }
        }
        if ($('input[name=search]').attr('data-type') == 'online'){
            let data = new FormData();
            data.append('search', search);
            ajax({
                url: '/api/search/'+$('input[name=search]').attr('data-target'),
                method: 'post',
                data: data,
                success: function(data){
                    if (data.status == 'success'){
                        $('#search-results').html('<div>Найдено: '+data.results.length+'</div>');
                        data.results.forEach(function(element, index, array){
                            let html =
                                '<div class="m-2 p-2 search-result" style="border: 1px solid gray; border-radius: 10px;"' +
                                '     onclick="window.location.assign(\'/dream/'+element.id+'\')">' +
                                '    <a href="/dream/'+element.id+'"><b>' +
                                element.user?.name + '&nbsp;' + element.date + '&nbsp;-&nbsp;' + element.title +
                                '    </b></a>' +
                                (element.hidden == 1 ? '<span style="color: dimgray">Сон скрыт</span>' : '') +
                                '    <div class="d-flex flex-row flex-wrap">';
                            element.tags.forEach(function (tag) {
                                html += '<div class="tag-style m-1">'+tag+'</div>';
                            });
                            html += '</div></div>';
                            $('#search-results').append(html);
                        });

                        $('.tag-style').css('cursor', 'pointer');
                        $('.tag-style').unbind('click');
                        $('.tag-style').click(function (e) {
                            e.stopPropagation();
                            $('input[name=search]').val($(this).text());
                            window.search($(this).text());
                        });

                        if (data.results.length == 0){
                            $('#search-results').html('<h2>Ничего не найдено</h2>');
                        }
                    } else {
                        show_message('Ошибка', data.message);
                    }
                },
                error: function (data) {
                    show_message('Ошибка', data.responseJSON.message);
                }
            });
        }

        $('#page').css('display', 'none');
        $('#search-results').css('display', 'block');
    } else {
        $('#page').css('display', 'block');
        $('#search-results').css('display', 'none');
    }
}

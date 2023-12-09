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
function search(text){
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
                            $('#search-results').append(element);
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

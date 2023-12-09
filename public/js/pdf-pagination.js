let page_data = [
    {
        practical_id: window.location.pathname.split('/')[2],
        page_id: 1
    }
];
function get_page_id(practical_id) {
    let ret = 1;
    page_data.forEach(function (value, index, array) {
        if (value.practical_id == practical_id) {
            if (typeof value.page_id === 'number') {
                ret = value.page_id;
            }
        }
    });
    return ret;
}
function set_page_id(practical_id, page_id) {
    let ok = false;
    page_data.forEach(function (value, index, array) {
        if (value.practical_id == practical_id) {
            if (typeof page_id === 'number' || parseInt(page_id) !== NaN) {
                value.page_id = page_id;
                ok = true;
            }
        }
    });
    if (!ok){
        page_data.push({ practical_id: practical_id, page_id: page_id });
    }
    save_page_data();

    $('#pdf-pagination-page').val(page_id);
}
function load_page_data() {
    let data = localStorage.getItem('jacesites_data.practicals');
    if (data == null || data == undefined) {
        data = { page_data: page_data };
        localStorage.setItem('jacesites_data.practicals', JSON.stringify(data));
    } else {
        try {
            data = JSON.parse(data);
        } catch (e) {
            data = { page_data: page_data };
            localStorage.setItem('jacesites_data.practicals', JSON.stringify(data));
            return;
        }
    }
    if (typeof data !== 'object') {
        data = { page_data: page_data };
        localStorage.setItem('jacesites_data.practicals', JSON.stringify(data));
    }
    if (data.page_data == null || data.page_data == undefined) {
        data.page_data = page_data;
        localStorage.setItem('jacesites_data.practicals', JSON.stringify(data));
    }
    if (!Array.isArray(data.page_data)) {
        data.page_data = page_data;
        localStorage.setItem('jacesites_data.practicals', JSON.stringify(data));
    }
    data.page_data.forEach(function(value, index, array){
        if (typeof value !== 'object'){
            data.page_data.splice(index, 1);
        } else if (value.practical_id == null || value.practical_id == undefined){
            data.page_data.splice(index, 1);
        } else if (value.page_id == null || value.page_id == undefined){
            data.page_data[index].page_id = 1;
        }
    });
    page_data = data.page_data;
}
function save_page_data(){
    let data = localStorage.getItem('jacesites_data.practicals');
    if (data == null || data == undefined) {
        data = { page_data: page_data };
        localStorage.setItem('jacesites_data.practicals', JSON.stringify(data));
    } else {
        try {
            data = JSON.parse(data);
        } catch (e) {
            data = { page_data: page_data };
            localStorage.setItem('jacesites_data.practicals', JSON.stringify(data));
            return;
        }
    }
    if (typeof data !== 'object') {
        data = { page_data: page_data };
        localStorage.setItem('jacesites_data.practicals', JSON.stringify(data));
    }
    data.page_data = page_data;
    localStorage.setItem('jacesites_data.practicals', JSON.stringify(data));
}
function show_page(page_id){
    let page = page_id.toString(16);
    if (page < 1) page = 1;
    load_page(parseInt(page, 16));
    $('[data-page-no='+page+']').css('display', 'block');
}

let practical_id = window.location.pathname.split('/')[2];
$(document).ready(function(){
    $('.preloader').css('display', 'none');
    load_page_data();
    show_page(get_page_id(practical_id));
    $('.btn-page-next').click(function(){
        set_page_id(practical_id, get_page_id(practical_id) + 1);
        show_page(get_page_id(practical_id));
    });
    $('.btn-page-prev').click(function(){
        set_page_id(practical_id, get_page_id(practical_id) - 1);
        show_page(get_page_id(practical_id));
    });
    $('#pdf-pagination-page').change(function () {
        show_page(+($(this).val()));
    });
});

function upload_page_by_page(start = 0, end = Number.MAX_VALUE) {
    $('[data-page-no]').each(function (index, elem) {
        if (parseInt($(elem).attr('data-page-no'), 16) >= start &&
            parseInt($(elem).attr('data-page-no'), 16) <= end) {
            let data = new FormData();
            data.append('practical_id', practical_id);
            data.append('page_id', parseInt($(elem).attr('data-page-no'), 16));
            data.append('page_content', elem.outerHTML);
            let time = Date.now();
            ajax({
                url: '/api/upload/practicals/page',
                method: 'post',
                data: data,
                async: false,
                success: function (data) {
                    console.log(data);
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });
            if (1000 > (Date.now() - time)) sleep(1000 - (Date.now() - time) + 10);
        }
    });
}
function load_page(page_id = 1){
    $('.preloader').css('display', 'flex');
    ajax({
        url: '/resources/practicals/'+practical_id+'/'+page_id+'.html',
        method: 'get',
        async: false,
        success: function (data) {
            $('#page-container').html(data);
            $('.preloader').css('display', 'none');
            set_page_id(practical_id, page_id);
        },
        error: function (xhr) {
            if (xhr.status == 404){
                $('.preloader').css('display', 'none');
                show_message('Ошибка', 'Запрашиваемой страницы не существует');
                set_page_id(practical_id, page_id - 1);
            }
        }
    })
}

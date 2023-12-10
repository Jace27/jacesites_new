function ajax(args) {
    let ajax_args = {processData: false, contentType: false};

    if (args.url !== null && args.url !== undefined && typeof args.url === 'string')
        ajax_args.url = args.url;
    else
        return false;

    if (args.method !== null && args.method !== undefined && typeof args.method === 'string')
        ajax_args.method = args.method;
    else
        return false;

    if (args.data !== null && args.data !== undefined && typeof args.data === 'object')
        ajax_args.data = args.data;
    else if (args.method !== null && args.method !== undefined && typeof args.method === 'string' && args.method == 'post')
        return false;

    ajax_args.success = function (data, status, xhr) {
        if (args.success !== null && args.success !== undefined && typeof args.success === 'function')
            args.success(data);
    };

    if (args.show_errors === null || args.show_errors === undefined || args.show_errors == true) {
        if (args.error !== null && args.error !== undefined && typeof args.error === 'function') {
            ajax_args.error = function (xhr) {
                console.log(xhr);
                if (xhr.readyState < 4) {
                    ajax(args);
                    return;
                } else {
                    show_message('Критическая ошибка', 'Извините, на сервере произошла ошибка. Обратитесть к администратору');
                    if (args.error !== null && args.error !== undefined && typeof args.error === 'function')
                        args.error(xhr);
                }
            };
        }
    }

    if (args.async !== null && args.async !== undefined && typeof args.async === 'boolean')
        ajax_args.async = args.async;

    try {
        $.ajax(ajax_args);
    } finally {
    }
}

function sleep(milliseconds) {
    const date = Date.now();
    let currentDate = null;
    do {
        currentDate = Date.now();
    } while (currentDate - date < milliseconds);
}

$(document).ready(function () {
    if (typeof session === 'undefined' && false) {
        let session_id = localStorage.getItem('jacesites_data.session_id');
        if (typeof session_id === 'string') {
            let data = new FormData();
            data.append('session_key', session_id);
            ajax({
                url: '/api/login',
                method: 'post',
                data: data,
                success: function (data) {
                    if (data.status == 'success') {
                        localStorage.setItem('jacesites_data.session_id', data.session_key);
                        window.location.reload();
                    } else if (data.message == 'Неверный браузер') {
                        show_message('Ошибка', data.message);
                    } else if (data.message == 'Неверный ключ сессии') {
                        return;
                    } else if (data.message != null) {
                        show_message('Ошибка', data.message);
                    } else {
                        show_message('Ошибка', 'Неизвестная ошибка');
                    }
                }
            });
        }
    }

    $('.btn-download', null).click(function () {
        let link = document.createElement('a');
        link.target = '_blank';
        link.href = this.dataset.fileLink;
        link.style = 'display: none;';
        document.body.appendChild(link);
        link.click();
        $(link).remove();
    });

    Events.init();
});

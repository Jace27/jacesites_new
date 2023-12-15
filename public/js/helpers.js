window.ajax = (args) => {
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

    ajax_args.success = (data, status, xhr) => {
        if (args.success !== null && args.success !== undefined && typeof args.success === 'function')
            args.success(data);
    };

    if (args.show_errors === null || args.show_errors === undefined || args.show_errors == true) {
        if (args.error !== null && args.error !== undefined && typeof args.error === 'function') {
            ajax_args.error = (xhr) => {
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

window.sleep = (milliseconds) => {
    const date = Date.now();
    let currentDate = null;
    do {
        currentDate = Date.now();
    } while (currentDate - date < milliseconds);
}

window.Formatter = {
    datetime_format: (timestamp) => {
        return this.time_format(timestamp)+' '+this.date_format(timestamp);
    },
    date_format: (timestamp) => {
        let time = new Date(timestamp * 1000);
        let year = '0' + time.getFullYear();
        let month = '0' + time.getMonth();
        let day = '0' + time.getDay();
        return year.substring(year.length-4) + '-' + month.substring(month.length-2) + '-' + day.substring(day.length-2);
    },
    time_format: (timestamp) => {
        let time = new Date(timestamp * 1000);
        let hours = '0' + time.getHours();
        let minutes = '0' + time.getMinutes();
        let seconds = '0' + time.getSeconds();
        return hours.substring(hours.length-2) + ':' + minutes.substring(minutes.length-2) + ':' + seconds.substring(seconds.length-2);
    },
}

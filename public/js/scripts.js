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
                success: (data) => {
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

    $('.btn-download', null).click(() => {
        let link = document.createElement('a');
        link.target = '_blank';
        link.href = this.dataset.fileLink;
        link.style = 'display: none;';
        document.body.appendChild(link);
        link.click();
        $(link).remove();
    });

    Events.init();
    Users.init();
    rsa.init();
});

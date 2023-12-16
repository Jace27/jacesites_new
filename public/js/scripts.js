$(document).ready(function () {
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

    setTimeout(() => {
        let request_unseen_events = localStorage.getItem('jacesites.request_unseen_events');
        if (request_unseen_events === 'true') {
            ajax({
                url: '/api/events/get-unseen-important',
                method: 'get'
            });
            localStorage.setItem('jacesites.request_unseen_events', 'false');
        }
    }, 2000);

});

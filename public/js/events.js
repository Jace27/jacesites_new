let Events = {
    events: [],
    handle: function (event, timestamp) {
        let time = this.time_format(timestamp);
        switch (event.type) {
            case 'user-login':
                this.display(event.name+' в сети', null, time);
                break;
            case 'user-logout':
                this.display(event.name+' вышел из сети', null, time);
                break;
        }
    },
    init: function () {
        Echo.channel('public-events')
            .listen('PublicEvent', (e) => {
                try {
                    e.event = JSON.parse(e.event);
                    this.add(e);
                    this.handle(e.event, e.timestamp);
                    console.log(e);
                } catch (ex) {
                    console.log([e,ex]);
                }
            });
    },
    send: function (event) {
        this.add(event);
        axios.post('/api/events/public', {event: event});
    },
    add: function (event) {
        this.events.push(event);
    },
    time_format: function (timestamp) {
        let time = new Date(timestamp * 1000);
        let hours = '0' + time.getHours();
        let minutes = '0' + time.getMinutes();
        let seconds = '0' + time.getSeconds();
        return hours.substring(hours.length-2) + ':' + minutes.substring(minutes.length-2) + ':' + seconds.substring(seconds.length-2);
    },
    display: function (title, text = null, time = null, background = 'white') {
        $('.event-popup').each(function (i, e) {
            $(e).animate({
                bottom: '+='+($(e).height()+10),
            });
        });
        let popup = $('<div class="event-popup" style="background: '+background+'">\n' +
            '    <div class="event-popup__header">\n' +
            '        <div class="event-popup__header__title">'+title+'</div>\n' +
            (time !== null ? '        <div class="event-popup__header__time">'+time+'</div>\n' : '') +
            '    </div>\n' +
            (text !== null ? '    <div class="event-popup__content">'+text+'</div>\n' : '') +
            '</div>');
        $('body').append(popup);
        popup.animate({
            bottom: 10,
        }, 1000, function () {
            setTimeout(function () {
                popup.animate({
                    opacity: 0,
                }, 1000, function () {
                    popup.remove();
                });
            }, 5000);
        });
    }
}

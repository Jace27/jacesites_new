window.Events = {
    customEventName: 'jacesites-public-event',
    events: [],
    init: () => {
        Echo.channel('public-events')
            .listen('PublicEvent', (e) => {
                console.log(e);
                try {
                    e.event = JSON.parse(e.event);
                    Events.add(e);
                    window.dispatchEvent(new CustomEvent(Events.customEventName, { detail: e }));
                } catch (ex) {
                    console.log([e,ex]);
                }
            });
        window.addEventListener(Events.customEventName, (e) => {
            let time = Formatter.time_format(e.detail.timestamp);
            switch (e.detail.event.type) {
                case 'user-login':
                    Events.display(e.detail.event.name+' в сети', null, time);
                    break;
                case 'user-logout':
                    Events.display(e.detail.event.name+' вышел из сети', null, time);
                    break;
            }
        });
    },
    send: (event) => {
        if (typeof event !== 'string')
            event = JSON.stringify(event);
        Events.add(event);
        axios.post('/api/events/public', {event: event});
    },
    add: (event) => {
        Events.events.push(event);
    },
    display: (title, text = null, time = null, timeout = 5000, background = 'white', callback = null) => {
        $('.event-popup').each((i, e) => {
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
        }, 1000, () => {
            let func = () => {
                popup.animate({
                    opacity: 0,
                }, 1000, () => {
                    popup.remove();
                });
            };
            if (timeout !== null) {
                setTimeout(func, timeout);
            } else {
                callback(func);
            }
        });
    }
}

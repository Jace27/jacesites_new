window.Events = {
    customEventName: 'jacesites-public-event',
    events: [],
    init: () => {
        Echo.channel('public-events')
            .listen('PublicEvent', (e) => {
                if (e.id !== null && Events.has(e.id)) return;
                console.log({channel: 'public-events', event: e});
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
                    Events.display.add(e.detail.event.name+' в сети', null, time);
                    break;
                case 'user-logout':
                    Events.display.add(e.detail.event.name+' вышел из сети', null, time);
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
    has: (id) => {
        let result = Events.events.find((item, index, array) => {
            return item.id === id;
        });
        return typeof result !== 'undefined';
    },

    display: {
        queue: [],
        count: () => {
            let count = 0;
            $('.event-popup').each((i, e) => {
                if ($(e).css('opacity') > 0) count++;
            });
            return count;
        },
        add: (title, text = null, time = null, timeout = 5000, background = 'white', callback = null) => {
            if (Events.display.count() >= 5) {
                Events.display.queue.push({
                    title: title, text: text, time: time, timeout: timeout,
                    background: background, callback: callback
                });
                return;
            }
            let popup = $(
                '<div class="event-popup" style="background: ' + background + '">\n' +
                '    <div class="event-popup__header">\n' +
                '        <div class="event-popup__header__title">' + title + '</div>\n' +
                (time !== null ?
                    '        <div class="event-popup__header__time">' + time + '</div>\n' : '') +
                '    </div>\n' +
                (text !== null ?
                    '    <div class="event-popup__content">' + text + '</div>\n' : '') +
                '</div>'
            );
            let wrapper = $('.event-popup-wrapper');
            let old_top = $(window).height() - wrapper.height();
            wrapper.append(popup);
            wrapper.css('top', old_top + 'px');
            wrapper.animate({
                top: $(window).height() - wrapper.height(),
            }, 1000, () => {
                let func = () => Events.display.remove(popup);
                if (timeout !== null) {
                    setTimeout(func, timeout);
                } else {
                    callback(func);
                }
            });
        },
        remove: (popup) => {
            popup.animate({
                opacity: 0,
            }, 1000, () => {
                if (Events.display.queue.length > 0) {
                    let next = Events.display.queue.splice(0, 1)[0];
                    Events.display.add(next.title, next.text, next.time, next.timeout, next.background, next.callback);
                }
                if (Events.display.count() < 1) {
                    $('.event-popup').remove();
                    $('.event-popup-wrapper').css('top', $(window).height() + 'px');
                }
            });
        }
    }
}

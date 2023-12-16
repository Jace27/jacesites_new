window.Users = {
    customEventName: 'jacesites-user-event',
    online: {},
    events: [],
    init: () => {
        if (session === null) return;
        Echo.private('user.'+session_id)
            .listen('UserEvent', (e) => {
                if (e.id !== null && Users.has(e.id)) return;
                console.log({channel: 'private-user.'+session_id, event: e});
                try {
                    e.event = JSON.parse(e.event);
                    Users.add(e);
                    window.dispatchEvent(new CustomEvent(Users.customEventName, { detail: e }));
                } catch (ex) {
                    console.log([e,ex]);
                }
            });
        window.addEventListener(Users.customEventName, (e) => {
            let time = Formatter.time_format(e.detail.timestamp);
            switch (e.detail.event.type) {
                case 'user-request':
                    switch (e.detail.event.request) {
                        case 'is-online':
                            Users.send({
                                type: 'user-response',
                                sender: session,
                                receiver: e.detail.event.sender,
                                response: true
                            });
                            break;
                    }
                    break;
                case 'user-login':
                    Events.display.add(e.detail.event.name+' в сети', null, time);
                    break;
                case 'user-logout':
                    Events.display.add(e.detail.event.name+' вышел из сети', null, time);
                    break;
            }
        });
    },
    request: (user, request, callback) => {
        if (session === null) return;

        let timeout = setTimeout(() => {
            window.removeEventListener(Users.customEventName, handler);
            callback(false);
        }, 10000);
        let handler = (e) => {
            switch (e.detail.event.type) {
                case 'user-response':
                    if (e.detail.event.sender !== user) return;
                    clearTimeout(timeout);
                    callback(e.detail);
                    break;
            }
        };
        window.addEventListener(Users.customEventName, handler);

        Users.send({
            type: 'user-request',
            sender: session,
            receiver: user,
            request: request
        }, user);
    },
    isOnline: (user, callback) => {
        Users.request(user, 'is-online', (response) => {
            if (response === false) {
                Users.online[user] = false;
                callback(false);
            } else {
                Users.online[response.event.sender] = response.event.response;
                callback(response.event.response);
            }
        });
    },
    send: (event, user) => {
        if (typeof event !== 'string')
            event = JSON.stringify(event);
        Users.add(event);
        axios.post('/api/events/user', {event: event, user: user});
    },
    add: (event) => {
        Users.events.push(event);
    },
    has: (id) => {
        let result = Users.events.find((item, index, array) => {
            return item.id === id;
        });
        return typeof result !== 'undefined';
    }
}

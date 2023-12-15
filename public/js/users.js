window.Users = {
    customEventName: 'jacesites-user-event',
    online: {},
    init: () => {
        window.addEventListener(Events.customEventName, (e) => {
            switch (e.detail.event.type) {
                case 'user-request':
                    if (typeof session === 'undefined' || e.detail.event.sender === session) return;
                    Users.handleRequest(e.detail);
                    window.dispatchEvent(new CustomEvent(Users.customEventName, { detail: e.detail }));
                    break;
                case 'user-response':
                    if (typeof session === 'undefined' || e.detail.event.sender === session) return;
                    window.dispatchEvent(new CustomEvent(Users.customEventName, { detail: e.detail }));
                    break;
            }
        });
    },
    handleRequest: (e) => {
        if (typeof session === 'undefined' || e.event.receiver !== session) return;
        switch (e.event.request) {
            case 'is-online':
                Events.send({
                    type: 'user-response',
                    sender: session,
                    receiver: e.event.sender,
                    response: true
                });
                break;
        }
    },
    request: (user, request, callback) => {
        if (typeof session === 'undefined') return;

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

        Events.send({
            type: 'user-request',
            sender: session,
            receiver: user,
            request: request
        });
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
    }
}

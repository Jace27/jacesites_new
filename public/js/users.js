window.Users = {
    customEventName: 'jacesites-user-event',
    online: {},
    init: () => {
        if (session === null) return;
        window.addEventListener(Events.customEventName, (e) => {
            switch (e.detail.event.type) {
                case 'user-request':
                case 'user-response':
                    if (e.detail.event.receiver !== session) return;
                    window.dispatchEvent(new CustomEvent(Users.customEventName, { detail: e.detail }));
            }
        });
        window.addEventListener(Users.customEventName, (e) => {
            if (e.detail.event.type != 'user-request') return;
            switch (e.detail.event.request) {
                case 'is-online':
                    Events.send({
                        type: 'user-response',
                        sender: session,
                        receiver: e.detail.event.sender,
                        response: true
                    });
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

window.rsa = {
    keys: {
        private: null,
        public: null
    },
    knownPublicKeys: {},

    init: (regenerateKeys = false) => {
        if (session === null) return;
        rsa.setKeys(regenerateKeys);
        window.addEventListener(Users.customEventName, (e) => {
            switch (e.detail.event.type) {
                case 'user-request':
                    switch (e.detail.event.request) {
                        case 'public-key':
                            Users.send({
                                type: 'user-response',
                                sender: session,
                                receiver: e.detail.event.sender,
                                response: rsa.keys.public
                            }, e.detail.event.sender);
                            break;
                    }
                    break;
                case 'encrypted-message':
                    console.log(rsa.decrypt(e.detail.event.text, rsa.keys.private));
                    break;
            }
        });
    },

    setKeys: (regenerateKeys = false) => {
        if (typeof localStorage.getItem('jacesites.rsa.keys') === 'string' && !regenerateKeys) {
            rsa.keys = JSON.parse(localStorage.getItem('jacesites.rsa.keys'));
            if (rsa.keys.public === null || rsa.keys.private === null) rsa.generateKeys();
        } else {
            rsa.generateKeys();
        }
        if (rsa.keys.public === null || rsa.keys.private === null) return;
        localStorage.setItem('jacesites.rsa.keys', JSON.stringify(rsa.keys));
    },
    requestKey: (user, callback) => {
        if (typeof rsa.knownPublicKeys[user] === 'string') {
            callback(rsa.knownPublicKeys[user]);
            return;
        }
        Users.request(user, 'public-key', (response) => {
            if (response === false) {
                rsa.knownPublicKeys[user] = null;
                callback(null);
            } else {
                rsa.knownPublicKeys[response.event.sender] = response.event.response;
                callback(response.event.response);
            }
        });
    },
    sendEncryptedMessage: (user, text) => {
        if (session === null) return;
        rsa.requestKey(user, (key) => {
            if (typeof key === 'string') {
                Users.send({
                    type: 'encrypted-message',
                    receiver: user,
                    sender: session,
                    text: rsa.encrypt(text, key)
                }, user);
            } else {
                console.error('cannot get encryption key');
            }
        });
    },

    arrayBufferToBase64: (arrayBuffer) => {
        let byteArray = new Uint8Array(arrayBuffer);
        let byteString = '';
        for (let i=0; i < byteArray.byteLength; i++) {
            byteString += String.fromCharCode(byteArray[i]);
        }
        return window.btoa(byteString);
    },
    addNewLines: (str) => {
        let finalString = '';
        while (str.length > 0) {
            finalString += str.substring(0, 64) + '\n';
            str = str.substring(64);
        }
        return finalString;
    },
    toPem: (privateKey) => {
        let b64 = rsa.addNewLines(rsa.arrayBufferToBase64(privateKey));
        return "-----BEGIN PRIVATE KEY-----\n" + b64 + "-----END PRIVATE KEY-----";
    },
    toPub: (privateKey) => {
        let b64 = rsa.addNewLines(rsa.arrayBufferToBase64(privateKey));
        return "-----BEGIN PUBLIC KEY-----\n" + b64 + "-----END PUBLIC KEY-----";
    },
    generateKeys: () => {
        // Let's generate the key pair first
        window.crypto.subtle.generateKey(
            {
                name: "RSA-OAEP",
                modulusLength: 2048, // can be 1024, 2048 or 4096
                publicExponent: new Uint8Array([0x01, 0x00, 0x01]),
                hash: {name: "SHA-256"} // or SHA-512
            },
            true,
            ["encrypt", "decrypt"]
        ).then((keyPair) => {
            /**
             * now when the key pair is generated we are going
             * to export it from the keypair object in pkcs8
             */
            window.crypto.subtle.exportKey(
                "pkcs8",
                keyPair.privateKey
            ).then((exportedPrivateKey) => {
                // converting exported private key to PEM format
                rsa.keys.private = rsa.toPem(exportedPrivateKey);
            }).catch((err) => {
                console.log(err);
            });

            window.crypto.subtle.exportKey(
                "spki",
                keyPair.publicKey
            ).then((exportedPublicKey) => {
                rsa.keys.public = rsa.toPub(exportedPublicKey);
            }).catch((err) => {
                console.log(err);
            });
        });
    },
    encrypt: (text, publicKey) => {
        let encrypter = new JSEncrypt();
        encrypter.setPublicKey(publicKey);
        return encrypter.encrypt(text);
    },
    decrypt: (text, privateKey) => {
        let decrypter = new JSEncrypt();
        decrypter.setPrivateKey(privateKey);
        return decrypter.decrypt(text);
    }
}

window.rsa = {
    keys: {
        private: null,
        public: null
    },
    init: function () {
        this.generateKeys();
    },
    arrayBufferToBase64: function (arrayBuffer) {
        let byteArray = new Uint8Array(arrayBuffer);
        let byteString = '';
        for (let i=0; i < byteArray.byteLength; i++) {
            byteString += String.fromCharCode(byteArray[i]);
        }
        return window.btoa(byteString);
    },
    addNewLines: function (str) {
        let finalString = '';
        while (str.length > 0) {
            finalString += str.substring(0, 64) + '\n';
            str = str.substring(64);
        }
        return finalString;
    },
    toPem: function (privateKey) {
        let b64 = this.addNewLines(this.arrayBufferToBase64(privateKey));
        return "-----BEGIN PRIVATE KEY-----\n" + b64 + "-----END PRIVATE KEY-----";
    },
    toPub: function (privateKey) {
        let b64 = this.addNewLines(this.arrayBufferToBase64(privateKey));
        return "-----BEGIN PUBLIC KEY-----\n" + b64 + "-----END PUBLIC KEY-----";
    },
    generateKeys: function () {
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
        ).then(function (keyPair) {
            /**
             * now when the key pair is generated we are going
             * to export it from the keypair object in pkcs8
             */
            window.crypto.subtle.exportKey(
                "pkcs8",
                keyPair.privateKey
            ).then(function (exportedPrivateKey) {
                // converting exported private key to PEM format
                rsa.keys.private = rsa.toPem(exportedPrivateKey);
            }).catch(function (err) {
                console.log(err);
            });

            window.crypto.subtle.exportKey(
                "spki",
                keyPair.publicKey
            ).then(function (exportedPublicKey) {
                rsa.keys.public = rsa.toPub(exportedPublicKey);
            }).catch(function (err) {
                console.log(err);
            });
        });
    },
    encrypt: function (text, publicKey) {
        let encrypter = new JSEncrypt();
        encrypter.setPublicKey(publicKey);
        return encrypter.encrypt(text);
    },
    decrypt: function (text, privateKey) {
        let decrypter = new JSEncrypt();
        decrypter.setPrivateKey(privateKey);
        return decrypter.decrypt(text);
    }
}

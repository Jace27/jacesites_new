window.Dump = {
    items: {},
    get: (name = 'dump') => {
        let dump = localStorage.getItem(name);
        if (typeof dump == 'string') {
            dump = JSON.parse(dump);
        }
        if (typeof dump != 'object' || dump === null) {
            dump = {};
        }
        Dump.items[name] = dump;
        return Dump.items[name];
    },
    set: (name = 'dump', data) => {
        Dump.items[name] = data;
    },
    save: () => {
        for (let itemsKey in Dump.items) {
            localStorage.setItem(itemsKey, JSON.stringify(Dump.items[itemsKey]));
        }
    }
}

function saveDump() {
    let data = {};
    for (let i = 0; i < dump_fields.length; i++) {
        data[dump_fields[i]] = $('[name="'+dump_fields[i]+'"]').val();
        if (tinymce.get(dump_fields[i]) !== null) {
            data[dump_fields[i]] = tinymce.get(dump_fields[i]).getContent();
        }
    }
    let dump = getDump();
    dump[dump_type] = {
        date: (new Date()).getTime(),
        data: data
    };
    localStorage.setItem('dump', JSON.stringify(dump));
}

function loadDump() {
    let dump = getDump();
    if (typeof dump[dump_type] != 'undefined') {
        for (let i = 0; i < dump_fields.length; i++) {
            $('[name="'+dump_fields[i]+'"]').val(dump[dump_type].data[dump_fields[i]]);
            if (tinymce.get(dump_fields[i]) !== null) {
                tinymce.get(dump_fields[i]).setContent(dump[dump_type].data[dump_fields[i]]);
            }
        }
    }
}

function getDump() {
    let dump = localStorage.getItem('dump');
    if (typeof dump == 'string') {
        dump = JSON.parse(dump);
    }
    if (typeof dump != 'object' || dump === null) {
        dump = {};
    }
    return dump;
}

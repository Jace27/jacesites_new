let tags = {
    elements: [],
    has: (id) => {
        let result = false;
        $.each(tags.elements, (key, tag) => {
            if (tag.id == id) {
                result = true;
            }
        });
        return result;
    },
    add: (id, name) => {
        if (tags.has(id)) return;
        tags.elements.push({
            id: id,
            name: name,
        });
        $('.tags__selected').append('<div class="tag tag-style" data-id="'+id+'"><span>'+name+'</span></div>');
        reset_handlers();
    },
    remove: (id) => {
        if (!tags.has(id)) return;
        let index;
        $.each(tags.elements, (key, tag) => {
            if (tag.id == id) {
                index = key;
            }
        });
        tags.elements.splice(index, 1);
        $('.tags__selected .tag').each((key, object) => {
            if (object.dataset.id == id) {
                $(object).remove();
            }
        });
        reset_handlers();
    }
};
let files = [];

$(document).ready(() => {
    let btnAttachImage = $('.btn-attach-image');
    let btnSaveDream = $('.btn-save-dream');
    let tagsSuggestions = $('.tags__suggestions');

    let saved = Dump.get(dump_type);
    if (typeof saved == 'object') {
        if (typeof saved.title != 'undefined' && typeof saved.description != 'undefined') {
            $('input[name="date"]').val(saved.date);
            $('input[name="title"]').val(saved.title);
            $('textarea[name="description"]').val(saved.description);
            files = JSON.parse(saved.files);
            if (files.length > 0) $('#images').html('');
            $.each(files, (key, filename) => {
                $('#images').append('<img src="/images/temp/' + filename + '" data-filename="' + filename + '">');
            });
            $.each(JSON.parse(saved.tags), (key, tag) => {
                tags.add(tag.id, tag.name);
            });
            $('input[name="hide"]').prop('checked', saved.hide);
        }
    }

    setInterval(() => {
        let saved = {
            'date': $('input[name="date"]').val(),
            'title': $('input[name="title"]').val(),
            'description': $('textarea[name="description"]').val(),
            'files': JSON.stringify(files),
            'tags': JSON.stringify(tags.elements),
            'hide': $('input[name="hide"]').prop('checked')
        };
        Dump.set(dump_type, saved);
        Dump.save();
    }, 60 * 1000);

    $('form').submit((e) => {
        e.preventDefault();
    });
    btnSaveDream.click(() => {
        if ($('input[name="title"]').val().trim() != '' &&
            $('textarea[name="description"]').val().trim() != '') {
            btnSaveDream.html('Загрузка...');
            btnSaveDream.prop('disabled', true);

            let data = new FormData();
            data.append('date', $('input[name="date"]').val());
            data.append('title', $('input[name="title"]').val());
            data.append('description', $('textarea[name="description"]').val());
            data.append('files', JSON.stringify(files));
            data.append('tags', JSON.stringify(tags.elements));
            data.append('hide', $('input[name="hide"]').prop('checked'));

            ajax({
                url: url,
                method: 'post',
                data: data,
                success: (data) => {
                    if (data.status == 'success') {
                        Dump.set(dump_type, null);
                        Dump.save();
                        window.location.assign('/dream/' + data.id);
                    } else {
                        btnSaveDream.html('Сохранить сон');
                        btnSaveDream.prop('disabled', false);
                        show_message('Ошибка', data.message);
                    }
                },
                error: (data) => {
                    btnSaveDream.html('Сохранить сон');
                    btnSaveDream.prop('disabled', false);
                    show_message('Ошибка', data.message);
                }
            });
            // show_message('Ошибка', 'Не удалось войти в аккаунт, добавление сна невозможно. В новой вкладке зайдите в аккаунт вручную, после чего в этой вкладке попробуйте отправить сон снова.');
        } else {
            show_message('Ошибка', 'Заполните поля заголовка и описания сна');
        }
    });

    btnAttachImage.click(() => {
        btnAttachImage.prev().click();
    });
    $('input[type=file]').change((e) => {
        let input = e.currentTarget;
        if (input.files.length > 0) {
            btnAttachImage.html('Загрузка...');
            btnAttachImage.prop('disabled', true);

            let data = new FormData();
            $.each(input.files, (key, value) => {
                data.append(key, value);
            });
            $(input).val('');
            ajax({
                url: '/api/media/upload',
                method: 'post',
                data: data,
                success: (data) => {
                    $('.btn-attach-image').html('Загрузить изображение');
                    $('.btn-attach-image').prop('disabled', false);

                    if (data.status == 'success') {
                        if ($('#images').html() == 'Нет изображений') {
                            $('#images').html('');
                        }
                        data.files.forEach((value, index, array) => {
                            files.push(value);
                            $('#images').append('<img src="/images/temp/' + value + '" data-filename="' + value + '">');
                        });
                        reset_handlers();
                    } else {
                        show_message('Ошибка', data.message);
                    }
                },
                error: (data) => {
                    btnAttachImage.html('Загрузить изображение');
                    btnAttachImage.prop('disabled', false);
                    console.log(data);
                }
            });
        }
    });

    let handler = (e) => {
        let query = $.trim($(e.currentTarget).val());
        if (query == '') {
            tagsSuggestions.css('display', 'none');
            tagsSuggestions.html('');
            return;
        }
        let data = new FormData();
        data.append('query', $(e.currentTarget).val());
        ajax({
            url: '/api/dream/tags/search',
            method: 'post',
            data: data,
            success: (data) => {
                if (data.status == 'success') {
                    tagsSuggestions.html('');
                    $.each(data.data, (key, tag) => {
                        tagsSuggestions.append('<div class="tag tag-style" data-id="'+tag.id+'" data-uses="'+tag.uses+'" data-groud_id="'+tag.group.id+'"><span>'+tag.name+'</span></div>');
                    });
                    if (data.data.length > 0) {
                        tagsSuggestions.css('display', 'flex');
                    } else {
                        tagsSuggestions.css('display', 'none');
                    }
                    reset_handlers();
                } else if (data.status == 'error') {
                    show_message('Ошибка', data.message);
                } else {
                    console.log(data);
                    show_message('Ошибка', 'Неизвестная ошибка');
                }
            },
            error: (data) => {
                console.log(data);
            }
        })
    };
    $('input[name=tags_search]').on('input', handler);
    $('input[name=tags_search]').on('focusin', handler);
    $('body').click((e) => {
        if (!$(e.currentTarget).hasClass('tag')) {
            tagsSuggestions.css('display', 'none');
            tagsSuggestions.html('');
        }
    });
});

function reset_handlers() {
    let imgs_selector = $('#images img');
    let tags_selector = $('.tag');

    imgs_selector.unbind('click');
    imgs_selector.click((e) => {
        let img = e.currentTarget;
        let data = new FormData();
        let src = img.dataset.filename;
        data.append('image', src);
        ajax({
            url: '/api/media/temp/delete',
            method: 'post',
            data: data,
            async: false,
            success: (data) => {
                if (data.status == 'success') {
                    $(img).remove();
                    files.forEach((filename, index, array) => {
                        if (filename == src) {
                            files.splice(index, 1);
                        }
                    });
                } else {
                    show_message('Ошибка', data.message);
                }
            },
            error: (data) => {
                show_message('Ошибка', data.responseJSON.message);
            }
        });
        if (imgs_selector.length == 0) {
            $('#images').html('Нет изображений');
        }
    });

    tags_selector.unbind('click');
    tags_selector.click((e) => {
        if ($(e.currentTarget).parent().hasClass('tags__suggestions')) {
            tags.add(e.currentTarget.dataset.id, $(e.currentTarget).children().text());
            $('input[name=tags_search]').val('');
        } else {
            tags.remove(e.currentTarget.dataset.id);
        }
    });
}

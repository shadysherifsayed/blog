/** Serialize Form as JSON */
(function ($) {
    $.fn.serializeFormJSON = function () {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        if (o.hasOwnProperty('_token')) {
            let token = o['_token'];
            if (Array.isArray(token)) {
                o['_token'] = token[0];
            }
        }
        return o;
    };
})(jQuery);
/** Serialize Form as JSON */

function CSRFToken() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

$('input, textarea').attr('autocomplete', 'off');

function displayErrors(errors) {

    for (const error in errors) {

        let id = `error-${error}`;

        if (exists('#' + id)) continue;

        let input = $(`[name="${error}"]`);

        if (input.length == 0) {
            input = $(`[name="${error}[]"]`);
        }

        let type = input.attr('type');

        if (type === 'hidden' && !input.hasClass('show')) continue;

        let small = `<small class='text-danger feedback' id="${id}"> ${errors[error]} </small>`;

        if (type === 'checkbox' || type === 'radio') {
            let parent = $(`[parent=${error}]`) || input.parents('.form-group');;
            parent.append(small);
        }
        else if (input.parent().hasClass('input-group')) {
            input.parent().after(small);
        } else if (input.next().hasClass('note-editor')) {
            input.next('.note-editor').after(small);
        } else if (input.next().hasClass('tail-select')) {
            input.next().find('.select-dropdown').before(small);
        } else {
            input.after(small);
        }

    }
}

$('form.file-ajax').submit(function (e) {

    e.preventDefault();

    submitFileForm(this);
});

$('form.ajax').submit(function (e) {

    e.preventDefault();

    submitForm($(this));
});


$(document).on('keyup', 'input, textarea', function () {

    let name = $(this).attr('name');

    if (name === undefined || name.includes('[]')) return;

    let error = `#error-${name}`;

    $(error).remove();
});

$(document).on('change', 'select, input[type=radio], input[type=checkbox]', function () {

    let name = $(this).attr('name');

    if (name === undefined || name.includes('[]')) return;

    $(`#error-${name}`).remove();
});

const submitForm = function (form, successCallback = defaultSuccess, errorCallback = defaultError) {

    let hiddenMethod = form.find('input[name="_method"]').val();

    let method = (hiddenMethod === undefined) ? form.attr('method') : hiddenMethod;

    let data = form.serializeFormJSON();

    let action = form.attr('action');

    if (method.toUpperCase() !== 'GET') {
        CSRFToken();
    }

    $.ajax({
        type: method,
        url: action,
        data: data,
        success: successCallback,
        error: errorCallback
    });
}

const submitFileForm = function (form, successCallback = defaultSuccess, errorCallback = defaultError) {

    let formEl = $(form);

    let hiddenMethod = formEl.find('input[name="_method"]').val();

    let method = (hiddenMethod === undefined) ? formEl.attr('method') : hiddenMethod;

    let data = new FormData(form);

    let action = formEl.attr('action');

    if (method.toUpperCase() !== 'GET') {
        CSRFToken();
    }

    if (method.toUpperCase() === 'PUT') {
        method = 'POST'
    }

    $.ajax({
        type: method,
        url: action,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: successCallback,
        error: errorCallback,
    });
}

const defaultSuccess = function (response) {
    if (response.redirect) {
        window.location = response.redirect;
    }
}

const defaultError = function (response) {
    if (response.responseJSON) {
        let errors = response.responseJSON.errors;
        if (errors) {
            displayErrors(errors);
        }
    }
}

const exists = selector =>  $(selector).length > 0;

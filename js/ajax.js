$(document).ready(function () {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    form.on('submit', function (event) {
        event.preventDefault();
        $('div[data-error]').remove();
        callAjax(form);
    });
    $('.discharge').on('click', function () {
        event.preventDefault();
        $this = $(this);
        $status = $this.closest('tr').children('.status');
        $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            data: {
                _method: 'patch'
            },
            success: function (data) {
                $status.html('discharged');
                $this.remove();
                notify("Discharged", 'success')
            },
            error: function (data) {
                notify("Some thing wrong", 'inverse')
            }
        });
    });
    $(document.body).on('click', '.ajax-delete', function (event) {
        event.preventDefault();
        let $row = $(this).closest('tr');
        $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            data: {
                _method: 'delete'
            },
            success: function (data) {
                $row.remove();
                notify("Deleted", 'danger')
            },
            error: function (data) {
                notify("Some thing wrong", 'inverse')
            }
        });
    });
    $('.is-invalid').on('change', function () {
        $(this).removeClass('is-invalid');
        $(this).parent().removeClass('form-danger form-static-label');
        let name = $(this).attr('name');
        $('div[data-error=' + name + ']').remove();
    });
});

let form = $('#ajax-form');

function callAjax(form) {
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        success: function (data) {
            notify("Saved Successfully", 'success');
            if (form.attr('data-ajax') != "update") {
                form.trigger("reset");
            }
            if (data.redirect) {
                window.location.replace(data.redirect);
            }
        },
        error: function (data) {
            'use strict';
            $('div[data-error]').remove();
            let message = data.responseJSON.message;
            let validation_messages = data.responseJSON.errors;
            for (var name in validation_messages) {
                if (!validation_messages.hasOwnProperty(name)) continue;
                let fieldError = validation_messages[name];
                for (let prop in fieldError) {
                    if (!fieldError.hasOwnProperty(prop)) continue;
                    // main code
                    let field = $("[name='" + name + "']");
                    field.addClass('is-invalid');
                    field.addClass('is-invalid');
                    field.parent().addClass('form-danger form-static-label');
                    field.after(' <div data-error="' + name + '" class="invalid-feedback">' + fieldError + ' </div>')
                }
            }
            notify(message, 'inverse');
        }
    });
}
$('.ajax-form').on('submit', function (e) {
    e.preventDefault();
    let form = $(this);
    callAjax(form)
});
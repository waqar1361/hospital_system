let start = 1;
let previous = start;

function makeHtml(type) {
    previous++;
    let current = previous;
    return '<div class="input-group mb-3">' +
        '<div class="input-group-prepend">' +
        '<button type="button" class="btn btn-success reported"' +
        'data-get="' + type + '-' + current + '-state">Reported' +
        '</button>' +
        '</div>' +
        '<input type="text" class="form-control col-2 text-right state"' +
        'name="reviews[' + type + '][' + current + '][state]"' +
        'id="' + type + '-' + current + '-state" readonly>' +
        '<input type="text" class="form-control" placeholder="description"' +
        'name="reviews[' + type + '][' + current + '][description]">' +
        '<div class="input-group-append">' +
        '<button type="button" class="btn btn-danger denial"' +
        'data-get="' + type + '-' + current + '-state">Denial' +
        '</button>' +
        '</div>' +
        '</div>';
}

$('.add-new').on('click', function (event) {
    event.preventDefault();
    let type = $(this).attr('data-type');
    let section = $('#more-' + type);
    section.append(makeHtml(type));
});

$(document).on('click', '.remove-box', function (event) {
    event.preventDefault();
    let $card = $(this).closest('.input-group');
    $card.remove();
});

$(document.body).on('click', '.reported', function () {
    let id = $(this).attr('data-get');
    let state = $('#' + id);
    state.val('reported : ');
});

$(document.body).on('click', '.denial', function () {
    let id = $(this).attr('data-get');
    let state = $('#' + id);
    state.val('denial : ');
});

// Forms

let noteForm = $('#ajax-note');
noteForm.on('submit', function (event) {
    event.preventDefault();
    $.ajax({
        url: noteForm.attr('action'),
        type: 'post',
        data: noteForm.serialize(),
        success: function (data) {
            notify("Saved Successfully", 'success');
            $('#bill').append('<h3>Total Bill: ' + data.bill + '</h3>');
        },
        error: function (data) {
            notify("Check the input Fields", 'inverse');
        }
    });
});
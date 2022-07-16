require('../shared/bootstrap');
require('flatpickr');
require('select2');

// Custom
require('../shared/flatpickr-custom');

// Remove invalid alert on input
$(document).on('input change', 'input.is-invalid', function() {
    $(this).siblings().filter('.invalid-tooltip').remove();
    $(this).removeClass('is-invalid');
});

// Clean Button
$(document).on('click', '.btn-clean', function () {
    $form = $(this).closest('form');

    $form.find('select, input:not([type="radio"]):not([type="checkbox"])').val('').change();
    $form.find('input[type="radio"],input[type="checkbox"]').prop('checked', false).change();
});

// Show filename on Bootstrap's custom file input
$(document).on('change', '.custom-file-input', function() {
    let filename = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(filename);
});

$(document).ready( function () {

    // Select2
    $('.select2-select:required').find('option[value=""]').prop('disabled', true).change();

    $('.select2-select').select2({
        theme: 'bootstrap4',
    });

    // Show filename on Bootstrap's custom file input
    $('.custom-file-input').each(function() {
        let filename = $(this).data('file');
        if (filename) {
            $(this).siblings(".custom-file-label").addClass("selected").html(filename);
        }
    });

    // Fixes dropdowns inside short tables
    $('.table-responsive').on('scroll', function () {
        $(this).find('.dropdown.show').dropdown('toggle');
    });

});

const Spanish = require("flatpickr/dist/l10n/es.js").default.es;
flatpickr.localize(Spanish);

$(document).ready(function () {
    $('.flatpickr-target').each(function() {
        let datePicker = flatpickr(this, {
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: $(this).data('flatpickr-format') ? $(this).data('flatpickr-format') : "Y-m-d",
            allowInput: $(this).data('flatpickr-allow-input') ? true : false
        });

        if ($(this).data('flatpickr-allow-input')) {
            datePicker._input.addEventListener('blur', function (event) {
                let date = datePicker.parseDate(datePicker._input.value, datePicker.config.altFormat ? datePicker.config.altFormat : datePicker.config.dateFormat);
                datePicker.setDate(date);
            }, true);
        }
    });
});

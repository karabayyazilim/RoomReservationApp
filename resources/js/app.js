import {Turkish} from "flatpickr/dist/l10n/tr";

require('./bootstrap');

import Alpine from 'alpinejs';
import flatpickr from "flatpickr";

flatpickr("#start_date", {
    enableTime: true,
    dateFormat: "Y-m-d H:i:ss",
    locale: Turkish,
    minDate: "today",
    maxDate: new Date().fp_incr(14)
});
flatpickr("#end_date", {
    enableTime: true,
    dateFormat: "Y-m-d H:i:ss",
    locale: Turkish,
    minDate: "today",
    maxDate: new Date().fp_incr(14)
});

window.Alpine = Alpine;

Alpine.start();

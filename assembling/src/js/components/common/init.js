
MicroModal.init(
    {
        // disableScroll: true, // [6]
        // awaitOpenAnimation: true, // [8]
        // awaitCloseAnimation: true, // [9]
    }
);

import AirDatepicker from 'air-datepicker';
import 'air-datepicker/air-datepicker';


new AirDatepicker('#cardCallbackData', {
    position: 'top center',
    timepicker: true
});


//Регистрация функций alpine
import rangeSliderInit from './alpine/rangeSliderInit.js';
import simpleSlider from "./alpine/simpleSlider.js";
import workSteps from "./alpine/workSteps.js";
import catalogSlider from "./alpine/catalogSlider.js";
import ourWorksSlider from "./alpine/ourWorksSlider.js";
import sertificateSlider from "./alpine/sertificateSlider.js";
import tableInclude from "./alpine/tableInclude.js";
import slowScroll from "./alpine/slowScroll.js";
import catalogControl from "./alpine/catalogControl.js";
import alpineMask from "./alpine/alpineMask.js";
import PaginateCheck from "./alpine/PaginateCheck.js";
import CalendarView from "./alpine/CalendarView.js";
import contactsMap from "./alpine/contactsMap.js";

document.addEventListener("alpine:init", function () {
    Alpine.data('rangeSliderInit', rangeSliderInit);
    Alpine.data('simpleSlider', simpleSlider);
    Alpine.data('catalogSlider', catalogSlider);
    Alpine.data('workSteps', workSteps);
    Alpine.data('ourWorksSlider', ourWorksSlider);
    Alpine.data('sertificateSlider', sertificateSlider);
    Alpine.data('tableInclude', tableInclude);
    Alpine.data('slowScroll', slowScroll);
    Alpine.data('catalogControl', catalogControl);
    Alpine.data('alpineMask', alpineMask);
    Alpine.data('PaginateCheck', PaginateCheck);
    Alpine.data('CalendarView', CalendarView);
    Alpine.data('contactsMap', contactsMap);
});

import form from '/js-export-function/form.js';

document.addEventListener('DOMContentLoaded', function () {
    const filters = document.getElementById('project_container')?.querySelectorAll('input');
    const forms_data_category = document.getElementById('project_filter')?.getAttribute('data-term_category');
    let append_data = {
        action: 'filter_project',
    };
    let append_data_json = JSON.stringify(append_data);
    if (forms_data_category !== '')
        form('project_filter', append_data_json, 'catalog__item_container', 'link');
    filters?.forEach(filter => {
        filter.addEventListener('click', () => {
            form('project_filter', append_data_json, 'catalog__item_container', 'link');
        });
    });
})

window.number_format = (number, decimals, dec_point, thousands_sep) => {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}


window.cardFormData = (e) => {
    const CUR_BTN = e.target;
    const FORM = document.querySelector('.modalCallback');

    // Проверить, найдена ли форма
    if (!FORM) return;

    // Найти поля внутри формы по их атрибуту name
    const ACTION_INPUT = FORM.querySelector('input[name="CurAction"]');
    const MATERIAL_INPUT = FORM.querySelector('input[name="CurMaterial"]');
    const COMPLECTATION_INPUT = FORM.querySelector('input[name="CurComplectation"]');
    const PRICE_INPUT = FORM.querySelector('input[name="CurPrice"]');
    const CUR_URL_INPUT = FORM.querySelector('input[name="CurUrl"]');
    const FORM_TITLE = document.querySelector('.callbackModal__title');

    // Установить значения для каждого поля
    ACTION_INPUT.value = CUR_BTN.dataset?.formAction;
    MATERIAL_INPUT.value = CUR_BTN.dataset?.curMaterial;
    COMPLECTATION_INPUT.value = CUR_BTN.dataset?.curComplect;
    PRICE_INPUT.value = CUR_BTN.dataset?.curPrice;
    CUR_URL_INPUT.value = CUR_BTN.dataset?.currentUrl;
    FORM_TITLE.textContent = CUR_BTN.dataset?.formTitle;
    MicroModal.show('callbackModal');
}


// window.copyText = async (text) => {
//     try {
//         await navigator.clipboard.writeText(text);
//         console.log('Текст скопирован успешно');
//     } catch (err) {
//         console.error('Не удалось скопировать текст: ', err);
//     }
// }

window.copyText = async (textToCopy) => {
    // Navigator clipboard api needs a secure context (https)
    if (navigator.clipboard && window.isSecureContext) {
        await navigator.clipboard.writeText(textToCopy);
    } else {
        // Use the 'out of viewport hidden text area' trick
        const textArea = document.createElement("textarea");
        textArea.value = textToCopy;

        // Move textarea out of the viewport so it's not visible
        textArea.style.position = "absolute";
        textArea.style.left = "-999999px";

        document.body.prepend(textArea);
        textArea.select();

        try {
            document.execCommand('copy');
        } catch (error) {
            console.error(error);
        } finally {
            textArea.remove();
        }
    }
}


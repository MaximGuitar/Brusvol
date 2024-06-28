import createNewUrl from '/js-export-function/createNewUrl.js';
var serialize = require('form-serialize');
/**
* Функция для отправки form ajax запросом
*
* @param {string} id_form id формы
* @param {array} append_data JSON массив с дополнительными полями для добавления к запросу
* @param {string} container_data контейнер, в который будет загружен html ответ
* @returns html структура
*/
export default function form(id_form, append_data, container_data, link = null) {

    const forms = document?.getElementById(id_form);
    if (!forms)
        return;
    const formData = new FormData(forms);
    if (link != null) {
        let params_string = '';
        params_string += '&' + serialize(forms);
        let filter_data = new URLSearchParams(params_string);
        createNewUrl(filter_data.toString());
    }
    if (append_data !== '') {
        var jsonObject = JSON.parse(append_data);
        for (var key in jsonObject) {
            if (jsonObject.hasOwnProperty(key)) {
                var value = jsonObject[key];
                formData.append(key, value);
            }
        }
    }
    fetch(forms.action, {
        method: forms.method,
        body: formData,
    })
        .then(response => response.text())
        .then(data => {
            document.querySelector("." + container_data).innerHTML = data;
        })
        .catch(error => {
            console.error('Ошибка запроса в форме с id ' + id_form + ':', error);
        });
}
    /**
 * Функция генерации урла с гет параметрами
 * @param {string} params_string строка запроса
 */
    export default function createNewUrl(params_string = '') {
        let newUrl = location.origin + location.pathname;
        console.log(params_string);
        
        if (params_string) {
            newUrl += '?' + params_string;
        }
        history.pushState({path: newUrl}, '', newUrl);
    }
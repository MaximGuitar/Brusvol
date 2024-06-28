<?php
/**
 * Функция для кастомного построения меню
 * @param mixed $current_menu name меню в админке
 * @return mixed массив с деревом уровней меню
 */
function wp_get_menu_array($current_menu)
{
    $array_menus = wp_get_nav_menu_items($current_menu);
    $menu = array();
    foreach ($array_menus as $key => $array_menu) {
        $array_menus[$key]->current = false;
        $classes = (array) $array_menu->classes;
        $classes[] = 'menu-item';
        $classes[] = 'menu-item-type-' . $array_menu->type;
        $classes[] = 'menu-item-object-' . $array_menu->object;
        $array_menus[$key]->classes = array_unique($classes);
        if (empty($array_menu->menu_item_parent)) {
            $current_id = $array_menu->ID;
            $menu[$current_id] = array(
                'id' => $current_id,
                'title' => $array_menu->title,
                'href' => $array_menu->url,
                'classes' => $array_menu->classes,
                'children' => array()
            );
        }
        if (isset($current_id) && $current_id == $array_menu->menu_item_parent) {
            $submenu_id = $array_menu->ID;
            $menu[$current_id]['children'][$array_menu->ID] = array(
                'id' => $submenu_id,
                'title' => $array_menu->title,
                'href' => $array_menu->url,
                'img' => get_field('category_img', 'catalog_' . $array_menu->object_id),
                'classes' => $array_menu->classes,
                'children' => array()
            );
        }
        if (isset($submenu_id) && $submenu_id == $array_menu->menu_item_parent) {
            $menu[$current_id]['children'][$submenu_id]['children'][$array_menu->ID] = array(
                'id' => $array_menu->ID,
                'title' => $array_menu->title,
                'href' => $array_menu->url,
                'classes' => $array_menu->classes,
            );
        }
    }
    return $menu;
}





//Подключение библиотеки Valitron
use Valitron\Validator as V;

// Подключение библиотеки phpmailer
require 'phplibs/mailer/class.phpmailer.php';
require 'phplibs/mailer/class.smtp.php';
require 'phplibs/mailer/vendor/autoload.php';

// Хуки на форму
add_action('wp_ajax_sendMail', 'sendMail');
add_action('wp_ajax_nopriv_sendMail', 'sendMail');
function sendMail()
{
    // Проверка какой тип запроса используется
    if ($_SERVER["REQUEST_METHOD"] != "POST")
        return;

    V::langDir(__DIR__ . '/phplibs/composer/validator_lang'); // Путь к файлу перевода Valitron
    V::lang('ru'); // Подключение файла перевода

    //Подписи к отправляемым данным
    $library_mail_fields_label = array(
        'tel' => 'Номер телефона',
        'email' => 'Почта',
        'question' => 'Вопрос',
        'formName' => 'Запрос отправлен с формы',
        'name' => 'Имя',
        'lastname' => 'Фамилия',
        'page' => 'Страница с которой была отправлена форма',
        'taskDescr' => 'Задача пользователя',
        'CallDate' => 'Позвонить в эту дату и время',
        'CurAction' => 'Тема общения',
        'CurMaterial' => 'Выбранный материал дома',
        'CurComplectation' => 'Выбранная комплектация',
        'CurUrl' => 'Ссылка на проект',
        'CurPrice' => 'Цена проекта на сайте',
    );

    $mailTitle = "Текст письма";

    $v = new V($_POST);// Передаем валидатору запрос с полями
    $v->setPrependLabels(false); // Отключаем имена полей в начале ошибки
    if ($_REQUEST['formName']) {
        //Заголовок писма и массив обязательных полей ключ - название формы
        $library_mail_data = array(
            'footerCallback' => ['Проконсультировать пользователя по его задаче', ['email', 'taskDescr']],
            'cardCallback' => ['Перезвонить клиенту в это время', ['CallDate', 'tel']],
            'modalCallback' => ['Обратный звонок клиенту', ['name', 'tel']],
            'catalogForm' => ['Запись на экскурсию', ['CallDate', 'tel']]
        );
        $v->rule('required', $library_mail_data[$_REQUEST['formName']][1] ?? null); // Обязательные поля
        $mailTitle = $library_mail_data[$_REQUEST['formName']][0] ?? "Текст письма"; // Заголовок письма
    }

    // var_dump($library_mail_data[$_REQUEST['formName']][1] ?? null);

    $v->rule('email', 'email'); // проверка почты

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'm1.system.place-start.ru';
    $mail->Port = 25;
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->Subject = 'Письмо от клиента';
    $mail->setFrom('brusvol.ru@srv10.ps', 'brusvol.ru');
    $mail->addAddress('moroshkin.maksim@place-start.ru'); //Куда отправлять
    $message = '';
    $message .= '<h3>' . $mailTitle . '</h3><br>'; //Заголовок письма
    foreach ($_POST as $key => $value) {
        if ($key !== 'formName' && !empty($value) && $value!= '' && $value!= 'undefined') {
            $message .= '<p><b>' . $library_mail_fields_label[$key] . ': </b>' . $value . '</p>'; //Сбор письма
        }
    }
    $mail->Body = $message;

    $mail->isHTML(true);

    if ($v->validate()) {
        $mail->send();
        $status = true;
    } else {
        $status = false;
    }
    $v->validate();
    $errors = $v->errors();
    $errorMessages = [];
    foreach ($errors as $field => $fieldErrors) {
        $errorMessages[$field] = $fieldErrors;
    }

    //Форма должна называться также как и файл формы
    get_template_part(
        'components/forms/' . $_REQUEST['formName'],
        null,
        array(
            'status' => $status,
            'MailerErr' => $mail->ErrorInfo,
            'ValidatorErr' => $errorMessages,
            'Request' => $_REQUEST
        )
    );
    wp_die();
}

//подключаем свой файл стилей для админки
function my_acf_admin_enqueue_scripts()
{
    // wp_enqueue_style('my-acf-input-css', get_stylesheet_directory_uri() . '/static/css/my-acf-input.css', false, '1.0.0');
    // wp_enqueue_script( 'my-acf-input-js', get_stylesheet_directory_uri() . '/static/js/my-acf-input.js', false, '1.0.0' );
}


//проверяет родительская ли для этого поста категория
function CheckParentCategory($ID_parent_category)
{
    $currentCategories = get_the_category(get_queried_object_id());
    return in_array($ID_parent_category, wp_list_pluck($currentCategories, 'term_id'));
}

// Шорткоды плюса и минуса для таблицы комплектации
add_shortcode('da', 'da_shortcode');
add_shortcode('net', 'net_shortcode');
function da_shortcode($atts)
{
    return '<svg width="30" height="30" class="da" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M15 0V30M0 15H30" stroke="#588535" stroke-width="3"/>
    </svg>';
}

function net_shortcode($atts)
{
    return '<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path opacity="0.2" d="M15 0V30M0 15H30" stroke="#1C1F18" stroke-width="3"/>
    </svg>';
}

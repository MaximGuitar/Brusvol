<?php
require 'phplibs/kint/kint.phar';
add_action('wp_ajax_catalog_ajax', 'catalog_ajax');
add_action('wp_ajax_nopriv_catalog_ajax', 'catalog_ajax');
function catalog_ajax(){
    get_template_part( 'ajax-catalog' );
}
function get_catalog_filters_array($filter)
{
    $filters = array();
    foreach ($filter as $filterElem) {
        if (($filterElem->parent) == 0) {
            $term_id = $filterElem->term_id;
            $filters[$term_id] = array(
                'id' => $term_id,
                'name' => $filterElem->name,
                'slug' => $filterElem->slug,
                'children' => array()
            );
        } elseif (isset($term_id) && $term_id == $filterElem->parent) {
            $submenu_id = $filterElem->term_id;
            $filters[$term_id]['children'][$filterElem->term_id] = array(
                'id' => $submenu_id,
                'name' => $filterElem->name,
                'slug' => $filterElem->slug,
            );
        }
    }
    return $filters;
}
/*	Контент
---------------------------------------*/
require_once('includes/Content.php');

/*	Таксономия
---------------------------------------*/
require_once('includes/taxonomyes.php');
// Фильтрация проектов
// add_action('wp_ajax_filter_project', 'filter_project');
// add_action('wp_ajax_nopriv_filter_project', 'filter_project');
// function filter_project()
// {
//     var_dump($_REQUEST);
//     $order = 'ASC';
//     $orderby = 'date';
//     $metakey = '';
//     $order_array = array(
//         'a-ya' => 'ASC',
//         'ya-a' => 'DESC',
//         'low_cost' => 'ASC',
//         'hight_cost' => 'DESC',
//         'hight_square' => 'ASC',
//         'low_square' => 'DESC',
//         'popular' => 'date',
//     );
//     $filters = array();
//     $order_request = $_REQUEST['ordering'];
//     if ($order_request === 'a-ya' || $order_request === 'ya-a') {
//         $order = $order_array[$order_request];
//         $orderby = 'title';
//     }
//     if ($order_request === 'popular')
//         $orderby = $order_array[$order_request];
//     if ($order_request === 'low_cost' || $order_request === 'hight_cost') {
//         $order = $order_array[$order_request];
//         $orderby = 'meta_value_num';
//         $metakey = 'cost_project';
//     }
//     if ($order_request === 'hight_square' || $order_request === 'low_square') {
//         $orderby = 'meta_value_num';
//         $metakey = 'square_project';
//         $order = $order_array[$order_request];
//     }
//     if ($order_request === '')
//         $orderby = 'date';
//     foreach ($_POST['filters'] as $key => $values) {
//         $values_array = array();
//         foreach ($values as $value) {
//             $values_array[] = $value;
//         }
//         if (!empty(array_filter($values_array))) {
//             $filters[] = array(
//                 'taxonomy' => 'catalog',
//                 'field' => 'slug',
//                 'terms' => $values_array,
//                 'operator' => 'IN',
//             );
//         }
//     }
//     $args = array(
//         'post_type' => 'project',
//         'meta_key' => $metakey,
//         'orderby' => $orderby,
//         'order' => $order,
//         'tax_query' => $filters,
//         'posts_per_page' => get_field('count_visible_project', 'option'),
//     );
//     $projects = new WP_Query($args);
//     if ($projects->have_posts()) {
//         while ($projects->have_posts()) {
//             $projects->the_post();
//             get_template_part('components/project-card', null, [
//                 'post' => $projects->post,
//             ]);
//         }
//         // custom_query_pagination($projects);
//     } else
//         echo 'Записей не найдено.';
//     wp_reset_postdata();
//     wp_die();
// }


/*
Функция подключения файла с передачей в него данных.
Пример использования: render_partial('includes/components/section-advantages-one.php', ['param' => $i]);
*/
if (!function_exists('render_partial')) {
    function render_partial($template, $render_data)
    {
        extract($render_data);
        require locate_template($template);
    }
}


function seo_optimize()
{
    $url = $_SERVER["REQUEST_URI"];

    // Если урл состоит из нескольких уровней и is_front_page() выдаёт true, перекидываем на 404 страницу
    if ($url !== '/' && is_front_page() && empty($_GET)) {
        global $post, $wp_query;
        $wp_query->set_404();
        status_header(404);
        include(get_query_template('404'));
        die();
    }
}
add_action('wp', 'seo_optimize');



if (function_exists('register_sidebar'))
    register_sidebar(array('id' => 'sidebar-1'));


if (function_exists('add_theme_support')) {
    add_theme_support('menus');
}

if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
}


remove_filter('the_content', 'wpautop'); // для контента


function my_myme_types($mime_types)
{
    $mime_types['svg'] = 'image/svg+xml'; // поддержка SVG
    return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);




function get_file_info($file_info)
{

    $mime_types = array(
        'application/msword' => 'doc',
        'image/jpeg' => 'jpg',
        'application/pdf' => 'pdf',
        'image/png' => 'png',
        'application/vnd.ms-powerpoint' => 'ppt',
        'application/x-rar-compressed' => 'rar',
        'image/tiff' => 'tiff',
        'text/plain' => 'txt',
        'application/vnd.ms-excel' => 'xls',
        'application/zip' => 'zip',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
    );

    $file_size = array('b', 'kb', 'Mb');
    $file_info_output = array();
    $file_info_output['size'] = filesize(get_attached_file($file_info['id']));

    $i = 0;

    while ($file_info_output['size'] > 1024) {
        $file_info_output['size'] = $file_info_output['size'] / 1024;
        $i++;
    }

    $file_info_output['url'] = $file_info['url'];
    $file_info_output['size'] = round($file_info_output['size'], 2) . " " . $file_size[$i]; // Размер файла                           
    $file_info_output['mime'] = $mime_types[$file_info['mime_type']]; // Расширение файла

    if (is_null($file_info_output['mime']))
        $file_info_output['mime'] = 'none';

    $file_info_output['pathinfo'] = pathinfo(get_attached_file($file_info['id']));

    return $file_info_output;
}

/*	ACF
---------------------------------------*/
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(
        array(
            'page_title' => 'Главная страница',
            'menu_title' => 'Главная страница',
            'menu_slug' => 'main-settings',
            'capability' => 'edit_posts',
            'icon_url' => 'dashicons-welcome-write-blog',
            'redirect' => true
        )
    );

    acf_add_options_page(
        array(
            'page_title' => 'Общие настройки сайта',
            'menu_title' => 'Общие настройки сайта',
            'menu_slug' => 'general-settings',
            'capability' => 'edit_posts',
            'icon_url' => 'dashicons-admin-generic',
            'redirect' => true
        )
    );

}
add_filter('wpcf7_validate_configuration', '__return_false');


/*	Подстраница
---------------------------------------*/
if (!function_exists('is_subpage')) {
    /**
     * Функция проверяет текущий объект, является ли он подстраницей
     * @param integer $post_parent_id ИД родительской страницы, если необходимо
     *     boolean Или false, если данный атрибут необходимо пропустить
     * @param WP_Post $post Объект записи, если необходимо
     * null Или null, если необходимо опустить параметр
     * @return boolean Возвращает результат проверки
     * integer Или ИД родителя, если $post_parent_id = false
     */
    function is_subpage($post_parent_id = false, $post = null)
    {
        if (is_null($post))
            global $post;
        if (!is_page())
            return false;

        if ($post->post_parent) {
            if ($post_parent_id) {
                if ($post->post_parent != $post_parent_id && $post->post_parent > 0) {
                    return is_subpage($post_parent_id, get_post($post->post_parent));
                } else
                    return true;
            } else
                return $post->post_parent;
        } else {
            return false;
        }
    }
}

function wp_corenavi()
{
    global $wp_query;
    $total = isset($wp_query->max_num_pages) ? $wp_query->max_num_pages : 1;
    $a['total'] = $total;
    $a['mid_size'] = 2; // сколько ссылок показывать слева и справа от текущей
    $a['end_size'] = 1; // сколько ссылок показывать в начале и в конце
    $a['prev_text'] = '&laquo;'; // текст ссылки "Предыдущая страница"
    $a['next_text'] = '&raquo;'; // текст ссылки "Следующая страница"
    $a['format'] = '?page=%#%'; // Формат замены 
    $a['current'] = $_GET['page'] ? $_GET['page'] : 1; // Номер текущей страницы пагинации 

    if ($total > 1)
        echo '<nav class="pagination">';
    echo paginate_links($a);
    if ($total > 1)
        echo '</nav>';
}





//Добавление возможности добавлять группу полей конкретной категории
add_filter('acf/location/rule_values/category_id', 'acf_location_rules_values_category');
function acf_location_rules_values_category($choices)
{
    $terms = get_terms('category', ['hide_empty' => false]);
    if ($terms && is_array($terms)) {
        foreach ($terms as $term) {
            $choices[$term->term_id] = $term->name;
        }
    }
    return $choices;
}


function num_decline( $number, $titles, $show_number = true ){

	if( is_string( $titles ) ){
		$titles = preg_split( '/, */', $titles );
	}

	// когда указано 2 элемента
	if( empty( $titles[2] ) ){
		$titles[2] = $titles[1];
	}

	$cases = [ 2, 0, 1, 1, 1, 2 ];

	$intnum = abs( (int) strip_tags( $number ) );

	$title_index = ( $intnum % 100 > 4 && $intnum % 100 < 20 )
		? 2
		: $cases[ min( $intnum % 10, 5 ) ];

	return ( $show_number ? "$number " : '' ) . $titles[ $title_index ];
}

//Подключение моих функций
require 'phpCustomFunctions.php';
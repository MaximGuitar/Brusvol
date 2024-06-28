<?php

// ------------------------
// Проекты
// ------------------------

add_action('init', 'project_type_post_register');
function project_type_post_register()
{
    $labels = array(
        'name' => 'Проекты',
        'menu_name' => 'Проекты',
        'singular_name' => 'Проекты',
        'add_new' => 'Добавить проект',
        'add_new_item' => 'Добавить новый проект',
        'edit_item' => 'Редактировать проект',
        'new_item' => 'Новаый проект',
        'all_items' => 'Все проекты',
        'view_item' => 'Посмотреть проект',
        'search_items' => 'Найти проект',
        'not_found' => 'Ничего не найдено'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'menu_icon' => 'dashicons-products',
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'category', 'post-formats', 'custom-fields'),
        'taxonomies' => ['catalog']
    );
    register_post_type('project', $args);
    // Кастомная таксономия 
    register_taxonomy('catalog', ['project'], [
        'label' => '',
        'labels' => [
            'name' => 'Тип проекта',
            'singular_name' => 'Тип проекта',
            'search_items' => 'Search Genres',
            'all_items' => 'Все типы проектов',
            'view_item ' => 'View Genre',
            'parent_item' => 'Родительский тип',
            'parent_item_colon' => 'Родительский тип:',
            'edit_item' => 'Изменить тип',
            'update_item' => 'Изменить тип',
            'add_new_item' => 'Добавить новый тип',
            'new_item_name' => 'New Genre Name',
            'menu_name' => 'Тип проекта',
            'back_to_items' => '← Назад',
        ],
        'description' => '',
        'public' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'capabilities' => array(),
        'meta_box_cb' => null,
        'show_admin_column' => false,
        'show_in_rest' => null,
        'rest_base' => null,
    ]);
    // ACF
    acf_add_options_page(
        array(
            'page_title' => 'Настройка проектов',
            'menu_title' => 'Настройка проектов',
            'menu_slug' => 'settings-project',
            'capability' => 'edit_posts',
            'redirect' => true,
            'parent_slug' => 'edit.php?post_type=project',
        )
    );
    // ACF
    acf_add_options_page(
        array(
            'page_title' => 'Настройка карточек проектов',
            'menu_title' => 'Настройка карточек проектов',
            'menu_slug' => 'settings-project-cards',
            'capability' => 'edit_posts',
            'redirect' => true,
            'parent_slug' => 'edit.php?post_type=project',
        )
    );
    // ACF
    acf_add_options_page(
        array(
            'page_title' => 'Настройка фильтров каталога',
            'menu_title' => 'Настройка фильтров каталога',
            'menu_slug' => 'settings-catalog',
            'capability' => 'edit_posts',
            'redirect' => true,
            'parent_slug' => 'edit.php?post_type=project',
        )
    );
}

// ------------------------
// /Проекты
// ------------------------

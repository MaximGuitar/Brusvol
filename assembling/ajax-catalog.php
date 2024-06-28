<?php
//✞✞✞✞✞✞✞✞✞✞✞✞✞✞✞✞✞КРЕПКОГО ЗДОРОВЬЯ ВСЯК СЮДА ВХОДЯЩЕМУ✞✞✞✞✞✞✞✞✞✞✞✞✞✞✞✞✞✞✞✞

$current_page = $_REQUEST['page'] ?? 1;//определение текущей страницы каталога
$catalogFilters = array();//фильтры 
if ($_REQUEST['filter']) {
    $catalogFilters = $_REQUEST['filter'];
}
$CustomFilters = $_REQUEST['filtersCustom'];
$SortData = explode(',', $_REQUEST['sort']);
$order = $SortData[1];
$metakey = $SortData[0];
$orderby = 'meta_value_num';
// $filters = array(
//     array(
//         'taxonomy' => 'catalog',
//         'field' => 'term_id',
//         'terms' => $catalogFilters,
//         'operator' => 'IN',
//     )
// );
//Сортировка массива по родительской категории
foreach ($catalogFilters as $childID) {
    // Получаем информацию о категории
    $category = get_term($childID, 'catalog');

    // Если категория найдена
    if ($category && !is_wp_error($category)) {
        // Получаем родительскую категорию
        $parentID = $category->parent;

        // Добавляем дочернюю категорию в массив соответствующего родительского термина
        if (!isset($childCategoriesByParent[$parentID])) {
            $childCategoriesByParent[$parentID] = array();
        }
        $childCategoriesByParent[$parentID]["taxonomy"] = 'catalog';
        $childCategoriesByParent[$parentID]["field"] = 'term_id';
        $childCategoriesByParent[$parentID]["operator"] = 'IN';
        $childCategoriesByParent[$parentID]["terms"][] = $childID;
    }
}

// Преобразуем индексы массива в числовые
$filtered = array_values($childCategoriesByParent);


$args = array(
    'post_type' => 'project',
    'meta_key' => $metakey,
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'card-buildingfPrice-podKrishu',
            'value' => array($CustomFilters['MinPrice'], $CustomFilters['MaxPrice']),
            'type' => 'NUMERIC',
            'compare' => 'BETWEEN',
        ),
        array(
            'key' => 'card-place',
            'value' => array($CustomFilters['MinPlace'], $CustomFilters['MaxPlace']),
            'type' => 'NUMERIC',
            'compare' => 'BETWEEN',
        ),
    ),
    'orderby' => $orderby,
    'order' => $order,
    'tax_query' => $filtered,
    'posts_per_page' => 12,
    'paged' => $current_page
);

$projects = new WP_Query($args);
?>

<div class="project-catalog" id="project-catalog" hx-indicator="#indicator">
    <? if (count($projects->posts)): ?>
        <? foreach ($projects->posts as $post): ?>
            <a href="<?= get_permalink($post->ID) ?>" class="catalog-card card main-card">
                <div x-data="catalogSlider" class="catalog-card__swiper-wrapper">
                    <div class="swiper" x-ref="CatalogSwiper">
                        <div class="swiper-wrapper">
                            <?php $gallery = get_field("card-gallery", $post->ID); ?>
                            <?php if ($gallery): ?>
                                <? foreach ($gallery as $photo): ?>
                                    <div class="swiper-slide">
                                        <div class="card img-container">
                                            <img src=" <?= $photo['sizes']['large'] ?>" class="card" alt="<?= $photo['title'] ?>">
                                        </div>
                                    </div>
                                <? endforeach ?>
                            <?php endif; ?>
                        </div>
                        <?php if (count($gallery) > 1): ?>
                            <div class="swiper-pagination" style="grid-template-columns:repeat(<?= count($gallery) ?>,1fr);">
                                <?php for ($i = 1; $i <= count($gallery); $i++): ?>
                                    <div class="swiper-pagination__elem" @mouseenter="SlideTo(<?= $i - 1 ?>)">
                                        <div class="swiper-pagination__dot"></div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        <?php endif; ?>
                        <div class="additional">
                            <?php if (get_field('card-countFloors', $post->ID)): ?>
                                <div class="value">
                                    <?= num_decline(get_field('card-countFloors', $post->ID), 'этаж,этажа,этажей') ?>
                                </div>
                            <?php endif; ?>
                            <?php if (get_field('card-bedrooms-count', $post->ID)): ?>
                                <div class="value">
                                    <?= num_decline(get_field('card-bedrooms-count', $post->ID), 'спальня,спальни,спален') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="additional additional--left additional--top">
                            <?php if (get_field('card-ipoteka-yearPercent', $post->ID)): ?>
                                <div class="value">
                                    <?= 'Ипотека ' . get_field('card-ipoteka-yearPercent', $post->ID) . '%'; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="additional additional--top  additional--green">
                            <?php if (get_field('card-discount', $post->ID)): ?>
                                <div class="value">
                                    <?= 'Скидка ' . get_field('card-discount', $post->ID) . '%'; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="info">
                        <div class="title">
                            <?= $post->post_title ?>
                        </div>

                        <? if (get_field('card-place', $post->ID)): ?>
                            <div class="card-data">
                                <div class="text">Площадь:&nbsp; </div>
                                <div class="value">
                                    <?= get_field('card-place', $post->ID) . " м<sup>2</sup>"; ?>
                                </div>
                            </div>
                        <? endif ?>

                        <? if (get_field('card-size', $post->ID)): ?>
                            <div class="card-data">
                                <div class="text">Размеры:&nbsp; </div>
                                <div class="value">
                                    <? the_field('card-size', $post->ID); ?>
                                </div>
                            </div>
                        <? endif ?>


                        <? if (get_field('card-buildtime', $post->ID)): ?>
                            <div class="card-data">
                                <div class="text">Время на строительство:&nbsp; </div>
                                <div class="value">
                                    <? the_field('card-buildtime', $post->ID); ?>
                                </div>
                            </div>
                        <? endif ?>


                    </div>
                    <div class="btn-price-wrap">
                        <div class="price">
                            <?= 'от ' . number_format(get_field('card-buildingfPrice-podKrishu', $post->ID), 0, '', ' ') . ' ₽'; ?>
                        </div>
                        <div class="btn btn--transparent">
                            Подробнее
                        </div>
                    </div>
                </div>
            </a>
        <? endforeach ?>
        <? if (count($projects->posts) > 5): ?>
            <form hx-target="this" hx-post="/wp-admin/admin-ajax.php?action=sendMail" hx-swap="innerHTML"
                hx-vals='{"formName": "catalogForm"}' class="catalog-form-wrapper">
                <?php get_template_part('/components/forms/catalogForm');  //подключаем поля форму из подвала             ?>
            </form>
        <? endif; ?>
    <? else: ?>
        <p>Ничего не найдено, попробуйте изменить фильтры.</p>
    <? endif; ?>

</div>



<?
$url = $_SERVER['HTTP_HX_CURRENT_URL'] . '?' . $_SERVER['QUERY_STRING'];
$urlParts = parse_url($url);

// Разбор строки запроса
parse_str($urlParts['query'], $queryParams);

// Удаление параметра 'page' из массива параметров запроса
unset($queryParams['page']);

// Построение новой строки запроса без параметра 'page'
$newQueryString = http_build_query($queryParams);

// Формирование нового URL-адреса
$newUrl = $urlParts['scheme'] . '://' . $urlParts['host'] . $urlParts['path'];
if (!empty($newQueryString)) {
    $newUrl .= '?' . $newQueryString;
}
$prev_page_url = ((int) $current_page - 1) > ((int) $projects->max_num_pages) ? 'javascript:void(0);' : $newUrl . '&page=' . ((int) $current_page - 1);
$next_page_url = ((int) $current_page + 1) > ((int) $projects->max_num_pages) ? 'javascript:void(0);' : $newUrl . '&page=' . ((int) $current_page + 1);
?>
<?php if ($projects->max_num_pages > 1): ?>
    <!-- ʕ •ᴥ•ʔ ʕ •ᴥ•ʔ ʕ •ᴥ•ʔ  -->
    <nav class="pagination" x-data="PaginateCheck" @click="PaginateCheck">
        <input type="hidden" x-ref="pageStorage" name="page" value="<?= $_REQUEST['page'] ?? 0 ?>">
        <a href="<?= $prev_page_url ?>" class="arrow-url <?= ((int) $current_page - 1) == 0 ? 'disabled' : ''; ?>">
            <svg class="prev">
                <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#btn-right-arrow'>
                </use>
            </svg>
        </a>

        <?
        echo paginate_links(
            array(
                'base' => $newUrl . '%_%',
                'format' => '&page=%#%',
                'total' => $projects->max_num_pages,
                'current' => $current_page,
                'show_all' => False,
                'end_size' => 1,
                'mid_size' => 1,
                'prev_next' => false,
                'type' => 'plain',
                'add_args' => False,
                'add_fragment' => '',
                'before_page_number' => '',
                'after_page_number' => ''
            )
        ); ?>
        <a href="<?= $next_page_url ?>"
            class="arrow-url <?= ((int) $current_page + 1 > (int) $projects->max_num_pages) ? 'disabled' : ''; ?>">
            <svg class="next">
                <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#btn-right-arrow'>
                </use>
            </svg>
        </a>
    </nav>
<?php endif; ?>
<div class="catalog-seo-urls">
    <?
    $filter_list = (get_catalog_filters_array(get_field('selectFilters', 'options')));
    foreach ($filter_list as $filter): ?>
        <?php if ($filter['children']): ?>
            <div class="catalog-seo-urls__elems">
                <div class="catalog-seo-urls__title">
                    <?= $filter['name'] . ':' ?>
                </div>
                <div class="catalog-seo-urls__list">
                    <? foreach ($filter['children'] as $key => $filterElem): ?>
                        <a href="<?= get_category_link($filterElem["id"]) ?>" class="catalog-seo-urls__url">
                            <?= $filterElem['name'] ?>
                        </a>
                    <? endforeach ?>
                </div>
            </div>
        <?php endif; ?>
    <? endforeach ?>
</div>
<div class="htmx-indicator" id="indicator">
    <img src="/wp-content/themes/assembling/src/images/preloader.svg" alt="">
</div>
<?php
wp_reset_postdata();
wp_die(); ?>
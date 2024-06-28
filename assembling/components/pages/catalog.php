<section class="catalog" id="catalog">
    <div class="container">
        <div class="breadcrumbs">
            <ul itemscope="" itemtype="http://schema.org/BreadcrumbList">
                <?php //bcn_display();      ?>
            </ul>
        </div>

        <div class="types">
            <h1 class="types__title">
                Проекты
            </h1>
            <div class="types__list">
                <?php
                $child_categories = get_terms(
                    array(
                        'taxonomy' => 'catalog', // название вашей кастомной таксономии
                        'hide_empty' => false,   // показывать категории даже если они пусты
                        'parent' => 0,           // только дочерние категории, а не вложенные
                    )
                );
                ?>
                <? foreach ($child_categories as $category): ?>
                    <!-- <a href="<?= get_term_link($category) ?>"><?= $category->name ?></a> -->
                    <? $child_terms = get_term_children($category->term_id, 'catalog'); ?>
                    <? foreach ($child_terms as $termID): ?>
                        <? $term = get_term($termID); ?>
                        <a href="<?= get_term_link($term) ?>" class="types__card">
                            <div class="img-container">
                                <img src="<?= get_field('projecttype-img', "category_" . $termID) ? get_field('projecttype-img', "category_" . $termID) : get_bloginfo('template_url') . "/static/images/defaultIMG.png"; ?>"
                                    alt="">
                            </div>
                            <div class="types__name"><?= $term->name ?></div>
                        </a>
                    <? endforeach ?>
                <? endforeach ?>

                <?php
                $podborki = get_posts(
                    array(
                        'category' => 44,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'include' => array(),
                        'exclude' => array(),
                        'meta_key' => '',
                        'meta_value' => '',
                        'post_type' => 'post',
                        'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                    )
                );
                ?>

                <? foreach ($podborki as $podborka): ?>
                    <a href="<?= get_permalink($podborka->ID) ?>" class="types__card">
                        <div class="img-container">
                            <img src="<?= get_field('podbor_img', $podborka->ID) ? get_field('podbor_img', $podborka->ID) : get_bloginfo('template_url') . "/static/images/defaultIMG.png" ?>"
                                alt="">
                        </div>
                        <div class="types__name"><?= $podborka->post_title ?></div>
                    </a>
                <? endforeach ?>

            </div>
        </div>
    </div>
</section>
<section class="top-section">
    <div class="container">
        <div class="breadcrumbs">
            <?php bcn_display(); ?>
        </div>
        <h1 class="title">
            <?= single_cat_title() ?>
        </h1>
    </div>
</section>
<section class="works-section">
    <div class="container">
        <div class="works" id="works-data">
            <?
            $current_page = !empty ($_GET['page']) ? $_GET['page'] : 1;
            $query = new WP_Query(['category_name' => 'our-works', 'posts_per_page' => 6, "paged" => $current_page]);
            wp_reset_postdata();
            ?>
            <div class="project-catalog works-catalog">
                <? foreach ($query->posts as $post): ?>
                    <a href="<?= get_permalink($post->ID) ?>" class="card catalog-card">
                        <div x-data="catalogSlider" class="catalog-card__swiper-wrapper">
                            <div class="swiper" x-ref="CatalogSwiper">
                                <div class="swiper-wrapper">
                                    <?php $gallery = get_field("card-gallery", $post->ID); ?>
                                    <?php if ($gallery): ?>
                                        <? foreach ($gallery as $photo): ?>
                                            <div class="swiper-slide">
                                                <div class="card img-container">
                                                    <img src=" <?= $photo['sizes']['large'] ?>" class="card"
                                                        alt="<?= $photo['title'] ?>">
                                                </div>
                                            </div>
                                        <? endforeach ?>
                                    <?php endif; ?>
                                </div>
                                <?php if (count($gallery) > 1): ?>
                                    <div class="swiper-pagination"
                                        style="grid-template-columns:repeat(<?= count($gallery) ?>,1fr);">
                                        <?php for ($i = 1; $i <= count($gallery); $i++): ?>
                                            <div class="swiper-pagination__elem" @mouseenter="SlideTo(<?= $i - 1 ?>)">
                                                <div class="swiper-pagination__dot"></div>
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="additional">
                                    <?php if (get_field('card-place', $post->ID)): ?>
                                        <div class="value">
                                            <?= get_field('card-place', $post->ID) . " м2" ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (get_field('card-size', $post->ID)): ?>
                                        <div class="value">
                                            <?= get_field('card-size', $post->ID) ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (get_field('card-floorsNum', $post->ID)): ?>
                                        <div class="value">
                                            <?= get_field('card-floorsNum', $post->ID) . " этаж" ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="info">
                                <div class="title">
                                    <?= $post->post_title ?>
                                </div>
                                <? if (get_field('card-buildingPlace', $post->ID)): ?>
                                    <div class="place">
                                        <? the_field('card-buildingPlace', $post->ID); ?>
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
                                <? if (get_field('card-buildingfPrice', $post->ID)): ?>
                                    <div class="card-data">
                                        <div class="text">Стоимость строительства:&nbsp;</div>
                                        <div class="value">
                                            <?= number_format(get_field('card-buildingfPrice', $post->ID), 0, '', ' ') . "  ₽"; ?>
                                        </div>
                                    </div>
                                <? endif ?>
                            </div>
                            <div class="btn btn--arrow-right btn--transparent">
                                Хочу такой же
                                <svg class="arrow">
                                    <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#pagArrow'>
                                    </use>
                                </svg>
                            </div>
                        </div>
                    </a>
                <? endforeach ?>
            </div>
            <?php if ($query->max_num_pages != 0): ?>
                <nav class="pagination" hx-indicator="#indicator" hx-target="#works-data" hx-select="#works-data"
                    hx-boost="true">

                    <a href="<?= ((int) $current_page - 1) == 0 ? 'javascript:void(0);' : site_url() . '/our-works?page=' . ((int) $current_page - 1); ?>"
                        class="arrow-url <?= ((int) $current_page - 1) == 0 ? 'disabled' : ''; ?>">
                        <svg class="prev">
                            <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#btn-right-arrow'>
                            </use>
                        </svg>
                    </a>

                    <?
                    echo paginate_links(
                        array(
                            'base' => site_url() . '/our-works/' . '%_%',
                            'format' => '?page=%#%',
                            'total' => $query->max_num_pages,
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
                    <a href="<?= ((int) $current_page + 1 > (int) $query->max_num_pages) ? 'javascript:void(0);' : site_url() . '/our-works?page=' . ((int) $current_page + 1); ?>"
                        class="arrow-url <?= ((int) $current_page + 1 > (int) $query->max_num_pages) ? 'disabled' : ''; ?>">
                        <svg class="next">
                            <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#btn-right-arrow'>
                            </use>
                        </svg>
                    </a>
                </nav>
            <?php endif; ?>
            <div class="htmx-indicator" id="indicator">
                <img src="/wp-content/themes/assembling/src/images/preloader.svg" alt="">
            </div>
        </div>
    </div>
</section>
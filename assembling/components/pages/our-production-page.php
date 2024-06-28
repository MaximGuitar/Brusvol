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
<section class="our-production-section">
    <div class="container">
        <div class="our-production" id="production-data">
            <?
            $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
            $query = new WP_Query(['category_name' => 'our-production', 'posts_per_page' => 9, "paged" => $current_page]);
            wp_reset_postdata();
            ?>
            <div class="our-production-catalog" >
                <? foreach ($query->posts as $post): ?>
                    <a href="<?= get_permalink($post->ID) ?>" class="our-production-catalog__elem">

                        <div class="img-container card">
                            <? $img = (get_field('news-image', $post->ID)); ?>
                            <img class="card"
                                src="<?= $img['sizes']['large'] ?? get_bloginfo('template_url') . '/static/default.jpg' ?>"
                                alt="<?= $img['title'] ?>">
                            <div class="btn btn--arrow-right">
                                Подробнее
                                <svg class="arrow">
                                    <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#pagArrow'>
                                    </use>
                                </svg>
                            </div>
                        </div>

                        <div class="title">
                            <?= $post->post_title ?>
                        </div>

                    </a>
                <? endforeach ?>
                <div class="htmx-indicator" id="indicator">
                    <img src="/wp-content/themes/assembling/src/images/preloader.svg" alt="">
                </div>
            </div>
            <?php if ($query->max_num_pages != 0): ?>
                <nav class="pagination" hx-target="#production-data" hx-select="#production-data" hx-boost="true" hx-indicator="#indicator"> 
                    <!-- hx-indicator="#indicator" -->
                    <a href="<?= ((int) $current_page - 1) == 0 ? 'javascript:void(0);' : site_url() . '/our-production?page=' . ((int) $current_page - 1); ?>"
                        class="arrow-url <?= ((int) $current_page - 1) == 0 ? 'disabled' : ''; ?>">
                        <svg class="prev">
                            <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#btn-right-arrow'>
                            </use>
                        </svg>
                    </a>

                    <?
                    echo paginate_links(
                        array(
                            'base' => site_url() . '/our-production/' . '%_%',
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
                    <a href="<?= ((int) $current_page + 1 > (int) $query->max_num_pages) ? 'javascript:void(0);' : site_url() . '/our-production?page=' . ((int) $current_page + 1); ?>"
                        class="arrow-url <?= ((int) $current_page + 1 > (int) $query->max_num_pages) ? 'disabled' : ''; ?>">
                        <svg class="next">
                            <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#btn-right-arrow'>
                            </use>
                        </svg>
                    </a>
                </nav>

            <? endif ?>

        </div>
    </div>
</section>
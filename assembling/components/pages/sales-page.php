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
<section class="sales-section">
    <div class="container">
        <div class="sales" id="sale-data">
            <?
            $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
            $query = new WP_Query(['category_name' => 'sales', 'posts_per_page' => 4, "paged" => $current_page]);
            wp_reset_postdata();
            ?>
            <div class="sales-catalog">
                <? foreach ($query->posts as $post): ?>
                    <div class="card sales-catalog__card">
                        <div class="info">
                            <div class="title">
                                <?= $post->post_title ?>
                            </div>
                            <? if (get_field('sale-text', $post->ID)): ?>
                                <div class="description">
                                    <? the_field('sale-text', $post->ID); ?>
                                </div>
                            <? endif ?>
                        </div>

                        <div class="img-container">
                            <? $img = (get_field('sale-image', $post->ID)); ?>
                            <img src="<?= $img['sizes']['medium'] ?? get_bloginfo('template_url') . '/static/default.jpg' ?>"
                                alt="<?= $img['title'] ?>">
                        </div>
                        <? if (get_field('sale-date', $post->ID)): ?>
                            <div class="notice">
                                <div class="text">
                                    <? the_field('sale-date', $post->ID); ?>
                                </div>
                            </div>
                        <? endif ?>
                    </div>
                <? endforeach ?>
            </div>
            <?php if ($query->max_num_pages != 0): ?>
                <nav class="pagination" hx-indicator="#indicator"  hx-target="#sale-data" hx-select="#sale-data" hx-boost="true">

                    <a href="<?= ((int) $current_page - 1) == 0 ? 'javascript:void(0);' : site_url() . '/sales?page=' . ((int) $current_page - 1); ?>"
                        class="arrow-url <?= ((int) $current_page - 1) == 0 ? 'disabled' : ''; ?>">
                        <svg class="prev">
                            <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#btn-right-arrow'>
                            </use>
                        </svg>
                    </a>

                    <?
                    echo paginate_links(
                        array(
                            'base' => site_url() . '/sales/' . '%_%',
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
                    <a href="<?= ((int) $current_page + 1 > (int) $query->max_num_pages) ? 'javascript:void(0);' : site_url() . '/sales?page=' . ((int) $current_page + 1); ?>"
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
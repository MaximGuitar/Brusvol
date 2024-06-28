<?php if (get_sub_field('news-block-active')): ?>
    <section class="news-block">

        <?php if (get_sub_field('news-block-title')): ?>
            <div class="container">
                <div class="news-block__title">
                    <?= get_sub_field('news-block-title') ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="our-production-section">
            <div class="container">
                <div class="our-production" id="production-data">
                    <?
                    $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
                    $query = new WP_Query(['category_name' => 'our-production', 'posts_per_page' => 3, "paged" => $current_page]);
                    wp_reset_postdata();
                    ?>
                    <div class="our-production-catalog">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
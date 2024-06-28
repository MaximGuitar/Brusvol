<section class="reviews-wrapper" x-data="simpleSlider">
    <div class="container-1920">
        <? if (is_front_page()): ?>
            <img src="<?= get_bloginfo('template_url') ?>/static/images/tree2.png" class="index-decoration tree-9"
                alt="дерево">
            <img src="<?= get_bloginfo('template_url') ?>/static/images/tree1.png" class="index-decoration tree-10"
                alt="дерево">
            <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf-6.png" class="index-decoration leaf-15"
                alt="лист">
            <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf1.png" class="index-decoration leaf-16"
                alt="лист">
        <? endif ?>
        <div class="container">
            <?php if (get_sub_field('reviews_title')): ?>
                <div class="title">
                    <?= get_sub_field('reviews_title') ?>
                </div>
            <?php endif; ?>
            <div class="Swiper reviews" x-ref="swiper">
                <div class="swiper-arrow swiper-arrow--left" x-ref="prev">
                    <svg>
                        <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#swiper-arrow'>
                        </use>
                    </svg>
                </div>
                <div class="swiper-arrow swiper-arrow--right" x-ref="next">
                    <svg>
                        <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#swiper-arrow'>
                        </use>
                    </svg>
                </div>
                <div class="swiper-wrapper">
                    <?php if (have_rows("reviews_elems")): ?>
                        <?php while (have_rows("reviews_elems")):
                            the_row(); ?>
                            <?php if (get_sub_field("reviews_elems_textReview")): ?>
                                <div class="swiper-slide reviews__elem card">
                                    <div class="top-content">
                                        <div class="img-container">
                                            <img src=" <?= get_sub_field("reviews_elems_picture") ?>" alt="">
                                        </div>
                                        <div class="info">
                                            <div class="name">
                                                <?= get_sub_field("reviews_elems_nameSurname") ?>
                                            </div>
                                            <div class="stars">
                                                <?php for ($i = 0; $i < get_sub_field('reviews_elems_countStars'); $i++): ?>
                                                    <svg class="star">
                                                        <use
                                                            xlink:href='/wp-content/themes/assembling/static/images/static-sprite.svg#star'>
                                                        </use>
                                                    </svg>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text">
                                        <?= get_sub_field("reviews_elems_textReview") ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="dotters" x-ref="pag"></div>

            <?php if (get_sub_field('reviews_subtitle')): ?>
                <div class="subtitle">
                    <?= get_sub_field('reviews_subtitle') ?>
                </div>
            <?php endif; ?>
            <?php if (get_sub_field('reviews_url')): ?>
                <a class="btn btn--arrow-right btn--transparent" href=" <?= get_sub_field('reviews_url') ?>">
                    Узнать больше
                    <svg class="arrow">
                        <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#pagArrow'>
                        </use>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php if (get_sub_field('card-additional-posts-active') && get_the_terms(get_the_ID(), 'catalog') && get_the_terms(get_the_ID(), 'catalog')[0]->count > 0): ?>
    <section class="additional-products-wrapper">
        <div class="container">
            <div class="additional-products">
                <div class="additional-products__title">
                    Похожее на то,<br> что вы искали
                </div>
                <div class="products project-catalog">
                    <?
                    $firstCat = get_the_terms(get_the_ID(), 'catalog')[0];
                    $posts = get_posts(
                        array(
                            'numberposts' => 3,
                            'posts_per_page' => 3,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'catalog',
                                    'field' => 'term_id',
                                    'terms' => $firstCat->term_id,
                                ),
                            ),
                            'post_type' => 'project',
                            'exclude' => get_the_ID()
                        )
                    );
                    foreach ($posts as $post): ?>
                        <a href="<?= get_permalink($post->ID) ?>" class="catalog-card card main-card">
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
                                        <?php if (get_field('card-countFloors', $post->ID)): ?>
                                            <div class="value">
                                                <?= 'Ипотека ' . get_field('card-countFloors', $post->ID) . '%'; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="additional additional--top  additional--green">
                                        <?php if (get_field('card-countFloors', $post->ID)): ?>
                                            <div class="value">
                                                <?= 'Скидка ' . get_field('card-countFloors', $post->ID) . '%'; ?>
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
                                    <div class="price">от 5 400 000 ₽</div>
                                    <div class="btn btn--transparent">
                                        Подробнее
                                    </div>
                                </div>
                            </div>
                        </a>
                    <? endforeach ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
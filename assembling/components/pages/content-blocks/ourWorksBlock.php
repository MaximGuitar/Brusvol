<?php
$arrPosts = (get_sub_field('ourworksblock-posts'));
?>
<section class="our-works-block-wrapper" x-data="ourWorksSlider">
    <div class="container-1920">
        <? if (is_front_page()): ?>
            <img src="<?= get_bloginfo('template_url') ?>/static/images/tree1.png" class="index-decoration tree-7"
                alt="дерево">
            <img src="<?= get_bloginfo('template_url') ?>/static/images/tree1.png" class="index-decoration tree-8"
                alt="дерево">
        <? endif ?>
        <div class="container">
            <?php if (get_sub_field('ourWorksBlock-title')): ?>
                <div class="title">
                    <?= get_sub_field('ourWorksBlock-title'); ?>
                </div>
            <?php endif; ?>
            <div class="swiper" x-ref="swiper">
                <div class="swiper-wrapper our-works-block">
                    <? foreach ($arrPosts as $post): ?>
                        <?php $photos = (get_field('card-gallery', $post->ID));
                        $firstPhoto = ($photos[0]['url']) ?>
                        <?php if ($firstPhoto): ?>
                            <a href="<?= get_permalink($post->ID) ?>" class="swiper-slide  card our-works-block__card">
                                <div class="img-container ">
                                    <img src="<?= $firstPhoto ?>" class="card" alt="">
                                    <div class=" card blur">

                                    </div>
                                    <div class="btn btn--arrow-right btn--transparent">
                                        Подробнее
                                        <svg class="arrow">
                                            <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#pagArrow'>
                                            </use>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>
                    <? endforeach ?>
                    <a href="/our-works/" class="card our-works-block__last-card">
                        <div class="text">
                            Недавние работы
                        </div>

                        <div class="btn btn--arrow-right btn--transparent">
                            Все работы
                            <svg class="arrow">
                                <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#pagArrow'>
                                </use>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>

            <div class="dotters" x-ref="pag"></div>
            <a href="/our-works/" class="btn btn--arrow-right btn--transparent btn--mobile">
                Все работы
                <svg class="arrow">
                    <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#pagArrow'>
                    </use>
                </svg>
            </a>
        </div>
    </div>
</section>
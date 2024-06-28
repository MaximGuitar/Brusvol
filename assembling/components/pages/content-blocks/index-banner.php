<section class="index-banner-wrapper">
    <div class="container-1920">
        <? if (is_front_page()): ?>
            <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf1.png" class="index-decoration leaf-1"
                alt="листик">
            <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf2.png" class="index-decoration leaf-2"
                alt="листик">
        <? endif ?>
        <div class="container">
            <div class="index-banner">
                <div class="index-banner__info">
                    <?php if (get_sub_field('banner-title')): ?>
                        <h1 class="title">
                            <?= get_sub_field('banner-title') ?>
                        </h1>
                    <?php endif; ?>
                    <?php if (get_sub_field('banner-description')): ?>
                        <div class="text">
                            <?= get_sub_field('banner-description') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (get_sub_field('banner-btn-text')): ?>
                        <a href="/catalog/houses/" class="btn btn--arrow-right btn--transparent">
                            <?= get_sub_field('banner-btn-text') ?>
                            <svg class="arrow">
                                <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#pagArrow'>
                                </use>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>

                <?php if (get_sub_field('banner-image')): ?>
                    <img src="<?= get_sub_field('banner-image') ?>" alt="" class="bg-img">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
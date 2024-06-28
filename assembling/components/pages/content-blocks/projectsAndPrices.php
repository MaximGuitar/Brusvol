<?php if (have_rows("projectsAndPrices-rubriki")): ?>
    <section class="projectAndPrices-wrapper">
        <div class="container-1920">
            <? if (is_front_page()): ?>
                <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf3.png" class="index-decoration leaf-3"
                    alt="листик">
                <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf4.png" class="index-decoration leaf-4"
                    alt="листик">
                <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf3.png" class="index-decoration leaf-5"
                    alt="листик">
                <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf1.png" class="index-decoration leaf-6"
                    alt="листик">
                <img src="<?= get_bloginfo('template_url') ?>/static/images/tree2.png" class="index-decoration tree-1"
                    alt="дерево">
            <? endif ?>
            <div class="container">
                <h2 class="title"> Проекты и цены</h2>
                <div class="projectAndPrices">
                    <?php while (have_rows("projectsAndPrices-rubriki")):
                        the_row(); ?>
                        <?php $catSlug = get_sub_field('projectsAndPrices-rubriki-rubrika')[0]->slug; ?>
                        <a href="/catalog/<?= $catSlug ?>/" class="projectAndPrices__card card">
                            <div class="img-container card">
                                <img src="<?= get_sub_field('projectsandprices-rubriki-img') ?>" class="card" alt="">
                            </div>
                            <div class="info">
                                <?php if (get_sub_field('projectsAndPrices-rubriki-name')): ?>
                                    <div class="info__title">
                                        <?php the_sub_field("projectsAndPrices-rubriki-name") ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (get_sub_field('projectsAndPrices-rubriki-descr')): ?>
                                    <div class="info__descr">
                                        <?php the_sub_field("projectsAndPrices-rubriki-descr") ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="priceMore">
                                <?php if (get_sub_field('projectsAndPrices-rubriki-price')): ?>
                                    <div class="price">
                                        <?= "от " . number_format(get_sub_field("projectsAndPrices-rubriki-price"), 0, '', ' ') . " ₽"; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (get_sub_field('projectsAndPrices-rubriki-rubrika')): ?>
                                    <div class="btn btn--transparent ">Смотреть все</div>
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php endwhile; ?>

                    <?php if (get_sub_field('projectsAndPrices-last-img')): ?>
                        <a href="/catalog/houses/" class="projectAndPrices__card card lastCard">
                            <div class="img-container card">
                                <img src="<?= get_sub_field('projectsAndPrices-last-img') ?>" class="card" alt="">
                            </div>
                            <div class="info">
                                <?php if (get_sub_field('projectsandprices-last-title')): ?>
                                    <div class="info__title">
                                        <?php the_sub_field("projectsandprices-last-title") ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (get_sub_field('projectsAndPrices-last-descr')): ?>
                                    <div class="info__descr">
                                        <?php the_sub_field("projectsAndPrices-last-descr") ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="btn btn btn--arrow-right btn--transparent">Смотреть все

                                <svg class="arrow">
                                    <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#pagArrow'>
                                    </use>
                                </svg>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
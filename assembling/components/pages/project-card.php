<div class="project-card-wrapper" x-data="{ activeTab:  0 }">
    <? $CurUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
    <div class="container">
        <section class="top-section">
            <div class="container">
                <div class="breadcrumbs">
                    <?php bcn_display(); ?>
                </div>
            </div>
        </section>
        <section class="project-card">
            <div x-data="catalogSlider" class="catalog-card__swiper-wrapper project-card__img">
                <div class="swiper" x-ref="CatalogSwiper">
                    <div class="swiper-wrapper">
                        <?php $gallery = get_field("card-gallery", $post->ID); ?>
                        <?php if ($gallery): ?>
                            <? foreach ($gallery as $photo): ?>
                                <div class="swiper-slide">
                                    <div class="card img-container">
                                        <img src=" <?= $photo['sizes']['large'] ?>" class="card" alt="<?= $photo['title'] ?>">
                                    </div>
                                </div>
                            <? endforeach ?>
                        <?php endif; ?>
                    </div>
                    <?php if (count($gallery) > 1): ?>
                        <div class="swiper-pagination" style="grid-template-columns:repeat(<?= count($gallery) ?>,1fr);">
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
                </div>
            </div>
            <div class="project-card__info-wrapper">
                <div class="card project-card__info">
                    <div class="features">
                        <div class="title">
                            <?= $post->post_title ?>
                        </div>
                        <?php if (have_rows("card-characteristics", $post->ID)): ?>
                            <div class="features-list">
                                <?php while (have_rows("card-characteristics", $post->ID)):
                                    the_row(); ?>
                                    <div class="features-list__elem">
                                        <div class="text">
                                            <?= get_sub_field("card-characteristics-name") ?>
                                        </div>
                                        <div class="dotter"></div>
                                        <div class="value">
                                            <?= get_sub_field("card-characteristics-value") ?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if (get_field('card-complectation', $post->ID)): ?>
                        <div class="cost-complectations">
                            <div class="cost-complectations__title">Стоимость</div>
                            <div class="cost-complectations__list">
                                <?php $complectations = get_field('card-complectation', $post->ID) ?>
                                <? foreach ($complectations as $key => $id): ?>
                                    <?php $el = (get_post($id)) ?>
                                    <div class="cost-complectations__elem">
                                        <div class="name">
                                            <?= $el->post_title ?>
                                        </div>
                                        <div class="price">
                                            <?php if (get_field('card-place', $post->ID)):
                                                $placeHouse = get_field('card-place', $post->ID);
                                                $PricePodCrishu = get_field('cena_za_kv_metr_podkrishu', $el->ID);
                                                $real_price = $placeHouse * $PricePodCrishu ?>
                                                <div class="value">от
                                                    <?= number_format($real_price, 0, '', ' ') . ' ₽'; ?>
                                                </div>
                                            <?php endif; ?>
                                            <div x-data="slowScroll" class="complectation-link"
                                                @click="activeTab = <?= $key ?>;slowScroll('complectations')">Комплектация</div>
                                        </div>
                                    </div>
                                <? endforeach ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="btn-block">
                        <div class="btn btn btn--transparent" onclick="window.cardFormData(event)"
                            data-form-action="Консультация о покупке" data-form-title="Консультация о покупке"
                            data-cur-material="" data-cur-complect="" data-cur-price=""
                            data-current-url="<?= $CurUrl ?>">Хочу такой дом</div>
                        <a target="_blank"
                            href="https://api.whatsapp.com/send?phone=+79119230002&text=Здравствуйте меня интересует этот проект <?= $CurUrl ?>"
                            class="btn btn--transparent btn-call">
                            <svg>
                                <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#whatsapp'>
                                </use>
                            </svg>
                        </a>
                    </div>
                    <div class="additional-options card">
                        <div class="additional-options__elem" onclick="window.cardFormData(event)"
                            data-form-action="Рассчитать ипотеку" data-form-title="Рассчитать ипотеку"
                            data-cur-material="" data-cur-complect="" data-cur-price=""
                            data-current-url="<?= $CurUrl ?>">
                            <div class="img-container icon icon--house">
                                <img src="/wp-content/themes/assembling/static/images/houseIcon.png" alt="">
                            </div>
                            <div class="text">Дом в ипотеку</div>
                        </div>
                        <div class="additional-options__elem" onclick="window.print()">
                            <div class="img-container icon icon--printer">
                                <img src="/wp-content/themes/assembling/static/images/printer.png" alt="">
                            </div>
                            <div class="text">Печать проекта</div>
                        </div>
                        <div class="additional-options__elem" onclick="window.cardFormData(event)"
                            data-form-action="Рассчитать цену дома" data-form-title="Рассчитать цену дома"
                            data-cur-material="" data-cur-complect="" data-cur-price=""
                            data-current-url="<?= $CurUrl ?>">
                            <div class="img-container  icon icon--calc">
                                <img src="/wp-content/themes/assembling/static/images/calc.png" alt="">
                            </div>
                            <div class="text">Рассчитать цену дома</div>
                        </div>
                    </div>
                </div>
                <div class="messengers">
                    <div class="messengers__title">Поделиться ссылкой</div>
                    <div class="messengers-list">
                        <a href="https://vk.com/share.php?url=<?= bloginfo('url') . $_SERVER['REQUEST_URI'] ?>"
                            class="messanger" onclick="copyText('<?= $CurUrl ?>')">
                            <svg>
                                <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#card-vk'>
                                </use>
                            </svg>
                        </a>
                        <a href="https://connect.ok.ru/offer?url=<?= bloginfo('url') . $_SERVER['REQUEST_URI'] ?>"
                            class="messanger">
                            <svg>
                                <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#card-ok'>
                                </use>
                            </svg>
                        </a>
                        <a href="https://telegram.me/share/url?url=<?= bloginfo('url') . $_SERVER['REQUEST_URI'] ?>"
                            class="messanger">
                            <svg>
                                <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#card-tg'>
                                </use>
                            </svg>
                        </a>
                        <div class="messanger" onclick="copyText('<?= $CurUrl ?>')">
                            <svg>
                                <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#card-copyURL'>
                                </use>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="project-card__description">
                <div class="title">
                    Описание проекта
                </div>
                <div class="text">
                    <?= get_field("card-description", $post->ID); ?>
                </div>
            </div>

            <?php if (have_rows("card-layouts", $post->ID)): ?>
                <section class="section-layout">
                    <div class="section-layout__title">Планировки</div>
                    <div class="section-layout-list">
                        <?php while (have_rows("card-layouts", $post->ID)):
                            the_row(); ?>
                            <div class="section-layout-list__elem ">
                                <a href="<?= get_sub_field("card-layouts-photo") ?>" class="img-container card"
                                    data-fancybox="gallery">
                                    <img src="<?= get_sub_field("card-layouts-photo") ?>" class="card" alt="">
                                    <?php if (get_sub_field("card-layouts-floors")): ?>
                                        <div class="floor">
                                            <?= get_sub_field("card-layouts-floors") . ' этаж' ?>
                                        </div>
                                    <?php endif; ?>
                                </a>
                                <div class="place">
                                    <div class="place__title">
                                        Площадь:
                                    </div>
                                    <?php if (get_sub_field("card-layouts-place")): ?>
                                        <div class="place__value">
                                            <?= get_sub_field("card-layouts-place") . 'м
                                            <sup>2</sup>' ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <? endwhile ?>
                    </div>
                </section>
            <?php endif ?>
        </section>

    </div>
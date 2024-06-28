<? if (get_sub_field("gallery-images")): ?>
    <section class="gallery-wrapper content-text">
        <div class="container">
            <div class="gallery">
                <div x-data="catalogSlider" class="catalog-card__swiper-wrapper gallery__slider">
                    <div class="swiper" x-ref="CatalogSwiper">
                        <div class="swiper-wrapper">
                            <?php $gallery = get_sub_field("gallery-images"); ?>
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
                    </div>
                </div>
                <div class="gallery__text">
                    <?= get_sub_field("gallery-text"); ?>
                </div>
            </div>
        </div>
    </section>
<? endif; ?>
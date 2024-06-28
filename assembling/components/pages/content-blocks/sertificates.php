<section class="sertificates-wrapper" x-data="sertificateSlider">
    <div class="container">
        <div class="title">
            Сертификаты
        </div>
        <div class="Swiper sertificates" x-ref="swiper">
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
                <? $gallery = (get_sub_field('sertificates-elems')) ?>
                <?php if ($gallery): ?>
                    <? foreach ($gallery as $photo): ?>
                        <div class="swiper-slide">
                            <a href="<?= $photo['sizes']['large'] ?>" data-fancybox="gallery"
                                class="sertificates__elem img-container card" >
                                <img src="<?= $photo['sizes']['large'] ?>" class="card" alt="<?= $photo['title'] ?>">
                            </a>
                        </div>
                    <? endforeach ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="dotters" x-ref="pag"></div>
    </div>
</section>
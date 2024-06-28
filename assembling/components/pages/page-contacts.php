<section class="top-section">
    <div class="container">
        <div class="breadcrumbs">
            <?php bcn_display(); ?>
        </div>
    </div>
</section>
<section class="contacts-wrapper">
    <div class="container">
        <div class="contacts">
            <h1 class="contacts__title">
                Контакты
            </h1>
            <div class="info">
                <div class="addresses">
                    <div class="adress">
                        <?php if (get_field('full_adress', 'option')): ?>
                            <div class="place">
                                <?php the_field('full_adress', 'option') ?>
                            </div>
                        <?php endif; ?>
                        <?php if (get_field('adress_text', 'option')): ?>
                            <div class="text">
                                <?php the_field('adress_text', 'option') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (get_field('work_time', 'option')): ?>
                    <div class="work-time">
                        <div class="title">График работы:</div>
                        <p>
                            <?php the_field('work_time', 'option') ?>
                        </p>

                    </div>
                <?php endif; ?>
                <div class="icons">
                    <?php if (get_field('viber_url', 'option')): ?>
                        <a href="<?= get_field('viber_url', 'option') ?>" class="icon">
                            <svg>
                                <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#footer-viber'>
                                </use>
                            </svg>
                        </a>
                    <?php endif; ?>
                    <?php if (get_field('whats_up_url', 'option')): ?>
                        <a href="<?= get_field('whats_up_url', 'option') ?>" class="icon">
                            <svg>
                                <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#footer-whatsup'>
                                </use>
                            </svg>
                        </a>
                    <?php endif; ?>
                    <?php if (get_field('telegram_url', 'option')): ?>
                        <a href="<?= get_field('telegram_url', 'option') ?>" class="icon">
                            <svg>
                                <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#footer_telegram'>
                                </use>
                            </svg>
                        </a>
                    <?php endif; ?>
                    <?php if (get_field('vk_url', 'option')): ?>
                        <a href="<?= get_field('vk_url', 'option') ?>" class="icon">
                            <svg>
                                <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#footer-vk'>
                                </use>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="number">
                <?php if (get_field('tel', 'option')): ?>
                    <a href="<?= get_field('tel', 'option') ?>" class="tel">
                        <?php the_field('tel', 'option') ?>
                    </a>
                <?php endif; ?>
                <p class="text">Бесплатная горячая линия</p>
                <?php if (get_field('dop_phone_number', 'option')): ?>
                    <a href="<?= get_field('dop_phone_number', 'option') ?>" class="more-number">
                        <?php the_field('dop_phone_number', 'option') ?>
                    </a>
                <?php endif; ?>
                <?php if (get_field('mail', 'option')): ?>
                    <a href="mailto:<?= get_field('mail', 'option') ?>" class="mail-adr">
                        <svg>
                            <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#email'>
                            </use>
                        </svg>
                        <p>
                            <?php the_field('mail', 'option') ?>
                        </p>
                    </a>
                <?php endif; ?>
            </div>
            <? 
            $input_string = get_field('map', 'option');
            $position_in_map = explode(',', $input_string);
            ?>
            <div class="map card" x-data="contactsMap('<?=$position_in_map[0]?>,<?=$position_in_map[1]?>','15')"></div>
            <!-- <div class="map card" data-marker-height="50" data-marker-width="50"
                data-marker-img="<?//=bloginfo('template_url');   ?>/static/images/pin.svg" id="map">
                <?php
                // $input_string = get_field('map', 'option');
                // $position_in_map = explode(',', $input_string);    ?>
                <div class="markers" data-lat="<?// echo $position_in_map[0];    ?>"
                    data-lng="<?// echo $position_in_map[1];    ?>">
                </div>
            </div> -->
        </div>
    </div>
</section>
<!-- <script type="text/javascript">
    var myMap;
    ymaps.ready(init);
    function init() {
        myMap = new ymaps.Map("map", {
            center: [59.209651, 39.842114],
            zoom: 17
        });
        myMap.behaviors.disable('scrollZoom');
        var myPlacemark = new ymaps.Placemark([59.209651, 39.842114], {}, {
            iconLayout: 'default#image',
            iconImageHref: "/wp-content/themes/template-site/images/pointer.svg",
            iconImageSize: [57, 81],
            iconImageOffset: [-3, -42]
        });
        myMap.geoObjects.add(myPlacemark);
    }
    function select_coords(coord1, coord2) {
        myMap.setCenter([coord1, coord2], 17);
        var myPlacemark = new ymaps.Placemark([coord1, coord2], {}, {
            iconLayout: 'default#image',
            iconImageHref: "/wp-content/themes/template-site/images/pointer.svg",
            iconImageSize: [57, 81],
            iconImageOffset: [-3, -42]
        });
        myMap.geoObjects.add(myPlacemark);
    }

</script> -->
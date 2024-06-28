<? if (get_sub_field('quote')): ?>
    <section class="quote-wrapper">
        <div class="container">
            <div class="quote">
                <div class="quote__sqare quote__sqare--top"></div>
                <div class="quote__sqare quote__sqare--bottom"></div>
                <svg class="quote__apostrov quote__apostrov--top">
                    <use xlink:href='/wp-content/themes/assembling/static/images/static-sprite.svg#apostrov'>
                    </use>
                </svg>
                <svg class="quote__apostrov quote__apostrov--bottom">
                    <use xlink:href='/wp-content/themes/assembling/static/images/static-sprite.svg#apostrov'>
                    </use>
                </svg>
                <p class="quote__text">
                    <?= get_sub_field('quote') ?>
                </p>
            </div>
        </div>
    </section>
<? endif; ?>
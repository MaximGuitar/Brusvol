<?// d($args)//сюда приходят поля в которых ошибка лог мейлера и валидатора                    ?>
<div class="catalog-form">
    <div class="title">
        <?= get_field('catalog-formTitle', 'option'); ?>
    </div>
    <div class="descr text">
        <?= get_field('catalog-formDescr', 'option'); ?>
    </div>
    <div class="input-wrapper">
        <input value="<?= $args['Request']['tel'] ?? '' ?>" x-data="{ phoneNumber: '', isFocused: false }"
            x-mask="+7 (999) 999-99-99" x-bind:placeholder="isFocused ? '+7' : 'Номер'" x-on:blur="isFocused = false"
            type="tel" placeholder="Ваш номер" name="tel"
            class="input tel <?= isset($args['ValidatorErr']['tel']) ? 'fieldErr' : ''; ?>">
        <div class="calendar-wrapper">
            <input x-data="CalendarView" autocomplete="off" value="<?= $args['Request']['CallDate'] ?? '' ?>" x-data
                type="text" placeholder="Когда удобно пообщаться" x-mask="99.99.9999 99:99" id="cardCallbackData"
                name="CallDate" class="input data <?= isset($args['ValidatorErr']['CallDate']) ? 'fieldErr' : ''; ?>">
            <svg>
                <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#calendar'>
                </use>
            </svg>
        </div>
        <button type="submit" hx-indicator="#spinner-cat-form" class="submit_btn btn btn--arrow-right btn--transparent">
            <span class="text ">
                Отправить заявку
            </span>
            <svg class="arrow">
                <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#btn-right-arrow'>
                </use>
            </svg>
            <div class="htmx-indicator htmx-indicator--footerForm text footer-callback__indicator" id="spinner-cat-form">
                <p>Отправляем</p>
                <img src="/wp-content/themes/assembling/src/images/preloader.svg" class="preloader" alt="">
            </div>
        </button>
    </div>

    <div class="catalog-form__policy">
        <span>Нажимая кнопку, Вы соглашаетесь&nbsp;</span><a href="<?= get_page_link(3); ?>">на обработку
            персональных данных</a>
    </div>
</div>
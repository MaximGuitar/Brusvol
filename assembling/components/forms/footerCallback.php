<? //d($args)//сюда приходят поля в которых ошибка лог мейлера и валидатора ?>
<div class="title">Нужна консультация?</div>
<div class="input-wrapper  footer-callback">
    <div class="input-wrapper__item">
        <textarea value="" resize="none" name="taskDescr" placeholder="Описание задачи"
            class="area userTask <?= isset($args['ValidatorErr']['taskDescr']) ? 'fieldErr' : ''; ?>" cols="30"
            rows="10"><?= $args['Request']['taskDescr'] ?? '' ?></textarea>
    </div>
    <input value="<?= $args['Request']['email'] ?? '' ?>" type="text" placeholder="Почта" name="email"
        class="input email <?= isset($args['ValidatorErr']['email']) ? 'fieldErr' : '';//условие проверяет есть ли поле в массиве ошибо?>">
    <button type="submit" hx-indicator="#spinner" class="submit_btn btn btn--arrow-right">
        <span class="text">
            Отправить заявку
        </span>
        <div class="htmx-indicator htmx-indicator--footerForm text footer-callback__indicator" id="spinner">
            <p>Отправляем</p>
            <img src="/wp-content/themes/assembling/src/images/preloader.svg" class="preloader" alt="">
        </div>
        <svg class="arrow">
            <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#btn-right-arrow'>
            </use>
        </svg>
    </button>

</div>
<? if (isset($args['status']) && $args['status']): ?>
    <div class="container">
        <div class="card footer-form__succes-send">Спасибо за оставленную заявку, скоро мы с вами свяжемся!</div>
    </div>
<? else: ?>
    <div class="policy">
    <span>Нажимая кнопку, Вы соглашаетесь&nbsp;</span><a class="url" href="<?= get_page_link(3); ?>">на обработку
                        персональных данных</a>
    </div>
<? endif; ?>
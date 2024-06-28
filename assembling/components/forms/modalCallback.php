<? //d($args)//сюда приходят поля в которых ошибка лог мейлера и валидатора       ?>
<div class="input-wrapper  modalCallback">
    <textarea value="" resize="none" name="taskDescr" placeholder="Описание задачи"
        class="area custom-scrollbar custom-scrollbar--vertical userTask <?= isset ($args['ValidatorErr']['taskDescr']) ? 'fieldErr' : ''; ?>"
        cols="30" rows="10"><?= $args['Request']['taskDescr'] ?? '' ?></textarea>
    <input value="<?= $args['Request']['name'] ?? '' ?>" type="text" placeholder="Имя" name="name"
        class="input name <?= isset ($args['ValidatorErr']['name']) ? 'fieldErr' : '';//условие проверяет есть ли поле в массиве ошибок   ?>">
    <input value="<?= $args['Request']['tel'] ?? '' ?>" type="text" placeholder="Телефон" name="tel"
        x-data="{ phoneNumber: '', isFocused: false }" x-mask="+7 (999) 999-99-99"
        x-bind:placeholder="isFocused ? '+7' : 'Номер'" x-on:blur="isFocused = false" type="tel" placeholder="Номер"
        class="input tel <?= isset ($args['ValidatorErr']['tel']) ? 'fieldErr' : ''; ?>">
    <button type="submit" hx-indicator="#spinner" class="btn btn--arrow-right btn--transparent">
        <span class="text">
            Отправить заявку
        </span>
        <div class="htmx-indicator htmx-indicator--footerForm text modalCallback__indicator" id="spinner">
            <p>Отправляем</p>
            <img src="/wp-content/themes/assembling/src/images/preloader.svg" class="preloader" alt="">
        </div>
        <svg class="arrow">
            <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#btn-right-arrow'>
            </use>
        </svg>
    </button>
    <input type="hidden" name="CurAction" value="" />
    <input type="hidden" name="CurMaterial" value="" />
    <input type="hidden" name="CurComplectation" value="" />
    <input type="hidden" name="CurPrice" value="" />
    <input type="hidden" name="CurUrl" value="" />
    <? if (isset ($args['status']) && $args['status']): ?>
            <div class="card modalCallback__succes-send">Спасибо за оставленную заявку, скоро мы с вами свяжемся!</div>
    <? else: ?>
        <div class="modalCallback__policy">
            <span>Нажимая кнопку, Вы соглашаетесь&nbsp;</span><a href="<?=get_page_link(3);?>">на обработку персональных данных</a>
        </div>
    <? endif ?>
</div>
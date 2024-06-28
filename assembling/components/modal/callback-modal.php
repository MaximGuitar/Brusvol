<div class="modal callbackModal" id="callbackModal" aria-hidden="true">
    <div class="modal__overlay" data-micromodal-close>
        <div class="modal__container">
            <svg class="callbackModal__close" data-micromodal-close>
                <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#cross-menu'
                    data-micromodal-close>
                </use>
            </svg>
            <div class="modal__content">
                <div class="callbackModal__title">Нужна консультация?</div>
                <div class="callbackModal__subtitle">
                    Оставьте заявку на обратную связь.
                    Мы свяжемся с вами в удобное для Вас время.
                </div>
                <form class="callbackModal__form" hx-target="this" hx-post="/wp-admin/admin-ajax.php?action=sendMail"
                    hx-swap="innerHTML" hx-vals='{"formName": "modalCallback"}' class="modal-form">
                    <?php get_template_part('components/forms/modalCallback'); ?>
                </form>
            </div>
        </div>
    </div>
</div>
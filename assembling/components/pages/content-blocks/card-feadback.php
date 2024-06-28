<?php if (get_sub_field('card-feadback-active')): ?>
    <div class="card-feadback-wrapper">
        <div class="container">
            <div class="card-feadback">
                <div class="card-feadback__infoBlock">
                    <?php if (get_sub_field('card-feadback-topText')): ?>
                        <div class="topText">
                            <?= get_sub_field('card-feadback-topText') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (get_sub_field('card-feadback-bottomText')): ?>
                        <div class="bottomText">
                            <?= get_sub_field('card-feadback-bottomText') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (get_sub_field('card-feadback-phoneNumber')): ?>
                        <a href="tel:<?= get_sub_field('card-feadback-phoneNumber') ?>" class="phoneNum">
                            <?= get_sub_field('card-feadback-phoneNumber') ?>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="card-feadback__formBlock">
                    <?php if (get_sub_field('card-feadback-rightText')): ?>
                        <div class="title">
                            <?= get_sub_field('card-feadback-rightText') ?>
                        </div>
                    <?php endif;
                    $current_year = date('Y'); ?>
                    <form hx-target="this" hx-post="/wp-admin/admin-ajax.php?action=sendMail" hx-swap="innerHTML"
                        hx-vals='{"formName": "cardCallback"}' class="card-callback js-form">
                        <?php get_template_part('/components/forms/cardCallback');  //подключаем поля форму из подвала       ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
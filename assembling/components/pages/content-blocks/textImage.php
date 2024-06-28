<? if (get_sub_field('textImage-text')): ?>
    <section class="content-text textImage-wrapper">
        <div class="container">
            <div class="textImage">
                <? if (get_sub_field('textImage-text')): ?>
                    <div class="textImage__text">
                        <?= get_sub_field('textImage-text') ?>
                    </div>
                <? endif; ?>
                <? if (get_sub_field('textImage-image')): ?>
                    <div class="img-container textImage__image card">
                        <img class="card" src="<?= get_sub_field('textImage-image') ?>" alt="">
                    </div>
                <? endif; ?>
            </div>
        </div>
    </section>
<? endif; ?>
<section class="top-section">
    <div class="container">
        <div class="breadcrumbs">
            <?php bcn_display(); ?>
        </div>
        <h1 class="title">
            <?= single_cat_title() ?>
        </h1>
    </div>
</section>
<section class="material-section">
    <div class="container">
        <div class="materials catalog">
            <?
            $items = get_posts(['category' => get_queried_object()->term_id]);

            ?>
            <? if (!empty($items) && is_array($items)): ?>
                <? foreach ($items as $item): ?>
                    <div class="card materials__card">
                        <div class="img-container">
                            <? $img = (get_field('material-image', $item)); ?>
                            <img src="<?= $img['sizes']['medium'] ?? get_bloginfo('template_url') . '/static/default.jpg' ?>"
                                alt="<?= $img['title'] ?>">
                        </div>

                        <div class="info__titles">
                            <div class="title">
                                <?= $item->post_title ?>
                            </div>
                            <?php if (get_field('material-subtitle', $item)): ?>
                                <div class="subtitle">
                                    <?= get_field('material-subtitle', $item) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="info__material">
                            <?php if (get_field('material-price', $item)): ?>
                                <div class="price">
                                    <?= "От " . get_field('material-price', $item) . " ₽/м3" ?>
                                </div>
                            <?php endif; ?>
                            <?php if (get_field('diameter-ot', $item) && get_field('diameter-do')): ?>
                                <div class="diameter">
                                    <?= "Диаметр, мм от " . get_field('diameter-ot') . " до " . get_field('diameter-do') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                <? endforeach ?>
            <?php endif; ?>
        </div>
    </div>
</section>
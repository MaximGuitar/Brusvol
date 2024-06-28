<section class="SEO-block">
    <div class="container-1920">
        <? if (is_front_page()): ?>
            <img src="<?= get_bloginfo('template_url') ?>/static/images/tree1.png" class="index-decoration tree-5"
                alt="дерево">
            <img src="<?= get_bloginfo('template_url') ?>/static/images/tree2.png" class="index-decoration tree-6"
                alt="дерево">
            <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf1.png" class="index-decoration leaf-10"
                alt="листик">
            <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf3.png" class="index-decoration leaf-11"
                alt="листик">
        <? endif; ?>
        <div class="container">
            <div class="SEO-block-wrapper">
                <?php if (get_sub_field('aboutUs-img')): ?>
                    <div class="img-container">
                        <img src="<?= get_sub_field('aboutUs-img') ?>" alt="Сотрудник компании">
                        <div class="person-info">
                            <div class="post">
                                <?= get_sub_field('aboutUs-post') ?>
                            </div>
                            <div class="name">
                                <?= get_sub_field('aboutUs-name-surname') ?>
                            </div>
                        </div>
                    </div>
                <? endif ?>
                <div class="infos">
                    <?php if (get_sub_field('aboutUs-title')): ?>
                        <div class="title">
                            <?= get_sub_field('aboutUs-title') ?>
                        </div>
                    <? endif ?>
                    <?php if (get_sub_field('aboutUs-descr')): ?>
                        <div class="aboutUs-descr">
                            <?= get_sub_field('aboutUs-descr') ?>
                        </div>
                    <? endif ?>
                    <?php if (have_rows("aboutus-numbers")): ?>
                        <div class="numbers">
                            <?php while (have_rows("aboutus-numbers")):
                                the_row(); ?>
                                <div class="number">
                                    <div class="num">
                                        <?= get_sub_field('aboutus-numbers-number') ?>
                                    </div>
                                    <div class="text">
                                        <?= get_sub_field('aboutus-numbers-subtitle') ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <? endif ?>
                </div>
            </div>
        </div>
    </div>
</section>
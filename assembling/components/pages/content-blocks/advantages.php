<?php if (have_rows("advantages")): ?>
    <section class="advantages-wrapper">
        <div class="container-1920">
            <? if (is_front_page()): ?>
                <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf4.png" class="index-decoration leaf-7"
                    alt="листик">
                <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf1.png" class="index-decoration leaf-8"
                    alt="листик">
                <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf3.png" class="index-decoration leaf-9"
                    alt="листик">
                <img src="<?= get_bloginfo('template_url') ?>/static/images/tree2.png" class="index-decoration tree-2"
                    alt="дерево">
                <img src="<?= get_bloginfo('template_url') ?>/static/images/tree1.png" class="index-decoration tree-3"
                    alt="дерево">
                <img src="<?= get_bloginfo('template_url') ?>/static/images/tree2.png" class="index-decoration tree-4"
                    alt="дерево">
            <? endif ?>
            <div class="container">
                <div class="advantages">
                    <?php while (have_rows("advantages")):
                        the_row(); ?>
                        <div class="advantages__elem">
                            <div class="img-container">
                                <img src="<?= get_sub_field("advantages-icon") ?>" alt="">
                            </div>
                            <?php if (get_sub_field("advantages-text")): ?>
                                <div class="text">
                                    <?= get_sub_field("advantages-text") ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
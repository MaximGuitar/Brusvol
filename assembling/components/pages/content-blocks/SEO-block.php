<?
$seo_block_type = get_sub_field("SEO-type");
?>
<section class="seo-block-wrapper seo-block-wrapper--<?= $seo_block_type; ?>">
    <div class="container-1920">
        <?
        if (is_front_page()) {
            switch ($seo_block_type) {
                case 'type2':
                    ?>
                    <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf-5.png" class="index-decoration leaf-12"
                        alt="лист">
                    <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf-6.png" class="index-decoration leaf-13"
                        alt="лист">
                    <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf1.png" class="index-decoration leaf-14"
                        alt="лист">
                    <?
                    break;
                case 'type1':
                    ?>
                    <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf1.png" class="index-decoration leaf-17"
                        alt="лист">
                    <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf-6.png" class="index-decoration leaf-18"
                        alt="лист">
                    <img src="<?= get_bloginfo('template_url') ?>/static/images/leaf-6.png" class="index-decoration leaf-19"
                        alt="лист">
                    <img src="<?= get_bloginfo('template_url') ?>/static/images/tree2.png" class="index-decoration tree-11"
                        alt="дерево">
                    <img src="<?= get_bloginfo('template_url') ?>/static/images/tree1.png" class="index-decoration tree-12"
                        alt="дерево">
                    <?
                    break;
            }
        }
        ?>

        <div class="container">
            <div class="seo-block">
                <?php if (get_sub_field('SEO-title')): ?>
                    <div class="title">
                        <?= get_sub_field('SEO-title') ?>
                    </div>
                <?php endif; ?>
                <?php if (get_sub_field('SEO-image')): ?>
                    <div class="img-container" class="">
                        <img src="<?= get_sub_field('SEO-image') ?>" class="" alt="">
                    </div>
                <?php endif; ?>
                <?php if (get_sub_field('SEO-text')): ?>
                    <div class="text">
                        <?= get_sub_field('SEO-text') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
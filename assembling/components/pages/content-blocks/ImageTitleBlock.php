<?php if (have_rows("ImageTitleBlock-blocks")): ?>
    <section class="ImageTitleBlock-wrapper">
        <div class="container">
            <div class="ImageTitleBlock">
                <div class="ImageTitleBlock__elems">
                    <?php if (have_rows("ImageTitleBlock-blocks")): ?>
                        <?php while (have_rows("ImageTitleBlock-blocks")):
                            the_row(); ?>
                            <div class="ImageTitleBlock__card">
                                <div class="img-container ImageTitleBlock__img card">
                                    <img class="card" src="<?= get_sub_field('ImageTitleBlock-img') ?>" alt="">
                                </div>
                                <div class="ImageTitleBlock__sign">
                                    <?= get_sub_field('ImageTitleBlock-title') ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
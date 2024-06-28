<?php if (have_rows("work-stages-elems")): ?>
    <section class="work-stages-wrapper">
        <div class="container-1920">
            <div class="title">
                Этапы работы
            </div>
            <div class="work-stages" x-data="workSteps">
                <div class="vertical-line">
                    <div class="line" id="ScrollLine" x-ref="verticalLine"></div>
                </div>
                <?php while (have_rows("work-stages-elems")):
                    the_row(); ?>
                    <div class="work-stages__elem" style="<?if(get_row_index()==1){echo 'opacity:1';}?>">
                        <div class="circle">
                            <p>
                                <?= get_row_index(); ?>
                            </p>
                            <svg>
                                <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#ellipse'>
                                </use>
                            </svg>
                        </div>
                        <div class="info">
                            <?php if (get_sub_field("work-stages-title")): ?>
                                <div class="info__title">
                                    <?php the_sub_field("work-stages-title") ?>
                                </div>
                            <?php endif; ?>
                            <?php if (get_sub_field("work-stages-description")): ?>
                                <div class="info__descr text">
                                    <?php the_sub_field("work-stages-description") ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if (get_sub_field("work-stages-image")): ?>
                            <div class="img-container card">
                                <img src="<?= get_sub_field("work-stages-image") ?>" class="card" alt="этап работы">
                            </div>
                        <?php endif; ?>
                    </div>

                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

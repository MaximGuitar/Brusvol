<?php if (get_sub_field('card-complectation-active') && get_field('card-complectation', get_the_ID())): ?>
    <section class="card-complectation" id="complectations">
        <div class="container">
            <div class="title-block">
                <?php if (get_sub_field('card-complectation-title')): ?>
                    <div class="title">
                        <?= get_sub_field('card-complectation-title') ?>
                    </div>
                <?php endif; ?>
                <?php if (get_sub_field('card-complectation-subtitle')): ?>
                    <div class="subtitle">
                        <?= get_sub_field('card-complectation-subtitle') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="complectations">
                <?php $idPosts = (get_field('card-complectation', get_the_ID())); ?>
                <div class="tabs-control">
                    <? foreach ($idPosts as $key => $id): ?>
                        <div class="tabs-control__elem" :class="{ 'active': activeTab === <?= $key ?> }"
                            @click="activeTab = <?= $key ?>">
                            <?= get_post($id)->post_title ?>
                        </div>
                    <? endforeach ?>
                </div>
                <div class="complectations__tabs">
                    <? foreach ($idPosts as $key => $id): ?>
                        <?
                        $placeHouse = get_field('card-place', get_the_ID());
                        $PriceKVmPodCrishu = get_field('cena_za_kv_metr_podkrishu', $id);
                        $PriceKVmPodKluch = get_field('cena_za_kv_metr_pod_cluch', $id);
                        $PricePodCrishu = $placeHouse * $PriceKVmPodCrishu;
                        $PricePodKluch = $placeHouse * $PriceKVmPodKluch;
                        ?>
                        <div class="custom-scrollbar complectations__elem" x-data="tableInclude()" x-ref="tableWrapper"
                            :class="{ 'active': activeTab === <?= $key ?> }" data-KeyPrice="<?= $PricePodKluch ?>"
                            data-RoofPrice="<?= $PricePodCrishu ?>" data-material="<?= get_post($id)->post_title ?>">
                            <?= get_field('equipments_redactor', $id) ?>
                        </div>
                    <? endforeach ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
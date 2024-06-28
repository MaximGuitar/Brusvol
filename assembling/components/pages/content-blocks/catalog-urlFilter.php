<section class="urlFilter-wrapper">
    <div class="container-1920">
        <div class="container">
            <div class="urlFilter">
                <?php if (get_sub_field('catalog-urlFilter-img')): ?>
                    <div class="img-container">
                        <img src="<?= get_sub_field('catalog-urlFilter-img') ?>" alt="">
                    </div>
                <? endif ?>
                <form  x-bind:action="'/catalog/' + termUrl" id="#myForm" class="urlFilter__main" x-data="{ termUrl: '' }">
                    <?php if (get_sub_field('catalog-urlFilter-title')): ?>
                        <div class="main-title">
                            <?= get_sub_field('catalog-urlFilter-title') ?>
                        </div>
                    <? endif ?>
                    <div class="filters">
                        <div class="houseSquare filter">
                            <div class="rangeSlider-wrapper"  x-data="rangeSliderInit(<?=get_sub_field('catalog_urlFilter_MinPlace');?>,<?=get_sub_field('catalog_urlFilter_MaxPlace');?>,1,false,<?= get_field('catalog_urlFilter_MinPlace', 'options'); ?>,<?= get_field('catalog_urlFilter_MaxPlace', 'options'); ?>)">
                                <div class="title">Общая площадь, м2</div>
                                <input type="hidden" name="filtersCustom[MinPlace]" :value="FirstVal">
                                <input type="hidden"  name="filtersCustom[MaxPlace]"  :value="Secondval">
                                <div class="rangeSlider"  x-ref="slider">
                                     <div class="circle circle--right">
                                    <div class="in-circle"></div>
                                    </div> 
                                    <div class="circle circle--left">
                                    <div class="in-circle"></div>
                                    </div>
                                    <div class="numbers">
                                        <div class="num num--left"  x-text="FirstVal+'  м2'"></div>
                                        <div class="num num--right"  x-text="Secondval+'  м2'"></div>
                                    </div> 
                                </div>
                            </div>
                            <div class="rangeSlider-wrapper"  x-data="rangeSliderInit(<?=get_sub_field('catalog_urlFilter_MinPrice');?>,<?=get_sub_field('catalog_urlFilter_MaxPrice');?>,<?=get_sub_field('catalog_urlFilter_NumberStep');?>,false,<?= get_field('catalog_urlFilter_MinPrice', 'options'); ?>,<?= get_field('catalog_urlFilter_MaxPrice', 'options'); ?>)">
                                <div class="title">Стоимость проекта, руб</div>
                                <input type="hidden" name="filtersCustom[MinPrice]" :value="FirstVal">
                                <input type="hidden"  name="filtersCustom[MaxPrice]"  :value="Secondval">
                                <div class="rangeSlider"  x-ref="slider">
                                    <div class="circle circle--right">
                                        <div class="in-circle"></div>
                                    </div> 
                                    <div class="circle circle--left">
                                        <div class="in-circle"></div>
                                    </div> 
                                    <div class="numbers">
                                        <div class="num num--left"  x-text="number_format(FirstVal,0,'',' ')+' ₽'"></div>
                                        <div class="num num--right"  x-text="number_format(Secondval,0,'',' ')+' ₽'"></div>
                                    </div> 
                                </div>
                                    
                            </div>
                        </div>
                        <div class="checkboxList filter houseCategory">
                            <div class="title">Категория дома</div>
                            <?php $houseTypes = get_categories([
                                'taxonomy' => 'catalog',
                                'type' => 'project',
                                'child_of' => 27,
                                'parent' => '',
                                'order' => 'ASC',
                                'hide_empty' => false,
                                'hierarchical' => true,
                            ]);
                            ?>
                            <div class="list">
                                <? foreach ($houseTypes as $key => $type): ?>
                                    <?php  $cat_info = get_term($type->parent, 'catalog');?>
                                    <div class="checkbox-wrapper">
                                        <input name="houseType" value="<?= $type->slug ?>" x-model="termUrl" type="radio"
                                            id="<?= $type->slug . $key ?>" class="customСheckbox"  <?if($key===0)echo "checked";?>>
                                        <label for="<?= $type->slug . $key ?>">
                                            <?= $type->name ?>
                                        </label>
                                    </div>
                                <? endforeach ?>
                            </div>
                        </div>
                        <div class="checkboxList filter houseCountFloors">
                            <?php $CountFloor = get_categories([
                                'taxonomy' => 'catalog',
                                'type' => 'project',
                                'child_of' => 34,
                                'parent' => '',
                                'order' => 'ASC',
                                'hide_empty' => false,
                                'hierarchical' => true,
                            ]);
                            ?>
                            <div class="title">Количество этажей</div>
                            <div class="list">
                       
                                <? foreach ($CountFloor as $key => $floor): ?>
                                    <?php  $cat_info = get_term($floor->parent, 'catalog')?>
                                    <div class="checkbox-wrapper">        
                                        <input  name="filter[<?= $floor -> slug ?>]" value="<?=$floor->term_id ?>"  type="checkbox"
                                            id="<?= $floor->slug . $key ?>" class="customСheckbox">
                                        <label for="<?= $floor->slug . $key ?>">
                                            <?= $floor->name ?>
                                        </label>
                                    </div>
                                <? endforeach ?>
                            </div>
                        </div>
                        <div class="checkboxList filter houseMaterial">
                            <?php $HouseMaterial = get_categories([
                                'taxonomy' => 'catalog',
                                'type' => 'project',
                                'child_of' => 31,
                                'parent' => '',
                                'order' => 'ASC',
                                'hide_empty' => false,
                                'hierarchical' => true,
                            ]);
                            ?>
                            <div class="title">Материалы</div>
                            <div class="list">
                                <? foreach ($HouseMaterial as $key => $type): ?>
                                    <?php  $cat_info = get_term($type->parent, 'catalog');?>
                                    <div class="checkbox-wrapper">
                                        <input  name="filter[<?=$type -> slug ?>]" value="<?=$type->term_id ?>"  type="checkbox"
                                            id="<?= $type->slug . $key ?>" class="customСheckbox">
                                        <label for="<?= $type->slug . $key ?>">
                                            <?= $type->name ?>
                                        </label>
                                    </div>
                                <? endforeach ?>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn--arrow-right btn--transparent" type="submit" id="submitBtn">
                        <?= get_sub_field('catalog-urlFilter-TextBtn') ?>
                        <svg class="arrow">
                            <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#pagArrow'>
                            </use>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
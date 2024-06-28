<section class="catalog_page" x-data="{ openFilter: false,openSort: false }" id="catalog_page">
    <div class="blackBlur" @click="openSort = false; openFilter = false" :class="{'active': openFilter || openSort}">
    </div>
    <div class="container">
        <div class="breadcrumbs">
            <?php bcn_display(); ?>
        </div>
        <?php
        $curFilter = array();
        $filtersCustom = '';
        if (isset($_REQUEST['filter'])) {
            $curFilter = $_REQUEST['filter'];
        }
        array_push($curFilter, get_queried_object()->term_id);
        if (isset($_REQUEST['filtersCustom'])) {
            $filtersCustom = $_REQUEST['filtersCustom'];
        }
        if ($args) {
            $curFilter = $args["filtersPodbor"];
        }
        ?>
        <h1 class="catalog_page__title">
            <? if ($args): ?>
                <?= $args["title"] ?>
            <? else: ?>
                <?= get_queried_object()->name; ?>
            <? endif; ?>
        </h1>
        <div class="mobfilters">
            <div class="mobfilters__elem" :class="{'active':openFilter}"
                @click="openFilter =! openFilter,openSort=false">
                <p>Фильтры</p>
                <svg>
                    <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#filterIcon'>
                    </use>
                </svg>
            </div>
            <div class="mobfilters__elem" :class="{'active':openSort}" @click="openSort =! openSort,openFilter=false">
                <p>Сортировка</p>
                <svg>
                    <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#SortIcon'>
                    </use>
                </svg>
            </div>
        </div>
        <? if ($args): ?>
            <div class="catalog_page__seo-text">
                <?= $args['SEOtext'] ?>
            </div>
        <? endif; ?>
        <form class="main-catalog" id="main-catalog" action="/wp-admin/admin-ajax.php" hx-target="#catalog-wrapper"
            hx-trigger="pag,change from:.changeEvent,load" method="get" hx-get="/wp-admin/admin-ajax.php">
            <input type="hidden" name="currentTax" value="<?= get_queried_object()->term_id ?>">
            <? if (!empty($_REQUEST['page'])): ?>
                <input type="hidden" name="page" value="<?= $_REQUEST['page'] ?>">
            <? endif; ?>
            <div class="filters" :class="{'active':openFilter}">
                <div class="filters__title">
                    Фильтры
                    <svg class="close-cross" @click="openFilter =! openFilter">
                        <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#closeCross'>
                        </use>
                    </svg>
                </div>
                <div class="filters__wrapper">
                    <input type="hidden" value="catalog_ajax" name="action">
                    <div class="filters__term">
                        <?
                        $filter_list = (get_catalog_filters_array(get_field('selectFilters', 'options'))); ?>
                        <? foreach ($filter_list as $filter): ?>
                            <?php if ($filter['children']): ?>
                                <div class="filter">
                                    <div class="title">
                                        <?= $filter['name'] ?>
                                    </div>
                                    <div class="filter__list">
                                        <? foreach ($filter['children'] as $key => $filterElem): ?>
                                            <div class="checkbox-wrapper">
                                                <input name="filter[<?= $key ?>]" value="<?= $filterElem['id'] ?>" type="checkbox"
                                                    id="<?= $filterElem['id'] ?>" class="customСheckbox changeEvent" <? if (in_array($filterElem['id'], $curFilter)) {
                                                          echo 'checked';
                                                      } ?>>
                                                <label for="<?= $filterElem['id'] ?>">
                                                    <?= $filterElem['name'] ?>
                                                </label>
                                            </div>
                                        <? endforeach ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <? endforeach ?>
                    </div>
                    <div class="filters__custom">
                        <div class="rangeSlider-wrapper"
                            x-data="rangeSliderInit(<?= get_field('catalog_urlFilter_MinPlace', 'options') ?>,<?= get_field('catalog_urlFilter_MaxPlace', 'options'); ?>,1,true,<?= $filtersCustom['MinPlace'] ?? get_field('catalog_urlFilter_MinPlace', 'options') ?>,<?= $filtersCustom['MaxPlace'] ?? get_field('catalog_urlFilter_MaxPlace', 'options'); ?>)">
                            <div class="title">Общая площадь, м2</div>
                            <input type="hidden" name="filtersCustom[MinPlace]" :value="FirstVal">
                            <input type="hidden" name="filtersCustom[MaxPlace]" :value="Secondval">
                            <div class="rangeSlider" x-ref="slider">
                                <div class="circle circle--right">
                                    <div class="in-circle"></div>
                                </div>
                                <div class="circle circle--left">
                                    <div class="in-circle"></div>
                                </div>
                                <div class="numbers">
                                    <div class="num num--left" x-text="FirstVal+'  м2'"></div>
                                    <div class="num num--right" x-text="Secondval+'  м2'"></div>
                                </div>
                            </div>
                        </div>
                        <div class="rangeSlider-wrapper"
                            x-data="rangeSliderInit(<?= get_field('catalog_urlFilter_MinPrice', 'options'); ?>,<?= get_field('catalog_urlFilter_MaxPrice', 'options'); ?>,<?= get_field('catalog_urlFilter_NumberStep', 'options'); ?>,true,<?= $filtersCustom['MinPrice'] ?? get_field('catalog_urlFilter_MinPrice', 'options'); ?>,<?= $filtersCustom['MaxPrice'] ?? get_field('catalog_urlFilter_MaxPrice', 'options'); ?>)">
                            <div class="title">Стоимость проекта, руб</div>
                            <input type="hidden" name="filtersCustom[MinPrice]" :value="FirstVal">
                            <input type="hidden" name="filtersCustom[MaxPrice]" :value="Secondval">
                            <div class="rangeSlider" x-ref="slider">
                                <div class="circle circle--right">
                                    <div class="in-circle"></div>
                                </div>
                                <div class="circle circle--left">
                                    <div class="in-circle"></div>
                                </div>
                                <div class="numbers">
                                    <div class="num num--left" x-text="number_format(FirstVal,0,'',' ')+' ₽'"></div>
                                    <div class="num num--right" x-text="number_format(Secondval,0,'',' ')+' ₽'"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div @click="openFilter =! openFilter" class="btn  btn--transparent filters__btn">
                    Применить
                </div>
            </div>
            <div class="catalog-sort-wrapper">
                <div class="sort" :class="{'active':openSort}">

                    <div class="sort__title">
                        Сортировка:
                        <svg class="close-cross" @click="openSort =! openSort">
                            <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#closeCross'>
                            </use>
                        </svg>
                    </div>
                    <div class="sort-wrapper">
                        <div class="sort__items">
                            <div class="items-title">
                                Стоимость
                            </div>

                            <div class="radioWrapper">
                                <input id="priceSmall" type="radio" class="customRadio changeEvent"
                                    value="card-buildingfPrice-podKrishu,ASC" name="sort" checked>
                                <svg class="radioWrapper__arrow ">
                                    <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#smallAroow'>
                                    </use>
                                </svg>

                                <label for="priceSmall">Дешевле</label>
                            </div>
                            <div class="radioWrapper ">
                                <input id="priceBig" class="customRadio changeEvent" type="radio"
                                    value="card-buildingfPrice-podKrishu,DESC" name="sort">
                                <svg class="radioWrapper__arrow radioWrapper__arrow--top">
                                    <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#smallAroow'>
                                    </use>
                                </svg>

                                <label for="priceBig">Дороже</label>
                            </div>
                        </div>
                        <div class="sort__items">
                            <div class="items-title">
                                Размеры
                            </div>
                            <div class="radioWrapper ">
                                <svg class="radioWrapper__arrow ">
                                    <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#smallAroow'>
                                    </use>
                                </svg>
                                <input id="placeSmall" class="customRadio changeEvent" type="radio"
                                    value="card-place,ASC" name="sort">
                                <label for="placeSmall">Сначала небольшие дома</label>
                            </div>
                            <div class="radioWrapper">
                                <svg class="radioWrapper__arrow radioWrapper__arrow--top">
                                    <use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#smallAroow'>
                                    </use>
                                </svg>
                                <input id="placeBig" class="customRadio changeEvent" type="radio"
                                    value="card-place,DESC" name="sort">
                                <label for="placeBig">Сначала большие дома</label>
                            </div>
                        </div>
                        <div class="sort__items">
                            <div class="items-title">
                                Стоимость
                            </div>
                            <div class="radioWrapper ">
                                <input id="discount" class="customRadio changeEvent" type="radio"
                                    value="card-discount,DESC" name="sort">
                                <label for="discount"> Действует скидка</label>
                            </div>
                        </div>
                    </div>

                    <div @click="openSort =! openSort" class="btn  btn--transparent sort__btn">
                        Применить
                    </div>
                </div>

                <div class="project-catalog-wrapper" id="catalog-wrapper">
                </div>
            </div>

        </form>
    </div>
</section>
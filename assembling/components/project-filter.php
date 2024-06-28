<!-- <?php
// $filter_array = $args['filter_array'];
// $dop_pole = isset($args['dop_pole']) ? $args['dop_pole'] : '';
// $filters = $_REQUEST['filters'];
//if ($dop_pole !== ''): ?>
    <div class="catalog__filter__container">
        <?// foreach ($dop_pole as $key => $value): ?>
            <h3 class="catalog__filter__name">
                <?//= $value['title']; ?>
            </h3>
            <div class="theme-select theme-select--gray js-select-field">
                <div class="theme-select__value js-change-field-trigger" tabindex="2">
                    <input class="js-select-field-value" name="" type="text" readonly="" value="">
                    <span class="js-select-field-status">Проекты</span>
                    <svg>
                        <use xlink:href="<?//= get_bloginfo('template_url'); ?>/static/images/sprite.svg#arrow"></use>
                    </svg>
                </div>
                <div class="theme-select__list js-select-field-list" style="height: 0px;">
                    <div class="theme-select__list__wrapper">
                        <?// foreach ($value['values'] as $dop): ?>
                            <p data-value=""><a href="<?//= $dop['href']; ?>"><span>
                                        <?//= $dop['title']; ?>
                                    </span></a></p>
                        <? //endforeach; ?>
                    </div>
                </div>
            </div>
        <?/// endforeach; ?>
    </div>
<?// endif;
//d($filter_array);
//foreach ($filter_array as $key => $term):
   // if (empty($term['sub_terms']))
    //    continue; ?>
    <div class="catalog__filter__container">
        <h3 class="catalog__filter__name">
            <?//= $term['name']; ?>
        </h3>
        <?php //d((get_term_meta($term['term_id'], 'project_select_filter', true))) ?>
        <? //if (get_term_meta($term['term_id'], 'project_select_filter', true) !== '1'):
           //$checked = array(); ?>
            <div class="catalog__filter__items">
            Если мы на странице
                <? //if (!empty($term['slug_parent_page'])):
                //     foreach ($term['sub_terms'] as $key => $sub_term):
                //         $checked[$sub_term['slug']] = ($term['slug_parent_page'] == $sub_term['slug']) ? 'checked' : '';
                //     endforeach;
                // endif;
                // Если перешли по ссылке с активными фильтрами
                // if (isset($filters)):
                //     d($filters);
                //     foreach ($filters as $filter):
                //         foreach ($term['sub_terms'] as $key => $sub_term):
                //             d($sub_term['slug']);
                //             d($filter);
                            
                //             if (array_search($sub_term['slug'], $filter) !== false)
                //                 $checked[$sub_term['slug']] = 'checked';
                //         endforeach;
                //     endforeach;
                // endif;
                // Вывод фильтров
                // foreach ($term['sub_terms'] as $key => $sub_term): ?>
                    <div class="item_project_checkbox">
                        <input <?//= isset($checked[$sub_term['slug']]) && $checked[$sub_term['slug']] === 'checked' ? 'checked' : '' ?>
                            name="filters[<//?= $term['slug']; ?>][]" value="<?//= $sub_term['slug']; ?>" type="checkbox"
                            id="<?//= $sub_term['slug']; ?>">
                        <label //for="<?//= $sub_term['slug']; ?>">
                            <?//= $sub_term['name']; ?>
                        </label>
                    </div>
                <? //endforeach; ?>
            </div>
        <?// endif; ?>
    </div>
<? //endforeach; ?> -->





<!-- 
<div class="theme-select theme-select--gray js-select-field">
                <div class="theme-select__value js-change-field-trigger" tabindex="2"> -->
                    <?php
                    // $check_active_value = '';
                    // $check_active_name = 'Все';
                    // foreach ($sub_terms as $sub_term) {
                    //     if ($slug_page){
                    //         if ($slug_page === $sub_term->slug){
                    //             $check_active_value = $sub_term->slug;
                    //             $check_active_name = $sub_term->name;
                    //         }
                    //     }
                    //     if ($_REQUEST['filters']) {
                    //         foreach ($_REQUEST['filters'] as $filter) {
                    //             if ($filter === $sub_term->slug){
                    //                 $check_active_value = $sub_term->slug;
                    //                 $check_active_name = $sub_term->name;
                    //             }
                    //         }
                    //     }
                    // }
                    ?>
                    <!-- <input class="js-select-field-value" name="filters[<? //= $term->slug; ?>][]" type="text" readonly="" value="<? //=$check_active_value;?>">
                    <span class="js-select-field-status"><? //=$check_active_name; ?></span>
                    <svg><use xlink:href="<? //=bloginfo('template_url');?>/static/images/sprite.svg#arrow"></use></svg>
                </div>
                <div class="theme-select__list js-select-field-list" style="height: 0px;">
                    <div class="theme-select__list__wrapper">-->
                        <?php 
                        // $active = '';
                        // $active = (!$slug_page && !$_REQUEST['filters']) ? 'active' : '';
                        // echo '<p data-value="" class="' . $active . '"><span>Все</span></p>';
                        // foreach ($sub_terms as $sub_term):
                        //     $checked = '';
                        //     if ($slug_page)
                        //         $checked = ($slug_page === $sub_term->slug) ? 'active' : '';
                        //     if ($_REQUEST['filters']) {
                        //         foreach ($_REQUEST['filters'] as $filter) {
                        //             if ($checked == '')
                        //                 $checked = ($filter === $sub_term->slug) ? 'active' : '';
                        //         }
                        //     }                              
                        //     echo '<p data-value="' . ($sub_term->slug) . '" class="' . ($checked) . '"><span>' . ($sub_term->name) . '</span></p>';
                        // endforeach;
                        ?>
                    <!-- </div>
                </div>
            </div> -->
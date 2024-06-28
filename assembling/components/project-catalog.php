<!-- <div class="catalog__container" id="project_container" x-data>
    <?php
    // $this_terms = $args['this_term'] ? $args['this_term'] : '';
    // $this_terms = '';
    ?>
    <button class="btn_mob btn btn--green btn_filter" @click="$store.filterVisible.folter_open()">Фильтры</button>
    <form class="catalog__filter" id="project_filter" data-term_category="<?//= $this_terms; ?>" method="POST"
        action="/wp-admin/admin-ajax.php">

        <input style="display: none;" type="text" name="ordering" id="ordering_input" value="">
        <input style="display: none;" type="text" name="filters[][]" value="<?//= $this_terms; ?>">
        <?php
        // $tax = array(
        //     'taxonomy' => 'catalog',
        //     'parent' => 0,
        //     'hide_empty' => false,
        // );
        // $terms = get_terms($tax);
        // $dop_pole = array();
        // foreach (wp_get_menu_array('header_menu') as $key => $value) {
        //     if ($value['id'] === 350) {
        //         $dop_pole[$value['id']] = array(
        //             'title' => $value['title'],
        //             'values' => array()
        //         );
        //         foreach ($value['children'] as $key => $value_children) {
        //             $dop_pole[$value['id']]['values'][$value_children['id']] = array(
        //                 'id' => $value_children['id'],
        //                 'title' => $value_children['title'],
        //                 'href' => $value_children['href']
        //             );
        //         }
        //     }
        // }
        // get_template_part('components/project-filter', null, [
        //     'filter_array' => get_filters_array($terms, $this_terms, 'materyal'),
        //     'dop_pole' => $dop_pole
        // ]);
        ?>
        <div class="catalog__filter__reset_container">
            <a href="<?//= parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); ?>">Сбросить фильтры</a>
        </div>
    </form>
    <div class="catalog__project">
      <form id="project_order" method="POST" action="/wp-admin/admin-ajax.php">
            <div class="theme-select theme-select--white js-select-field catalog__sort">
                <div class="theme-select__value js-change-field-trigger" tabindex="2">
                    <input class="js-select-field-value" name="ordering" type="text" readonly="" value="">                 
                </div>
            </div>
        </form> -->
        <!-- <div class="catalog__loader">
            <div class="catalog__item_container"> -->
                <?php
                // $posts_per_page = get_field('count_visible_project', 'option');
                // $project = array(
                //     'post_type' => 'project',
                //     'orderby' => 'date',
                //     'order' => 'ASC',
                //     'posts_per_page' => $posts_per_page,
                // );
                // $custom_query = new WP_Query($project);
                // foreach ($custom_query->posts as $post):
                //     get_template_part('components/project-card', null, [
                //         'post' => $post,
                //     ]);
                // endforeach;
                ?>
            <!-- </div>
            <img src="<?//= get_bloginfo('template_url'); ?>/src/images/loader_green.svg" alt="loader">
        </div> -->
        <?php
        // get_template_part('components/project_filters_bottom', null, [
        //     'href_array' => get_filters_array($terms, $this_terms, 'materyal')
        // ]);
        ?>
    <!-- </div>
</div> -->
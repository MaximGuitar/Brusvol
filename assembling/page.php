<?php

get_header();

if (is_page(138)): get_template_part('components/pages/page-contacts');
elseif (is_page(3)): get_template_part('components/pages/politica');
elseif (is_page(144)): get_template_part('components/pages/obrabotka');
elseif (is_page(426)): get_template_part('components/pages/page-aboutUs');
elseif (is_page(317)): get_template_part('components/pages/catalog');
else: get_template_part('components/pages/text'); // Текстовая страница
endif;

if (is_home()) {
    new Content('option');
} else {
    new Content(get_queried_object()->ID);
}

get_footer();

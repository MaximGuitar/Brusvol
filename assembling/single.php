<?php get_header();
$current_post_ID = get_the_category(get_queried_object()->ID);
// $parent_category_ID = (end($current_post_ID))->term_id;
if (CheckParentCategory(41) || get_queried_object()->post_type === 'project') {
    get_template_part('components/pages/project-card');
} elseif (CheckParentCategory(44)) {
    get_template_part('components/pages/podborka');
} else {
    get_template_part('components/pages/text');
}
// elseif (CheckParentCategory(34)): get_template_part('components/pages/services-card');
// elseif (CheckParentCategory(27)): get_template_part('components/pages/specialists-card');
// else:
//     get_template_part('components/pages/text'); // Текстовая страница

if (get_queried_object()->post_type === 'project' || CheckParentCategory(41)) {
    new Content('option', 'content-project-card');
} else {
    new Content();
}

?>
<div>
    <?php get_footer(); ?>
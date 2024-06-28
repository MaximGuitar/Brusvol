<?
$PostID = get_queried_object()->ID;
$filters = get_field('filter_post_cat', $PostID);
$SortFiltered = array();
foreach ($filters as $filter) {
    $SortFiltered[$filter->slug] = $filter->term_id;
}
$title = get_queried_object()->post_title;
$SEOtext = get_field('post_cat_text', $PostID);

$args = [
    "ID" => $PostID,
    "title" => $title,
    "filtersPodbor" => $SortFiltered,
    "SEOtext" => $SEOtext,
];
get_template_part('main-catalog', null, $args);
?>
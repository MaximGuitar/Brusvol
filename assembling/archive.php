<?php get_header();
if (isset(get_queried_object()->parent)) {
	$parentID = get_queried_object()->parent;
}

if (is_category(10)):
	get_template_part('components/pages/material-page');
elseif (is_category(11)):
	get_template_part('components/pages/sales-page');
elseif (is_category(13)):
	get_template_part('components/pages/our-production-page');
elseif (is_category(41)):
	get_template_part('components/pages/ourWorks');
elseif (get_queried_object()->name == "project"):
	get_template_part('components/pages/catalog');
	// elseif (is_category(34)):
// 	get_template_part('components/pages/main-services');
endif;
?>
<?php if (is_category(1)): ?>
	<section class="page page-news text-page">
		<div class="container">
			<div class="breadcrumbs">
				<ul itemscope="" itemtype="http://schema.org/BreadcrumbList">
					<?php bcn_display(); ?>
				</ul>
			</div>

			<h1 class="page-title">
				<?php echo get_cat_name(get_queried_object_id()); ?>
			</h1>

			<div class="text-page__wrap">
				<div class="text-page__left">
					<div class="page-news__wrap">
						<?php
						$page = $_GET['page'] ? $_GET['page'] : 1;
						$news_query = new WP_Query([
							'post_type' => 'post',
							'cat' => 1,
							'paged' => $page
						]);


						while ($news_query->have_posts()) {
							$news_query->the_post();
							$img = get_the_post_thumbnail_url();
							$title = get_the_title();
							$date = get_the_time('d.m.y');
							$link = get_permalink();
							echo '
										<a href="' . $link . '" class="news-card">
											<div class="news-card__img-wrap">
												<img src="' . $img . '" alt="new thumbnail" class="news-card__img">
											</div>
											<div class="news-card__wrap">
												<p class="news-card__date">' . $date . '</p>
												<p class="news-card__title">' . $title . '</p>
											</div>
										</a>
									';
						}
						?>
					</div>

					<div class="pagination-wrap">
						<?php if (function_exists('wp_corenavi'))
							wp_corenavi(); ?>
					</div>
				</div>
				<div class="text-page__right">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</section>
<?php else: ?>
<?php endif; ?>
<?php
if (isset(get_queried_object()->term_id)) {
	$option = 'category_' . get_queried_object()->term_id;
	new Content($option); //передаём параметры для вывода группы полей (ID) 
}
?>
<?php get_footer(); ?>
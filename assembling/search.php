<?php get_header(); ?>

<section class="page page-search">
	<div class="container">
		<div class="breadcrumbs clearfix">
			<li><span><a href="/">Главная</a></span></li>
			<p>—</p>
			<span>Поиск</span>
		</div>
		<form method="get" action="/" class="page-search__form">
			<input type="text" class="input page-search__input" placeholder="Поиск"
				value="<?php echo get_search_query(); ?>" name="s" />
			<button type="submit" class="page-search__icon">
				<svg>
					<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#search-icon'>
					</use>
				</svg>
			</button>
		</form>
		<div class="search-result">
			<?php if (have_posts() && get_search_query()): ?>
				<? while (have_posts()):
					the_post(); ?>
					<div class="search-result__item">
						<a href="<?= get_permalink() ?>" class="search-result__title">
							<?= get_the_title() ?>
						</a>
						<div class="search-result__descr">
							<?= mb_substr(strip_tags(get_field('card-description')), 0, 200) . '...';?>
						</div>
					</div>
				<? endwhile ?>
			<?php else: ?>
				<div class="no-results">
					<p>
						Ничего не найдено
					</p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
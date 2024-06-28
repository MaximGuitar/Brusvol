<?php get_header(); ?>

<section class="page-404">
	<div class="container">
		<div class="page-404-wrap">
			<div class="info">
				<div class="title"> Ошибка 404</div>
				<div class="subtitle">Не можем найти страницу</div>
				<a href="/projects/" class="btn btn--arrow-right">
					В каталог
					<svg class="arrow">
						<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#pagArrow'>
						</use>
					</svg>
				</a>

			</div>
			<div class="img-container">
				<img src="/wp-content/themes/assembling/static/images/404.png" alt="404">
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
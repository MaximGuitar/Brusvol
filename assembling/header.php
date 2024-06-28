<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php the_field('header_script', 'option'); ?>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
	<link rel="stylesheet" href="/wp-content/themes/assembling/static/css/swiper-bundle.min.css" type="text/css"
		media="screen" />
	<link rel="stylesheet" href="/wp-content/themes/assembling/static/css/nouislider.min.css">
	<script src="https://cdn.jsdelivr.net/npm/micromodal/dist/micromodal.min.js"></script>
	<script src="<?= get_bloginfo('template_url'); ?>/src/js/vendors/alpinejs.js" defer></script>
	<script src="<?= get_bloginfo('template_url'); ?>/src/js/vendors/htmx.min.js"></script>
	<script src="<?= get_bloginfo('template_url'); ?>/src/js/vendors/nouislider.min.js"></script>
	<link rel="icon" href="<?= get_bloginfo('template_url'); ?>/static/images/favicon.svg">
	<?php wp_head(); ?>
	<title>
		<?php wp_title(); ?>
	</title>
</head>

<body :class="{'active':openMobMenu}">
	<header class="header container">
		<svg class="chat">
			<use xlink:href='/wp-content/themes/assembling/static/images/static-sprite.svg#chat'>
			</use>
		</svg>
		<div class="header-top">
			<a href="/" class="logo">
				<svg>
					<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#main-logo'>
					</use>
				</svg>
			</a>
			<div class="info">
				<?php if (get_field('address', 'option')): ?>
					<a href="<?= get_field('adress_url', 'option') ?>" class="adress">
						<?php the_field('address', 'option') ?>
					</a>
				<?php endif; ?>
				<div class="contacts">
					<a class="tel" href="tel:<?= get_field('tel', 'option') ?>">
						<?php the_field('tel', 'option') ?>
					</a>
					<div class="icons">
						<?php if (get_field('telegram_url', 'option')): ?>
							<a href="<?= get_field('telegram_url', 'option') ?>" target="_blank" class="icons__elem">
								<svg>
									<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#telegram'>
									</use>
								</svg>
							</a>
						<?php endif; ?>
						<?php if (get_field('whats_up_url', 'option')): ?>
							<a href="<?= get_field('whats_up_url', 'option') ?>" target="_blank" class="icons__elem">
								<svg>
									<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#whatsup'>
									</use>
								</svg>
							</a>
						<?php endif; ?>
						<?php if (get_field('viber_url', 'option')): ?>
							<a href="<?= get_field('viber_url', 'option') ?>" target="_blank" class="icons__elem">
								<svg>
									<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#viber'>
									</use>
								</svg>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="btn btn--transparent" onclick="window.cardFormData(event)" data-form-action="Обратный звонок"
				data-form-title="Консультация о покупке" data-cur-material="" data-cur-complect="" data-cur-price="">
				Заказать звонок
			</div>
		</div>
	</header>

	<header class="header container sticky" x-data="{ openSearch: false }">
		<div class="header-bottom">
			<ul class="header-menu">
				<?php $menuArr = (wp_get_nav_menu_items('header_menu')); ?>
				<? foreach ($menuArr as $elem): ?>
					<li class="header-menu__item">
						<a href="<?= $elem->url ?>">
							<?= $elem->post_title ?>
						</a>
					</li>
				<? endforeach ?>
			</ul>
			<div class="search" @click="openSearch = ! openSearch">
				<svg>
					<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#search-icon'>
					</use>
				</svg>
			</div>
		</div>
		<form class="desc-search-wrapper" :class="{'active':openSearch}" method="get" action="/">
			<input type="text" placeholder="Поиск" name="s" class="search-main">
			<button class="icon">
				<svg class="">
					<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#search-icon'>
					</use>
				</svg>
			</button>
		</form>
	</header>

	<header x-data="{ openMobMenu: false }" class="sticky header-mobile-wrapper" :class="{'active':openMobMenu}">
		<div class="header-mobile" :class="{'active':openMobMenu}">
			<div class="container">
				<a href="/" class="logo">
					<svg>
						<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#main-logo'>
						</use>
					</svg>
				</a>
				<div class="info">
					<div class="contacts">
						<a class="tel" href="tel:<?= get_field('tel', 'option') ?>">
							<?php the_field('tel', 'option') ?>
						</a>
						<div class="icons">
							<?php if (get_field('telegram_url', 'option')): ?>
								<a href="<?= get_field('telegram_url', 'option') ?>" target="_blank" class="icons__elem">
									<svg>
										<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#telegram'>
										</use>
									</svg>
								</a>
							<?php endif; ?>
							<?php if (get_field('whats_up_url', 'option')): ?>
								<a href="<?= get_field('whats_up_url', 'option') ?>" target="_blank" class="icons__elem">
									<svg>
										<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#whatsup'>
										</use>
									</svg>
								</a>
							<?php endif; ?>
							<?php if (get_field('viber_url', 'option')): ?>
								<a href="<?= get_field('viber_url', 'option') ?>" target="_blank" class="icons__elem">
									<svg>
										<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#viber'>
										</use>
									</svg>
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="menu-mobile-btn" @click="openMobMenu = ! openMobMenu">
					<svg class="burger">
						<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#mobile-menu'>
						</use>
					</svg>
					<svg class="cross">
						<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#cross-menu'>
						</use>
					</svg>
				</div>
			</div>
		</div>


		<div class="mob-menu" :class="{'active':openMobMenu}">
			<div class="container">
				<form class="search-wrapper" method="get" action="/">
					<input type="text" placeholder="Поиск" name="s" class="search">
					<button class="icon">
						<svg class="">
							<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#search-icon'>
							</use>
						</svg>
					</button>
				</form>
				<div class="menu">
					<?php $menuArr = (wp_get_menu_array('mobile_menu')); ?>
					<? foreach ($menuArr as $elem): ?>
						<li class="menu__item">
							<a href="<?= $elem["href"] ?>">
								<?= $elem["title"] ?>
							</a>
							<?php if ($elem['children']): ?>
								<div class="submenu">
									<? foreach ($elem['children'] as $child): ?>
										<a href="<?= $child['href'] ?>" class="submenu__item">
											<?= $child['title'] ?>
										</a>
									<? endforeach ?>
									<a onclick="window.cardFormData(event)" data-form-action="Индивидуальная разработка" data-form-title="Индивидуальная разработка" data-cur-material="" data-cur-complect="" data-cur-price="" class="submenu__item">
										Индивидуальная разработка
									</a>
								</div>
							<?php endif; ?>
						</li>
					<? endforeach ?>
				</div>
				<div class="btn" data-micromodal-trigger="callbackModal">
					Заказать звонок
				</div>
			</div>
		</div>
	</header>
	<div class="header-additional" x-data="{ openAdd: false }" :class="{'active':openAdd}">
		<div onclick="window.cardFormData(event)" data-form-action="Рассчитать цену дома"
			data-form-title="Рассчитать цену дома" data-cur-material="" data-cur-complect="" data-cur-price=""
			data-current-url=""
			class="header-additional__elem">
			<div class="img-container">
				<img src="/wp-content/themes/assembling/static/images/calc.png" alt="">
			</div>
			<p class="text">
				Рассчитать<br> цену дома
			</p>
		</div>
		<div class="header-additional__elem" onclick="window.cardFormData(event)" data-form-action="Рассчитать ипотеку"
			data-form-title="Рассчитать ипотеку" data-cur-material="" data-cur-complect="" data-cur-price=""
			data-current-url="">
			<div class="img-container">
				<img src="/wp-content/themes/assembling/static/images/houseIcon.png" alt="">
			</div>
			<p class="text">
				Дом<br> в ипотеку
			</p>
		</div>
		<div class="header-additional__open-hand" @click="openAdd = ! openAdd">
			<svg>
				<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#close-additional-arrow'>
				</use>
			</svg>
		</div>
	</div>
	<main>
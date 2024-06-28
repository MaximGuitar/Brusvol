</main>
</div>
<form hx-target="this" hx-post="/wp-admin/admin-ajax.php?action=sendMail" hx-swap="innerHTML"
	hx-vals='{"formName": "footerCallback"}' class="footer-form">
	<?php get_template_part('components/forms/footerCallback');  //подключаем поля форму из подвала      ?>
</form>
<footer class="footer">
	<div class="container">
		<div class="top-footer">
			<a href="/" class="logo">
				<svg>
					<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#main-logo'>
					</use>
				</svg>
			</a>
			<div class="footer-menu">
				<div class="title">
					Каталог проектов
				</div>
				<ul class="menu">
					<?php $menuArr = (wp_get_nav_menu_items('footer_menu')); ?>
					<? foreach ($menuArr as $elem): ?>
						<li class="menu__item">
							<a href="<?= $elem->url ?>">
								<?= $elem->post_title ?>
							</a>
						</li>
					<? endforeach ?>
					<li class="menu__item" onclick="window.cardFormData(event)" data-form-action="Индивидуальная разработка" data-form-title="Индивидуальная разработка" data-cur-material="" data-cur-complect="" data-cur-price="">
						<span>
							Индивидуальная разработка
						</span>
					</li>
				</ul>
			</div>
			<div class="number">
				<?php if (get_field('tel', 'option')): ?>
					<a href="tel:<?= get_field('tel', 'option') ?>" class="tel">
						<?php the_field('tel', 'option') ?>
					</a>
				<?php endif; ?>
				<p class="text">Бесплатная горячая линия</p>
				<?php if (get_field('dop_phone_number', 'option')): ?>
					<a href="tel:<?= get_field('dop_phone_number', 'option') ?>" class="more-number">
						<?php the_field('dop_phone_number', 'option') ?>
					</a>
				<?php endif; ?>
			</div>
			<div class="messengers">
				<?php if (get_field('mail', 'option')): ?>
					<a href="mailto:<?= get_field('mail', 'option') ?>" class="mail-adr">
						<svg>
							<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#email'>
							</use>
						</svg>
						<p>
							<?php the_field('mail', 'option') ?>
						</p>
					</a>
				<?php endif; ?>
				<div class="icons">
					<?php if (get_field('viber_url', 'option')): ?>
						<a href="<?= get_field('viber_url', 'option') ?>" class="icon">
							<svg>
								<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#footer-viber'>
								</use>
							</svg>
						</a>
					<?php endif; ?>
					<?php if (get_field('whats_up_url', 'option')): ?>
						<a href="<?= get_field('whats_up_url', 'option') ?>" class="icon">
							<svg>
								<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#footer-whatsup'>
								</use>
							</svg>
						</a>
					<?php endif; ?>
					<?php if (get_field('telegram_url', 'option')): ?>
						<a href="<?= get_field('telegram_url', 'option') ?>" class="icon">
							<svg>
								<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#footer_telegram'>
								</use>
							</svg>
						</a>
					<?php endif; ?>
					<?php if (get_field('vk_url', 'option')): ?>
						<a href="<?= get_field('vk_url', 'option') ?>" class="icon">
							<svg>
								<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#footer-vk'>
								</use>
							</svg>
						</a>
					<?php endif; ?>
				</div>
			</div>
			<div class="info">
				<div class="adress">
					<?php if (get_field('full_adress', 'option')): ?>
						<div class="place">
							<?php the_field('full_adress', 'option') ?>
						</div>
					<?php endif; ?>
					<?php if (get_field('adress_text', 'option')): ?>
						<div class="text">
							<?php the_field('adress_text', 'option') ?>
						</div>
					<?php endif; ?>
				</div>
				<?php if (get_field('work_time', 'option')): ?>
					<div class="work-time">
						<div class="title">График работы:</div>
						<p>
							<?php the_field('work_time', 'option') ?>
						</p>

					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>


	<div class="bottom-footer-wrapper">
		<div class="container">
			<div class="bottom-footer">
				<div class="copyright">
					<? $current_year = date('Y');
					echo "© " . get_field('company-name', 'option') . " " . $current_year; ?>
				</div>
				<a href="<?= get_page_link(3); ?>" class="privacy">Политика конфиденциальности</a>
				<a href="https://place-start.ru/" target="_blank" class="madeInPlacestart">Сделано в &nbsp;
					<svg>
						<use xlink:href='/wp-content/themes/assembling/static/images/sprite.svg#ps_logo'>
						</use>
					</svg>
				</a>
			</div>
		</div>
	</div>
</footer>

<!-- Модальные окна -->
<?php get_template_part('components/modal/callback-modal'); ?>



<script>
	window.ajaxUrl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
	window.templateUrl = '<?php bloginfo('template_url'); ?>';
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/src/js/components/common/libs/swiper-bundle.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/static/js/vendors.bundle.js"></script>
<script src="<?php bloginfo('template_url'); ?>/static/js/main.bundle.js"></script>
<?php the_field('footer_script', 'option'); ?>
<?php do_action('wp_footer'); ?>
</body>

</html>
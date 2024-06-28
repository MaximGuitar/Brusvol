<?php

	$theID = get_the_ID();
	$ancestors = get_ancestors( $theID, 'page' );
	$pageID = $ancestors ? $ancestors[count($ancestors) - 1] : $theID;

	$query = new WP_Query(array(
		'post_parent'	=> $pageID,
		'post_type'		=> 'page',
		'orderby'		=> 'menu_order',
		'order'			=> 'ASC',
		'posts_per_page'=> -1,
	));

?>
<?php if( $query->posts ): ?>

	<div class="sidebar">
		<ul>
			<?php
				foreach($query->posts as $key => $value ) {
					$class = $theID == $value->ID || in_array($value->ID, $ancestors) ? 'active' : '';
					$link = get_the_permalink($value->ID);
					echo '<li class="'.$class . $class_1.'">';
						echo '<a href="'.$link.'">'.$value->post_title.'</a>';
						$query2 = new WP_Query(array(
							'post_parent'	=> $value->ID,
							'post_type'		=> 'page',
							'orderby'		=> 'menu_order',
							'order'			=> 'ASC',
							'posts_per_page'=> -1,
						));

						if( $query2->posts ) {
							echo '<ul class="sub-menu">';
								foreach ($query2->posts as $key => $value2) {
									$class2 = $theID == $value2->ID ? 'active' : '';
									$link2 = get_the_permalink($value2->ID);
									echo '<li class="'.$class2.'"><a href="'.$link2.'">'.$value2->post_title.'</a></li>';
								}
							echo '</ul>';
						}
					echo '</li>';
				}
			?>
		</ul>
	</div>

<?php endif; ?>


<?php wp_reset_postdata(); ?>
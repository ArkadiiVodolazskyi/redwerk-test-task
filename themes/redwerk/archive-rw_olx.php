<?php get_header(); ?>

<main class="main">
	<div class="wrapper">

		<ul class="breadcrumbs">
			<li><a href="<?= get_home_url(); ?>">Головна</a></li>
			<li><a>Публікації</a></li>
		</ul>

		<?php
			$ad_posts = get_posts([
				'post_type'   => 'rw_olx',
				'posts_per_page' => -1,
				'orderby'     => 'date',
				'order'       => 'DESC',
			]);
			if (!empty($ad_posts) > 0) {
				get_template_part('templates/rw_olx-cards', null, [
					'ad_posts' => $ad_posts
				]);
			}
			wp_reset_postdata();
		?>

	</div>
</main>

<?php get_footer(); ?>
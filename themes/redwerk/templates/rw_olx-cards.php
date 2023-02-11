<?php
	$ad_posts = $args['ad_posts'];
?>

<section class="cards rw_olx" data-cards="rw_olx">

	<?php
		foreach ($ad_posts as $ad_post) {
			$id = $ad_post->ID;
			$title = $ad_post->post_title ?: 'Без назви';
			$url = get_permalink($id);
			$image_id = get_post_meta( $id, '_media_select', true );
			$image_url = wp_get_attachment_image_url($image_id, 'full');
			$categories = get_the_terms($ad_post, 'rw_olx_cat');
	?>
		<a
			class="card"
			href="<?= $url; ?>"
			<?= $image_id ? '' : 'data-no-image' ?>
		>

			<?php if ($image_id) { ?>
				<div class="thumbnail-wrapper">
					<img
						class="thumbnail"
						src="<?= $image_url; ?>"
						alt="<?= $title; ?>"
					>
				</div>
			<?php } ?>

			<div class="info">
				<h4 class="post-title">
					<?= $title; ?>
				</h4>

				<?php if ($categories
					&& is_array($categories)
					&& count($categories) > 0) { ?>
					<div class="post-categories">
						<?php foreach ($categories as $category) { ?>
							<span class="post-category">
								<?= $category->name; ?>
							</span>
						<?php } ?>
					</div>
				<?php } ?>
			</div>

		</a>
	<?php } ?>

</section>
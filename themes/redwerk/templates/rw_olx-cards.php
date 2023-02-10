<?php
	$ad_posts = $args['ad_posts'];
?>

<div class="cards">

	<?php
		foreach ($ad_posts as $ad_post) {
			$id = $ad_post->ID;
			$title = $ad_post->post_title;
			$url = get_permalink($id);
			$image_id = get_post_meta( $id, '_media_select', true );
			$image_url = wp_get_attachment_image_url($image_id, 'full');
			// TODO: check no title
			// TODO: check no image
			// TODO: add gradient border like in here https://xata.io/
	?>
		<a class="card" href="<?= $url; ?>">
			<img
				class="post-image"
				src="<?= $image_url; ?>"
				alt="<?= $title; ?>"
			>
			<h4 class="post-title">
				<?= $title; ?>
			</h4>
		</a>
	<?php } ?>

</div>
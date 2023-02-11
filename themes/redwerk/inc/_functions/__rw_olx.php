<?php

function register_post_types() {
	register_post_type(
		'rw_olx',
		[
			'labels' => [
				'name' => __('Публікації'),
				'singular_name' => __('Публікація'),
				'add_new' => __('Додати нову публікацію'),
				'add_new_item' => __('Додати нову публікацію')
			],
			'public' => true,
			'has_archive' => true,
			'menu_icon' => 'dashicons-format-status',
			'supports'	=> [
				'title',
			],
			'taxonomies' => ['rw_olx_cat'],
		]
	);
	register_taxonomy( 'rw_olx_cat', [ 'rw_olx' ], [
		'labels'                => [
			'name'              => __('Тип публікації'),
			'singular_name'     => __('Тип публікації'),
			'add_new_item' => __('Додати новий тип публікації')
		],
		'public'                => true,
	]);
}
add_action('init', 'register_post_types');

function add_media_select_meta_box() {
	add_meta_box(
		'media_select_meta_box',
		'Зображення',
		'media_select_meta_box_html',
		['rw_olx'],
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'add_media_select_meta_box' );

function media_select_meta_box_html( $post ) {
	wp_nonce_field( 'media_select_meta_box_nonce', 'media_select_meta_box_nonce' );
	$value = get_post_meta( $post->ID, '_media_select', true );
	$img_url = $value ? wp_get_attachment_image_url($value, 'full') : '';
	?>
		<img id="media-select-image" src="<?= $img_url; ?>" alt="" style="max-width: 100%; max-height: 400px; display: block;">
		<p>
			<input type="hidden" id="media-select-field" name="media_select" value="<?= esc_attr( $value ); ?>" />
			<button type="button" class="button" id="media-select-button">Обрати зображення</button>
			<button class="media-custom-field-remove" title="Видалити зображення">⤫</button>
		</p>
	<?php
}

function save_media_select_meta_box( $post_id ) {

	// TODO: remove debug
	mail ('aligator.cannon@gmail.com', "Test mail", "Test mail from mail");
	wp_mail( 'aligator.cannon@gmail.com', 'Test wp_mail', 'Hello wp_mail' );

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	update_post_meta( $post_id, '_media_select', sanitize_text_field( $_POST['media_select'] ) );
}
add_action( 'save_post', 'save_media_select_meta_box' );

function send_email_on_publish( $post_id ) {
	$post = get_post( $post_id );
	echo '<p>post published - send email start</p>';
	if (!$post->post_type === 'rw_olx') return;
	echo '<p>post is rw olx</p>';

	// Send to admin instantly
	$admin_email = get_bloginfo('admin_email');
	email_post_published_to( $post_id, $admin_email, 'Новий пост було опублiковано на сайтi' );
	echo '<p>email sent to admin</p>';

	// Send to author after x minutes
	$author_email = get_the_author_meta( 'user_email', $post->post_author );
	wp_schedule_single_event(
		time() + EMAIL_DELAY_MINUTES * 60,
		'email_post_published_to',
		[$author_email, $post_id, 'Ваш пост було опублiковано']
	);
	echo '<p>email scheduled to author</p>';
}
add_action( 'publish_post', 'send_email_on_publish' );

function email_post_published_to( $post_id, $author_email, $email_subject ) {
	$post = get_post( $post_id );
	$url = get_permalink( $post_id );
	$change_url = get_edit_post_link( $post_id );
	$message = "
		Пост #" . $post_id . " пiд назвою \"" . $post->post_title . "\" було опублiковано на сайтi.
		Подивитися публiкацiю можна за посиланням: <a href=" . $url . ">" . $url . "</a>.
		Внести змiни до публікації можна тут: <a href=" . $change_url . ">" . $change_url . "</a>.
	";
	wp_mail( $author_email, $email_subject, $message );
}
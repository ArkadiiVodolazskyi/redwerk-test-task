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
	if (
		!get_post_type() === 'rw_olx'
		|| !metadata_exists('post', $post_id, '_media_select')
	) return;
	update_post_meta( $post_id, '_media_select', sanitize_text_field( $_POST['media_select'] ) );
}
add_action( 'save_post', 'save_media_select_meta_box' );

function send_email_on_publish( $new_status, $old_status, $post ) {
	if (
		$new_status !== 'publish'
		|| $new_status === $old_status
		|| $post->post_type !== 'rw_olx'
	) return;
	$post_id = $post->ID;

	// Send to admin instantly
	$admin_email = get_bloginfo('admin_email');
	email_post_published_to( $post_id, $admin_email, 'Новий пост було опублiковано на сайтi' );

	// TODO: setup CRON
	// Send to author after x minutes
	$author_email = get_the_author_meta( 'user_email', $post->post_author );
	$current_time = current_time('timestamp', 0);
	$delay = EMAIL_DELAY_MINUTES * 60;
	$scheduled_time = $current_time + $delay;
	$scheduled_email = wp_schedule_single_event(
		$scheduled_time,
		'email_post_published_to',
		[$post_id, $author_email, 'Ваш пост було опублiковано'],
		true
	);
	if (!$scheduled_email) {
		echo '<pre>';
		print_r($scheduled_email);
		echo '</pre>';
	}
}
add_action( 'transition_post_status', 'send_email_on_publish', 10, 3 );

function email_post_published_to( $post_id, $author_email, $email_subject ) {
	$post = get_post( $post_id );
	$post_title = $post->post_title;
	$url = get_permalink( $post_id );
	$change_url = get_edit_post_link( $post_id );
	$message = "
		Оголошення #" . $post_id . " пiд назвою \"" . $post_title . "\" було опублiковано на сайтi.
		Подивитися оголошення можна за посиланням: " . $url . ".
		Внести змiни до оголошення можна тут: " . $change_url . ".
	";
	wp_mail( $author_email, $email_subject, $message );
}

// TODO: remove TEST

// add_action( 'my_cronjob', 'my_cronjob_function' );
// function my_cronjob_function($post_id, $author_email, $email_subject) {
// 	email_post_published_to( 97, 'aligator.cannon@gmail.com', 'TEST 2 Ваш пост було опублiковано' );
// }

// add_action( 'my_cronjob', function ($post_id, $author_email, $email_subject) {
add_action( 'my_cronjob', function () {
	email_post_published_to( 97, 'aligator.cannon@gmail.com', 'TEST 2 Ваш пост було опублiковано' );
} );

add_action( 'init', 'test_init' );
function test_init() {
	wp_cron();

	email_post_published_to( 97, 'aligator.cannon@gmail.com', 'TEST 1 Новий пост було опублiковано на сайтi' );

	// TODO: remove
	if (wp_next_scheduled( 'my_cronjob' )) {
		wp_unschedule_hook( 'my_cronjob' );
	}

	$current_time = current_time('timestamp', 0);
	$delay = EMAIL_DELAY_MINUTES * 60;
	$scheduled_time = $current_time + $delay;
	$scheduled_event = wp_schedule_single_event(
		$scheduled_time,
		'my_cronjob',
		// array(97, 'aligator.cannon@gmail.com', 'TEST 2 Ваш пост було опублiковано'),
		[],
		true
	);

	if (!$scheduled_event) {
		echo 'If scheduled event is okay: ' . "\n";
		print_r($scheduled_event);
		echo "\n";
	}
}
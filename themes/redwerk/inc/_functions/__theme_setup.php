<?php

// Enqueue parent theme styles
add_action( 'wp_enqueue_scripts', 'my_child_theme_scripts' );
function my_child_theme_scripts() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

define("B_THEME_ROOT", get_stylesheet_directory_uri());
define("CSS_DIR", B_THEME_ROOT . "/assets/css");
define("JS_DIR", B_THEME_ROOT . "/assets/js");
define("IMG_DIR", B_THEME_ROOT . "/assets/img");
define("LIBS_DIR", B_THEME_ROOT . "/assets/libs");
define("FONTS_DIR", B_THEME_ROOT . "/assets/fonts");
define("UPLOADS_DIR", wp_get_upload_dir()['baseurl']);

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
	$img_url = wp_get_attachment_image_url($value, 'full');
	?>
		<p>
			<img src="<?= $img_url; ?>" alt="" style="max-width: 100%;">
			<input type="hidden" id="media-select-field" name="media_select" value="<?php echo esc_attr( $value ); ?>" />
			<button type="button" class="button" id="media-select-button">Обрати зображення</button>
		</p>
	<?php
}

function save_media_select_meta_box( $post_id ) {
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'media_custom_field_nonce' ] ) && wp_verify_nonce( $_POST[ 'media_custom_field_nonce' ], basename( __FILE__ ) ) ) ? true : false;
	if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( ! isset( $_POST['media_select'] ) ) {
		return;
	}
	update_post_meta( $post_id, '_media_select', sanitize_text_field( $_POST['media_select'] ) );
}
add_action( 'save_post', 'save_media_select_meta_box' );

function enqueue_admin_scripts() {
	wp_enqueue_media();
	wp_register_script('main-admin', JS_DIR . '/main-admin.babel.min.js', ['jquery']);
	wp_enqueue_script('main-admin');
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_scripts' );

function register_styles() {
	wp_register_style('main-css', CSS_DIR . "/main.css?");
	wp_enqueue_style('main-css');
}

function register_scripts() {
	wp_register_script('main-js', JS_DIR . "/main.babel.min.js", [], date("h:i:s"), true);
	wp_enqueue_script('main-js');
}

function theme_setup() {
	add_theme_support('menus');
	register_nav_menu('header', 'Header');
	register_nav_menu('footer', 'Footer');

	add_theme_support('title-tag');
	add_theme_support('custom-logo');
	add_theme_support('post-thumbnails');
	add_theme_support('widgets-block-editor');

	add_action('wp_enqueue_scripts', 'register_styles');
	add_action('wp_enqueue_scripts', 'register_scripts');
}
add_action('after_setup_theme', 'theme_setup');

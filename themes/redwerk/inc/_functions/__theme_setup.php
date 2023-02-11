<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

add_action( 'wp_enqueue_scripts', 'my_child_theme_scripts' );
function my_child_theme_scripts() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

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
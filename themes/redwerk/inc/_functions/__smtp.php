<?php

add_action('phpmailer_init', function ($phpmailer) {
	$phpmailer->isSMTP();
	$phpmailer->SMTPAuth = WORDPRESS_SMTP_AUTH;
	$phpmailer->SMTPSecure = WORDPRESS_SMTP_SECURE;
	$phpmailer->SMTPAutoTLS = false;
	$phpmailer->Host = WORDPRESS_SMTP_HOST;
	$phpmailer->Port = WORDPRESS_SMTP_PORT;
	$phpmailer->From = WORDPRESS_SMTP_FROM;
	$phpmailer->FromName = WORDPRESS_SMTP_FROM_NAME;
	$phpmailer->Username = WORDPRESS_SMTP_USERNAME;
	$phpmailer->Password = WORDPRESS_SMTP_PASSWORD;
});

add_filter( 'wp_mail_from', fn( $email ) => 'redwerk.local@mail.com' );
add_filter( 'wp_mail_from_name', fn( $name ) => 'redwerk.local' );
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<?php
	// https://www.unixtimestamp.com/

	// Kyiv - 1676213899
	// GMT 	Sun Feb 12 2023 14:58:19 GMT+0000
	// Your Time Zone 	Sun Feb 12 2023 16:58:19 GMT+0200 (Eastern European Standard Time)
	// Relative 	in 2 hours

	// UTC - 1676206927
	// GMT 	Sun Feb 12 2023 13:02:07 GMT+0000
	// Your Time Zone 	Sun Feb 12 2023 15:02:07 GMT+0200 (Eastern European Standard Time)
	// Relative 	a few seconds ago

	$current_time = current_time('timestamp', 0);
	$delay = EMAIL_DELAY_MINUTES * 60;

	echo 'current_time = ' . $current_time . "\n";
	echo 'delay = ' . $delay . "\n";
	echo 'current_time + delay separately = ' . $current_time + $delay . "\n";

	$next_scheduled_event_timestamp = wp_next_scheduled( 'my_cronjob', [] );
	echo "next_scheduled_event_timestamp: ";
	echo '<pre>';
	print_r($next_scheduled_event_timestamp);
	echo '</pre>';

	$next_scheduled_event = wp_get_scheduled_event( 'my_cronjob', [], $next_scheduled_event_timestamp );
	echo "next_scheduled_event: ";
	echo '<pre>';
	print_r($next_scheduled_event);
	echo '</pre>';

	echo "All CRON events: \n";
	echo '<pre>';
	print_r(get_option( 'cron' ));
	echo '</pre>';
?>

<body>

	<header class="header-main" data-watch="scroll">
		<div class="wrapper">
			<div class="top">
				<a class="logo" href="<?= get_home_url(); ?>">
					<svg style="max-width: 150px; max-height: 24px;">
						<use href="<?= IMG_DIR; ?>/icons.svg#logo"></use>
					</svg>
				</a>
				<button class="hamburger" data-activate="nav"></button>
			</div>
			<nav>
				<?= get_nav_menu('header'); ?>
			</nav>
		</div>
	</header>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body>

	<header class="header-main" data-watch="scroll">
		<div class="wrapper">
			<div class="top">
				<a class="logo" href="<?= get_home_url(); ?>">
					<svg width="64" height="37">
						<use href="<?= IMG_DIR; ?>/icons.svg#logo"></use>
					</svg>
				</a>
				<button class="hamburger" data-activate="nav"></button>
			</div>
			<nav>
				<?= get_nav_menu('header'); ?>
				<div class="search">
					<input class="search-field" type="search" placeholder="Search here...">
					<button class="search-button">
						<svg class="search-icon" width="20" height="20">
							<use href="<?= IMG_DIR; ?>/icons.svg#search"></use>
						</svg>
					</button>
				</div>
			</nav>
		</div>
	</header>
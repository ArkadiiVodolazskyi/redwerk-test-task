<footer class="footer-main">
	<div class="wrapper">
		<a class="logo" href="<?= get_home_url(); ?>">
			<svg width="64" height="37">
				<use href="<?= IMG_DIR; ?>/icons.svg#logo"></use>
			</svg>
		</a>
		<nav>
			<?= get_nav_menu('footer'); ?>
		</nav>
	</div>
</footer>

<?php wp_footer(); ?>

</body>

</html>
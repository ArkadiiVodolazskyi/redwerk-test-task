document.addEventListener('DOMContentLoaded', () => {

	// Init slider
	(() => {
		const merchSliderNode = document.querySelector('[data-slider=merch]');
		if (!merchSliderNode) { return; }
		const merchSlider = tns({
			container: merchSliderNode,
			controlsPosition: 'bottom',
			controlsText: ['', ''],
			controlsContainer: '.slider-buttons',
			navContainer: '.slider-dots',
			mouseDrag: true,
			swipeAngle: 30,
			loop: false
		});
	})();

	// Toggle search
	(() => {
		const searchBox = document.querySelector('.search');
		searchBox?.addEventListener('click', e => {
			const searchBtn = e.target.closest('.search-button');
			if (!searchBtn) { return; }
			searchBox.toggleAttribute('data-active');
		});
	})();

	// Toggle dropdown - mobile
	(() => {
		const navMenu = document.querySelector('.nav-menu');
		if (!navMenu) { return; }
		navMenu.addEventListener('click', e => {
			const dropdown = e.target.closest('.dropdown');
			if (!dropdown) { return; }
			e.preventDefault();
			dropdown.toggleAttribute('show-dropdown');
		});
	})();

	// Toggle nav - mobile
	(() => {
		const hamburger = document.querySelector('[data-activate="nav"]');
		if (!hamburger) { return; }
		hamburger.addEventListener('click', e => {
			e.target.closest('.header-main').toggleAttribute('show-nav');
		});
	})();

}, true);

window.addEventListener('load', () => {

	const headerMain = document.querySelector('[data-watch=scroll]');

	// Watch scroll - header
	(() => {
		window.addEventListener('scroll', () => {
			const scroll = window.scrollY;
			if (scroll > 0) {
				headerMain.toggleAttribute('data-scroll', true);
			} else {
				headerMain.toggleAttribute('data-scroll', false);
			}
		});
	})();

}, true);
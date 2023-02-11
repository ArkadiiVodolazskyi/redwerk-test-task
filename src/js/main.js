document.addEventListener('DOMContentLoaded', () => {

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
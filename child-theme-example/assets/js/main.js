// Child theme JS entry point.

document.addEventListener('DOMContentLoaded', () => {
	const hero = document.querySelector('.hero');
	if (hero) {
		hero.setAttribute('data-ready', 'true');
	}
});
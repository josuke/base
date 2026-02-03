document.addEventListener('click', (event) => {
	const target = event.target;
	if (!(target instanceof Element)) {
		return;
	}

	const anchor = target.closest('a[href^="#"]');
	if (!anchor) {
		return;
	}

	const href = anchor.getAttribute('href');
	if (!href || href === '#' || href === '#0') {
		return;
	}

	const id = href.slice(1);
	const destination = document.getElementById(id);
	if (!destination) {
		return;
	}

	event.preventDefault();
	destination.scrollIntoView({ behavior: 'smooth', block: 'start' });
});

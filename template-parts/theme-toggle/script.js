(() => {
	const root = document.documentElement;
	const storageKey = 'base-theme';
	const stored = localStorage.getItem(storageKey);

	const applyTheme = (value) => {
		if (value === 'dark') {
			root.setAttribute('data-theme', 'dark');
		} else if (value === 'light') {
			root.setAttribute('data-theme', 'light');
		} else {
			root.removeAttribute('data-theme');
		}
	};

	applyTheme(stored || 'light');

	const updateButton = (button) => {
		const isDark = root.getAttribute('data-theme') === 'dark';
		button.setAttribute('aria-pressed', isDark ? 'true' : 'false');
		button.setAttribute('data-theme-current', isDark ? 'dark' : 'light');
		button.setAttribute('data-theme', isDark ? 'dark' : 'light');
	};

	const buttons = document.querySelectorAll('[data-theme-toggle]');
	buttons.forEach((button) => updateButton(button));

	document.addEventListener('click', (event) => {
		const button = event.target.closest('[data-theme-toggle]');
		if (!button) {
			return;
		}

		const isDark = root.getAttribute('data-theme') === 'dark';
		const next = isDark ? 'light' : 'dark';
		localStorage.setItem(storageKey, next);
		applyTheme(next);
		buttons.forEach((btn) => updateButton(btn));
	});
})();

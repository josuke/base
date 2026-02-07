(() => {
	const overlay = document.querySelector('[data-loader]');
	if (!overlay) {
		return;
	}

	const percentEl = overlay.querySelector('[data-loader-percent]');
	const start = performance.now();
	let resolved = false;

	const updatePercent = (value) => {
		if (!percentEl) {
			return;
		}
		const clamped = Math.max(0, Math.min(100, value));
		percentEl.textContent = `${clamped}%`;
	};

	const tick = (now) => {
		if (resolved) {
			return;
		}

		const elapsed = now - start;
		const progress = Math.min(elapsed / 2000, 0.99);
		const value = Math.floor(progress * 100);
		updatePercent(value);
		requestAnimationFrame(tick);
	};

	const finish = () => {
		if (resolved) {
			return;
		}
		resolved = true;
		updatePercent(100);
		overlay.setAttribute('aria-hidden', 'true');
		overlay.classList.add('loader-overlay--done');
		setTimeout(() => {
			overlay.remove();
		}, 500);
	};

	window.addEventListener('load', finish, { once: true });
	requestAnimationFrame(tick);
})();

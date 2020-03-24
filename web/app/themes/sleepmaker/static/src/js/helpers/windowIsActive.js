const listeners = [];

function cbTriggered(isActive) {
	listeners.forEach((elem) => {
		if (elem) elem(isActive);
	});
}

/**
 * Отслеживание активного окна браузера
 */
export default function windowIsActive(cb) {
	if (!window || !addEventListener) return;

	listeners.push(cb);
	
	if (typeof window['_isWindowActive'] !== 'undefined') return;
	
	window.addEventListener('focus', () => {
		window._isWindowActive = true;
		cbTriggered(true);
	});
	
	window.addEventListener('blur', () => {
		window._isWindowActive = false;
		cbTriggered(false);
	});
	
	window._isWindowActive = true;
};

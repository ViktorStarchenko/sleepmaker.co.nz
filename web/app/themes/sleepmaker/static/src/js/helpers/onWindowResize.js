const _callbackList = {};

/**
 * Отслеживает изменение размеров окна браузера и вызывает cb если привысело время указанное в duration
 * @param {function} cb каллбэк
 * @param {number} [duration=300] интервал в миллисикундах
 */

export default function(cb, duration = 300) {
	if (_callbackList[duration] === undefined) {
		_callbackList[duration] = [];
	}
	if (typeof cb === 'function') {
		_callbackList[duration].push({ cb, timer: null });
	} else {
		console.error('onWindowResize: the first argument must be a function');
	}
}

window.addEventListener('resize', () => {
	for (const key in _callbackList) {
		const array = _callbackList[key];
		array.forEach(element => {
			clearTimeout(element.timer);
			element.timer = setTimeout( element.cb, Number(key) );
		});
	}
});

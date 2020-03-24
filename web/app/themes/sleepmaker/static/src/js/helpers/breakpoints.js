/**
 * Подписка на событие window.matchMedia('(max-width: {Number})')
 * @param {Number} breakpoint ширина окна браузера в пикселях на которой происходит вызов каллбэк функции
 * @param {function(boolean)} callback функция обратного вызова
 */
export default function(breakpoint, callback) {
	const mq = window.matchMedia(`(max-width: ${breakpoint}px)`);
	mq.addListener(({ matches }) => {
		if (typeof callback === 'function') callback(matches);
	});
	if (typeof callback === 'function') callback(mq.matches);
}

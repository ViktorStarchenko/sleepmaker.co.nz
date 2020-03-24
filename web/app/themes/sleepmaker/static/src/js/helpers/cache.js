/**
 * Кешировние
 * @param {*} key ключ
 * @param {*} value значение
 */
function cache(key, value) {
	if (typeof value == 'undefined') {
		return cache[key];
	}
	cache[key] = value;
}

/**
 * Обертка под querySelector, сохраняющая элементы в кэш
 * @param {String} selector css селектор
 * @returns {Element}
 */
// 
function _qs(selector) {
	if (!cache(selector)) {
		cache(selector, document.querySelector(selector));
	}
	return cache(selector);
}

/**
 * Обертка под querySelectorAll, сохраняющая элементы в кэш
 * @param {String} selector css селектор
 * @returns {Element}
 */
// 
function _qsa(selector) {
	if (!cache(selector)) {
		cache(selector, document.querySelectorAll(selector));
	}
	return cache(selector);
}

export {
	_qs, _qsa, cache
};

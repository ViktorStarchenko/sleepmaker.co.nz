import { _qs, _qsa } from './cache';

/**
 * Плавная прокрутка к якорю.
 * Используется в паре с smoothscroll-polyfill.
 */
function SmoothScroll() {
	const MODULE = {};

	function scrollToElement(element) {
		const selector = element.href.match(/#.+/);
		const targetElem = _qs(selector);
		if (!targetElem) return;
		targetElem.scrollIntoView({ behavior: 'smooth' });
	}
	
	MODULE.init = () => {
		const links = _qsa('a[href*="#"]');
		for (let i = 0; i < links.length; i++) {
			const element = links[i];
			element.addEventListener('click', () => {
				scrollToElement(element);
			});
		}
	};

	return MODULE;
};

export default SmoothScroll();

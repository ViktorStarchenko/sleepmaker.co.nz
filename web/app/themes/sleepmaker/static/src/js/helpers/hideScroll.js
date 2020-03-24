import getScrollWidth from './getScrollWidth';
import BindEvent from './BindEvent';

const _state = {
	body: null,
	scrollTop: undefined,
	cssText: undefined,
	count: 0,
	style: ''
};


/**
 * **Скрытие скроллбара.**
 * 
 * Когда происходит скрытие скроллбара
 * элементу BODY добавляется `class="scroll-hidden"`
 * @param {Boolean} isHide
 */

export default function hideScroll(isHide) {
	const body = _state.body || document.body;
	_state.style = document.documentElement.style;

	if (!body) {
		console.warn('hideScroll() - cant\'t find HTMLBodyElement');
		return;
	}

	return new Promise((resolve) => {
		if (_state.cssText === undefined) _state.cssText = body.style.cssText;
	
		if (isHide) {
			++_state.count;
		} else if (_state.count > 0) {
			--_state.count;
		}
	
		if (_state.count === 1 && isHide) {
			_state.scrollTop = window.pageYOffset;
			body.style.cssText = `
			position: fixed;
			top: ${-_state.scrollTop}px;
			left: 0;
			right: 0;
			padding-right: ${getScrollWidth()}px;
			overflow: hidden;
			scroll-behavior: auto`;
			body.classList.add('scroll-hidden');
		} else if (_state.count === 0 && !isHide) {
			body.style.cssText = _state.cssText;
			window.scroll({
				top: _state.scrollTop,
				behavior: 'instant'
			});
			body.classList.remove('scroll-hidden');
		}
		
		resolve(isHide);
		BindEvent.dispatch('hidescroll', { isHide, scrollWidth: getScrollWidth() });
	});
}

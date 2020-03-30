import { _qs } from '../helpers/cache';
import hideScroll from '../helpers/hideScroll';
import getScrollWidth from '../helpers/getScrollWidth';

const _state = {
	isInit: false,
	isOpen: false,
	menuSelector: '.js-menu-mob',
	openSelector: '.js-menu-mob-open',
	closeSelector: '.js-menu-mob-close',
	isVisibleClassName: 'is-visible',
	isHiddenClassName: 'is-hidden',
	menuElem: null,
	delayClose: 500,
	body: null
};

/**
 * Геттеры
 */
const _get = {
	/**
	 * Состояние инициализации
	 * @param {boolean} value
	 */
	get isInit() {
		return _state.isInit;
	}
};

/**
 * Сеттеры
 */
const _set = {
	/**
	 * Установка состояния инициализации
	 * @param {boolean} value
	 */
	set isInit(value) {
		_state.isInit = value;
	}
};

/**
 * Установка слушаетелея событй
 */
function events() {
	if (_get.isInit === true) return;

	_state.body.addEventListener('click', (e) => {
		let t = e.target;

		if (t === _state.menuElem) {
			menuToggle(false);
			return;
		}

		while (t && t !== _state.body) {
			if (t.matches(_state.openSelector)) {
				menuToggle(true);
				return;
			}
			if (t.matches(_state.closeSelector)) {
				menuToggle(false);
				return;
			}
			if (t) t = t.parentElement;
		}
	});

	// Закрытие по Esc
	_state.body.addEventListener('keyup', (e) => {
		if (e.keyCode === 27 && _state.isOpen) menuToggle(false);
	});
}

/**
 * Открытие\закрытие меню
 * @param {Boolean} isOpen 
 */
function menuToggle(isOpen) {
	_state.isOpen = isOpen;

	const scrollDellay = 100; // задержка на работу функции скрытия скрола

	setTimeout(() => {
		hideScroll(isOpen);
		_state.body.classList[isOpen ? 'add' : 'remove']('modal-open');
		_state.menuElem.classList[isOpen ? 'remove' : 'add'](_state.isHiddenClassName);
		_state.menuElem.style.right = isOpen ? getScrollWidth() + 'px' : '';
	}, isOpen ? 0 : _state.delayClose + scrollDellay);

	setTimeout(() => {
		requestAnimationFrame(() => {
			_state.menuElem.classList[isOpen ? 'add' : 'remove'](_state.isVisibleClassName);
			
		});
	}, scrollDellay);
}

/**
 * Инициализация.
 * Нужно вызвать после загрузки DOM.
 */
function init() {
	_state.body = _qs('body');
	_state.menuElem = _qs(_state.menuSelector);

	if (!_state.menuElem) {
		console.warn(`MenuMobile: cant't find element by selector "${_state.menuSelector}"`);
		return;
	}

	events();

	_set.isInit = true;
};

export default {
	init
};

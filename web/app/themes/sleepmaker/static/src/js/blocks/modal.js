import hideScroll from '../helpers/hideScroll';
import getScrollWidth from '../helpers/getScrollWidth';
import { _qs } from '../helpers/cache';
import axios from '../lib/axios';
import BindEvent from '../helpers/BindEvent';

const _state = {
	isInit: false,
	isOpen: false,
	body: null,
	containerSelector: '.js-modal-container',
	modalSelector: '.js-modal',
	openSelector: '.js-modal-open',
	closeSelector: '.js-modal-close',
	containerCloseDellay: 500,
	containerElem: null,
	currentModalElem: null,
	dataCollection: {},
};

/**
 * Геттеры для получения значний свойств объекта _state
 */
const _get = {
	/**
	 * Состояние (открыто/закрыто) модального окна
	 * @returns {boolean}
	 */
	get isOpen() {
		return _state.isOpen;
	},

	/**
	 * Состояние инициализации
	 * @returns {boolean}
	 */
	get isInit() {
		return _state.isInit;
	},

	/**
	 * Контейнер модальных окон
	 * @returns {Element}
	 */
	get containerElem() {
		if (_state.containerElem) {
			return _state.containerElem;
		} else {
			const elem = document.querySelector(_state.containerSelector);
			if (elem) {
				_set.containerElem = elem;
				return _state.containerElem;
			} else {
				console.error(`Modal: can't find element by selector ${_state.containerSelector}`);
			}
		}
	}
};

/**
 * Сеттеры для установки значний свойств объекта _state
 */
const _set = {
	/**
	 * Установка состояния (открыто/закрыто) модального окна
	 * @param {boolean} value
	 */
	set isOpen(value) {
		_state.isOpen = value;
	},

	/**
	 * Установка состояния инициализации
	 * @param {boolean} value
	 */
	set isInit(value) {
		_state.isInit = value;
	},

	/**
	 * Установка контейнера модальных окон
	 * @param {Element} value
	 */
	set containerElem(value) {
		_state.containerElem = value;
	}
};

/**
 * Прокрутка содержимого модального окна вверх и обработка
 * @param {Element} elem 
 */
function scrollBodyToTop(elem) {
	const modaBodyElem = elem.querySelector('.modal__body');
	if (modaBodyElem.scrollTop === 0) return;
	modaBodyElem.scrollTop = 0;
}

/**
 * Добавление классов при скроле тела модального окна
 */
function modalBodyScroll() {
	const modaBodyElemAll = document.querySelectorAll('.modal__body');
	if (!modaBodyElemAll[0]) return;

	function addClass(element) {
		const scrollTop = element.scrollTop;
		const height = element.clientHeight;
		const scrollHeight = element.scrollHeight;

		requestAnimationFrame(() => {
			element.classList[scrollTop <= 5 ? 'remove' : 'add']('is-scroll-top');
			element.classList[scrollTop + height >= scrollHeight - 5 ? 'remove' : 'add']('is-scroll-bottom');
		});
	}

	for (let i = 0; i < modaBodyElemAll.length; i++) {
		const element = modaBodyElemAll[i];

		if (element._event_modalBodyScroll) return;

		addClass(element);

		element.addEventListener('scroll', () => {
			addClass(element);
		});
	}
}

/**
 * Компенсация отступа при удалении скроллбара
 */
function setRightMargin() {
	let marginWidth = _get.isOpen ? getScrollWidth() + 'px' : '';
	_get.containerElem.style.right = marginWidth;
}

/**
 * Передача данных в текущее модальное окно.
 * Данные в виде строки помещаются вмето @{modalData}@
 * @param { Element } currentModalElem
 * @param { Object } props `DOMStringMap` - объект с дата-атрибутами взятыми с кнопки `.js-modal-open`
 */
function dataTransfer(currentModalElem, props) {
	const {
		modalData,
		modalDataSelector = '.js-modal-data',
		modalDataConstant = '@{modalData}@'
	} = props;
	if (!currentModalElem || !modalData) return;

	const elem = currentModalElem.querySelector(modalDataSelector);
	if (!elem) return;

	function replaceHtml(elem, defaultHtml) {
		const newHTML = defaultHtml.replace(modalDataConstant, modalData);
		elem.outerHTML = newHTML;
		if (!_state.dataCollection.hasOwnProperty(newHTML)) {
			_state.dataCollection[newHTML] = defaultHtml;
		}
	}

	const oldHtml = elem.outerHTML;
	if (~oldHtml.indexOf(modalDataConstant)) {
		if (oldHtml) replaceHtml(elem, oldHtml);
	} else {
		const defaultHtml = _state.dataCollection[oldHtml];
		if (defaultHtml) replaceHtml(elem, defaultHtml);
	}
}

/**
 * Поиск элемента модального окна
 * @param { Object } props `DOMStringMap` - объект с дата-атрибутами взятыми с кнопки `.js-modal-open`
 * @returns { Element }
 */
function findModalElem(props = {}) {
	if (typeof props.modalId === 'undefined') {
		throw new Error('Modal: cant\'t find attribute data-modal-id="" on trigger button');
	} else if (props.modalId.length < 1) {
		throw new Error(`Modal: there can be no ID with that name "${props.modalId}"`);
	}

	const elem = document.getElementById(props.modalId);
	if (!elem) {
		throw new Error(`Modal: can\'t find element id="${props.modalId}"`);
	}

	return elem;
}


function setHtml(currentModalElem, prop = {}) {
	if(!prop.modalHtml) return;

	const htmlContainer = currentModalElem.querySelector('.js-modal-set-html');
	if(htmlContainer) {
		htmlContainer.innerHTML = '';
	
		let htmlContent = document.querySelector(prop.modalHtml).innerHTML;
		htmlContainer.innerHTML = htmlContent;
	}
}
/**
 * Открытие модального окна
 * @param { Object } props `DOMStringMap` - объект с дата-атрибутами взятыми с кнопки `.js-modal-open`
 * @param { String } props.modalId идентификатор модального окна
 * @param { String } props.modalAjaxUrl URL для загрузки данных через Ajax, ответ ожиается `{ html: String }`
 * @param { String } props.modalAjaxSelector CSS селектор куда поместить через `innerHTML` данные после Ajax
 * @param { String } props.modalData данные в виде строки
 * @param { String } props.modalDataSelector селектор элемента контейнера, по умоланию ".js-modal-data"
 * @param { String } props.modalDataConstant константа вместо котрой будет вставлены передаваемые данные, по умолчанию @{modalData}@
 */

function open(props = {}) {
	return new Promise(resolve => {
		if (!_state.isInit) {
			throw new Error('Modal: First you need to call the method Modal.init()"');
		}

		close().then(() => {
			if (props.modalAjaxUrl) {
				return axios.get(props.modalAjaxUrl, {
					headers: { 'X-Requested-With': 'XMLHttpRequest' },
				});
			}
		}).then(result => {
			const currentModalElem = findModalElem(props);
			_state.currentModalElem = currentModalElem;

			if (props.modalAjaxUrl) {
				const ajaxSelector = props.modalAjaxSelector || '.js-modal-ajax';
				const ajaxElem = currentModalElem.querySelector(ajaxSelector);
				if (ajaxElem) {
					ajaxElem.innerHTML = result.data;
				} else {
					throw new Error(`Modal: can\'t find elem by selector "${ajaxSelector}"`);
				}
			}

			dataTransfer(currentModalElem, props);
			setHtml(currentModalElem, props);
			hideScroll(true);
			setRightMargin();

			_state.body.classList.add('modal-opened');
			_get.containerElem.classList.remove('is-hidden');
			currentModalElem.classList.remove('is-hidden');

			requestAnimationFrame(() => {
				_get.containerElem.classList.add('is-visible');
				currentModalElem.classList.add('is-visible');
			});

			_set.isOpen = true;

			BindEvent.dispatch('modal', {
				currentModalElem,
				isOpen: true,
				id: currentModalElem.id
			});

			resolve({
				currentModalElem,
				id: currentModalElem.id
			});
		});
	});
}

/**
 * Закрытие модального окна
 */
function close() {
	return new Promise(resolve => {

		if (!_state.isInit) {
			throw new Error('Modal: First you need to call the method Modal.init()"');
		}

		const {
			body,
			currentModalElem,
			containerCloseDellay
		} = _state;

		if (currentModalElem) {
			requestAnimationFrame(() => {
				_get.containerElem.classList.remove('is-visible');
				currentModalElem.classList.remove('is-visible');
			});

			setTimeout(() => {
				_get.containerElem.classList.add('is-hidden');
				currentModalElem.classList.add('is-hidden');
				_set.isOpen = false;

				_state.currentModalElem = null;
				hideScroll(false);
				setRightMargin();
				body.classList.remove('modal-opened');
				scrollBodyToTop(currentModalElem);
				currentModalElem.querySelectorAll('form').forEach(formEl => { formEl.reset(); });

				let modalSetHtmlContainer = currentModalElem.querySelector('.js-modal-set-html');
				if(modalSetHtmlContainer) modalSetHtmlContainer.innerHTML = '';
				

				BindEvent.dispatch('modal', {
					currentModalElem,
					isOpen: false,
					id: currentModalElem.id
				});

				resolve({
					currentModalElem,
					id: currentModalElem.id
				});

			}, containerCloseDellay);

		} else resolve();
	});
}

/**
 * Установка слушателей событий
 */
function events() {
	_state.body.addEventListener('click', (e) => {
		let t = e.target;

		if (t && t === _get.containerElem) {
			close();
			return;
		}

		while (t && t !== _state.body) {
			if (t && t.matches(_state.closeSelector)) {
				e.preventDefault();
				close();
				return;
			}

			if (t && t.matches(_state.openSelector)) {
				e.preventDefault();
				open(t.dataset);
				return;
			}

			if (t) t = t.parentElement;
		}
	});

	// Закрытие по Esc
	_state.body.addEventListener('keyup', (e) => {
		if (e.keyCode === 27 && _state.isOpen) close();
	});
}

export default {
	open, close,

	/**
	 * Инициализация
	 */
	init(options) {
		if (_state.isInit) return;
		Object.assign(_state, options);
		_set.containerElem = _qs(_state.containerSelector);
		_state.body = document.body;
		events();
		modalBodyScroll();
		_state.isInit = true;
	}
};

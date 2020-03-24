import validator from 'jquery-form-validator/form-validator/jquery.form-validator.min.js';
import Debug from '../helpers/debug';
import Modal from './modal';
import getCoords from '../helpers/getCoords';
import axios from '../lib/axios';
import FormSelect from './form-select';
import FormFile from './form-file';

const _state = {
	validateElemAll: null,
	appRoot: null,
	successDelay: 1000, //ms
};

/**
 * Прокрутка к элементу
 * @param {Element} elem
 */
function scrollToElem(elem) {
	if (elem) {
		let elemTop = getCoords(elem).top - 100;
		window.scroll({ top: elemTop > 0 ? elemTop : 0, behavior: 'smooth' });
	}
}

/**
 * Действия после успешной отрпавки формы
 * @param {Element} currentForm 
 */
function successActions(currentForm) {
	setTimeout(() => {
		currentForm.reset();
		if (currentForm.dataset && currentForm.dataset.success) {
			Modal.open({ modalId: currentForm.dataset.success });
		}
	}, _state.successDelay);
}

/**
 * Отправка AJAX
 * @param {Element} formThis 
 */
function sendAjax(formThis) {
	let url = window.location.pathname;
	let formData = new FormData(formThis[0]);

	axios({
		method: 'POST',
		headers: { 'content-type': 'application/x-www-form-urlencoded' },
		data: formData,
		url,
	}).then(response => {
		if (response === 'Y') {
			successActions(formThis[0]);
		}
	}).catch(error => {
		// handle error
		console.error(error);
	}).finally(() => {
		// always executed
	});

	if (Debug.isLocal()) {
		successActions(formThis[0]);
	}
}

/**
 * Подсветка кастомного селекта в зависимотсти от статуса <input> внутри
 * @param {Element} errorElem 
 * @param {Boolean} hasError 
 */
function highlightFormSelect(formElem) {
	if (!formElem[0]) return;
	const formSelectElemAll = formElem.querySelectorAll('.form-select');

	for (let i = 0; i < formSelectElemAll.length; i++) {
		const element = formSelectElemAll[i];
		const formSelectBtnElem = element.querySelector('.form-select-btn');
		const errorElem = element.querySelector('.error');
		const { validationErrorMsg } = formSelectBtnElem.dataset;

		if (!formSelectBtnElem) return;

		formSelectBtnElem.classList[errorElem ? 'add' : 'remove']('error');

		if (errorElem) {
			const errorTextElem = document.createElement('span');
			errorTextElem.className = 'form-error';
			errorTextElem.textContent = validationErrorMsg || '';
			element.insertBefore(errorTextElem, element.firstChild);
			element._errorTextElem = errorTextElem;
		} else if (element._errorTextElem) {
			element._errorTextElem.remove();
		}
	}
}

/**
 * Валидация формы
 * @param {Element} formThis 
 */
function validate(formThis) {
	$.validate({
		form: formThis,
		language: 'ru',
		validateHiddenInputs: true,
		scrollToTopOnError: false,
		borderColorOnError: '',

		// обработка ошибки валидации
		onError: () => {
			// скролл к элементу с ошибкой 
			const errorElem = $(formThis.find('.has-error').first())[0];
			scrollToElem(errorElem);
			highlightFormSelect(formThis[0]);
		},

		// обработка успешной валидации
		onSuccess: () => {
			highlightFormSelect(formThis[0]);
			sendAjax(formThis);
			return false;
		}
	});
}

/**
 * Инициалия
 */
function init() {
	_state.validateElemAll = $('.js-validate');

	if (_state.validateElemAll.length) {
		_state.validateElemAll.each(function() { validate($(this)); });
	}

	FormSelect.init();
	FormFile.init();
}

export default {
	init
};


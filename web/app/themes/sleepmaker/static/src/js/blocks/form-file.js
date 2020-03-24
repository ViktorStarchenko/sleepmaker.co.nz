import { _qs, _qsa } from '../helpers/cache';
import validator from 'jquery-form-validator/form-validator/jquery.form-validator.min.js';
import 'jquery-form-validator/form-validator/file';

/**
 * Кастомизация input[type='file']
 */

/**
 * Форматирование размера файлов в сокращённый вариант
 * @param {Number} length размер файла в байтах
 * @returns {String} например 123 Кб
 * @example
 * const size = document.querySelector('[input=file]').files.item(0).size; // 123123123
 * formatSize(size); // 123.12 Мб
 */
function formatSize(length) {
	var i = 0,
		type = ['б', 'Кб', 'Мб', 'Гб', 'Тб', 'Пб'];
	while ((length / 1000 | 0) && i < type.length - 1) {
		length /= 1024;
		i++;
	}
	return length.toFixed(2) + ' ' + type[i];
}


/**
 * Показать список файлов
 * @param {Element} elem input[type='file']
 * @example
 * <div class="form-file-list">
 *   <div class="form-file-list__item">
 *     <span class="form-file-list__name">file_name</span>
 *     <span class="form-file-list__size">30МБ</span>
 *     <button class="form-file-list__close">✕</button>
 *   </div>
 * </div>
 */
function showname(inputFileElem) {
	const wrapper = inputFileElem.closest('.form-file');
	const list = wrapper.querySelector('.form-file-list');

	if (!wrapper && !list) {
		console.warn('Error on inputFiles(): cant\'t find element');
		return;
	}

	let files = inputFileElem.files;
	let layout = '';

	for (const key in files) {
		if (files.hasOwnProperty(key)) {
			const file = files[key];
			layout += `<div class="form-file-list__item" data-file-index="${key}">
					<button class="form-file-list__close"></button>
					<span class="form-file-list__name">${file.name}</span>
					<span class="form-file-list__size">${formatSize(file.size)}</span>
					</div>`;
		}
	}

	list.innerHTML = layout;
};

/**
 * Обрабочики событий
 */
function events() {
	const formFileElemAll = _qsa('.form-file');

	for (let i = 0; i < formFileElemAll.length; i++) {
		const containerElem = formFileElemAll[i];
		const inputFileElem = containerElem.querySelector('input[type=file]');
		const formElem = containerElem.closest('form');
		const listElem = containerElem.querySelector('.form-file-list');

		if (inputFileElem) {
			inputFileElem.addEventListener('change', () => {
				showname(inputFileElem);
				if (inputFileElem.files.length > 0) {
					containerElem.classList.add('is-added');
				} else {
					containerElem.classList.remove('is-added');
				}
				// повторная валидация
				$(inputFileElem).validate();
			});
		} else {
			console.error('inputFiles(): can\'t find input[type=file]');
		}

		if (formElem) {
			formElem.addEventListener('reset', () => {
				const fileListElem = formElem.querySelector('.form-file-list');
				fileListElem.innerHTML = '';
			});
		} else {
			console.error('inputFiles(): can\'t find form');
		}

		if (listElem) {
			listElem.addEventListener('click', (e) => {
				let t = e.target;
				if (t.closest('.form-file-list__close')) {
					let currentItem = t.closest('.form-file-list__item');

					currentItem.remove();
					inputFileElem.value = '';

					// повторная валидация
					$(inputFileElem).validate();
				}
			});
		} else {
			console.error('inputFiles(): can\'t find class="form-file-list"');
		}
	}
}

export default {
	init() {
		events();
	}
};

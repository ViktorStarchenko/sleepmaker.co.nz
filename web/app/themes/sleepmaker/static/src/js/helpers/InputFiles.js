import { _qs, _qsa } from '../tools/cache';
import validator from 'jquery-form-validator/form-validator/jquery.form-validator.min.js';

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
 * Кастомизация input[type='file']
 */
function InputFiles() {
	const MODULE = {};

	/**
	 * Показать список файлов
	 * @param {Element} elem input[type='file']
	 * @example
	 * <div class="form-file-list">
	 *   <div class="form-file-list__item">
	 *     <span class="form-file-list__item-name">file_name</span>
	 *     <span class="form-file-list__item-size">30МБ</span>
	 *     <button class="form-file-list__item-close">✕</button>
	 *   </div>
	 * </div>
	 */

	function showname(inputFile) {
		const wrapper = inputFile.closest('.form-file');
		const list = wrapper.querySelector('.form-file-list');

		if (!wrapper && !list) {
			console.warn('Error on inputFiles(): cant\'t find element');
			return;
		}

		let files = inputFile.files;
		let layout = '';

		for (const key in files) {
			if (files.hasOwnProperty(key)) {
				const file = files[key];
				layout += `<div class="form-file-list__item" data-file-index="${key}">
				<span class="form-file-list__item-name">${file.name}</span>
				<span class="form-file-list__item-size">${formatSize(file.size)}</span>
				<button class="form-file-list__item-close">✕</button>
				</div>`;
			}
		}

		list.innerHTML = layout;
	};

	MODULE.init = () => {
		const jsFormFileAll = _qsa('.js-form-file');

		for (let i = 0; i < jsFormFileAll.length; i++) {
			const container = jsFormFileAll[i];
			const inputFile = container.querySelector('input[type=file]');
			const form = container.closest('form');
			const list = container.querySelector('.form-file-list');

			if (inputFile) {
				inputFile.addEventListener('change', () => {
					showname(inputFile);
					// повторная валидация
					$(inputFile).validate();
				});
			} else {
				console.warn('inputFiles(): can\'t find input[type=file]');
			}

			if (form) {
				form.addEventListener('reset', () => {
					const fileListElem = form.querySelector('.form-file-list');
					fileListElem.innerHTML = '';
				});
			} else {
				console.warn('inputFiles(): can\'t find form');
			}

			list.addEventListener('click', (e) => {
				let t = e.target;
				if (t.closest('.form-file-list__item-close')) {
					let currentItem = t.closest('.form-file-list__item');

					currentItem.remove();
					inputFile.value = '';

					// повторная валидация
					$(inputFile).validate();
				}
			});
		}

	};

	return MODULE;
}

export default InputFiles();

/**
 * Управление кастомными селектами
 * @example
 * // пример разметки
 * <div class="form-select form-select--close">
 *    <div class="form-select__title">
 * <span class="text">Multi *</span>
 * </div>
 *    <button class="form-select-btn" type="button" value="Opton 1">
 *        <span class="text">Opton 1</span>
 *    </button>
 *    <div class="form-select__dropdown">
 *        <ul class="form-select-list">
 *            <li class="form-select-list__item">
 *                <label class="form-select-list__label">
 *                    <input class="form-select-list__input" type="checkbox" name="select" value="value" checked="checked">
 *                    <span class="form-select-list__text">
 *                        <span class="text">Opton 1</span>
 *                    </span>
 *                </label>
 *            </li>
 *        </ul>
 *     </div>
 *    <div class="form-select__footer">
 *        <button class="button">
 *            <span class="text">Применить</span>
 *        </button>
 *    </div>
 * </div>
 */

const _state = {
	body: null,
	forms: null,
	currentBtnElem: null,
	formSelectElemAll: null
};

/**
 * Сброс значенй по умолчанью по событию reset формы
 */
function addResetEvents() {
	if (_state.forms.length) {
		for (let i = 0; i < _state.forms.length; i++) {
			const element = _state.forms[i];

			element.addEventListener('reset', (e) => {
				let formElem = e.target;
				const formSelectElemAll = formElem.querySelectorAll('.form-select');

				for (let i = 0; i < formSelectElemAll.length; i++) {
					const element = formSelectElemAll[i];
					setBtnValue(element);
				}
			});
		}
	}
}

/**
 * Установка значения селекту
 * @param {Element} currentElem 
 */
function setBtnValue(currentElem) {
	setTimeout(() => {
		const checkedElemAll = currentElem.querySelectorAll('input:checked');
		const currentBtnElem = currentElem.querySelector('.form-select-btn');
		if (!currentBtnElem && !checkedElemAll.length) return;

		let quantity = checkedElemAll.length;

		if (quantity === 1) {
			const value = checkedElemAll[0].nextElementSibling.textContent;
			currentBtnElem.innerHTML = `<span class="text">${value}</span>`;
			currentBtnElem.classList.remove('is-placeholder');
		} else if (quantity > 1) {
			currentBtnElem.innerHTML = `<span class="text">Выбрано: ${quantity}</span>`;
			currentBtnElem.classList.remove('is-placeholder');
		} else {
			currentBtnElem.innerHTML = `<span class="text">${currentBtnElem.dataset.placeholder}</span>`;
			currentBtnElem.classList.add('is-placeholder');
		}

		$(currentBtnElem).validate();
	}, 10);
}

/**
 * Сброс всех опций селекта
 * @param {Element} currentElem 
 */
function resetOptions(currentElem) {
	const inputElemAll = currentElem.querySelectorAll('.form-select-list input');
	for (let i = 0; i < inputElemAll.length; i++) {
		const element = inputElemAll[i];
		element.checked = element.defaultChecked;
	}
}

/**
 * Свернуть все селекты
 * @param {Element} currentElem
 */
function closeAll(currentElem) {
	let selectOpenedElements = document.querySelectorAll('.form-select');
	for (let i = 0; i < selectOpenedElements.length; i++) {
		const element = selectOpenedElements[i];
		if (element !== currentElem) {
			element.classList.add('is-close');
		}
	}
}

/**
 * Открытие\закрытие селекта
 * @param {Element} currentElem 
 */
function openToggle(currentElem) {
	const listElem = currentElem.querySelector('.form-select-list');
	let isClose = currentElem.classList.contains('is-close');

	if (isClose) {
		currentElem.classList.remove('is-hidden');
		requestAnimationFrame(() => {
			currentElem.classList.remove('is-close');
		});
	} else {
		requestAnimationFrame(() => {
			currentElem.classList.add('is-close');
		});
		setTimeout(function() {
			currentElem.classList.add('is-hidden');
			listElem.scrollTop = 0;
		}, 500);
	}
}

/**
 * Добавление обоабочика на click
 */
function addClickEvents() {
	_state.body.addEventListener('click', (e) => {
		let t = e.target;

		while (t && t !== _state.body) {
			// для предотвращения двойного клика
			// пары label > input
			// возвращаем return
			if (t.matches('.form-select label')) {
				return;
			}

			// открытие опций
			if (t.matches('.form-select-btn')) {
				const currentElem = t.closest('.form-select');
				openToggle(currentElem);
				_state.currentBtnElem = t;
				closeAll(currentElem);
				return;
			}
			
			if (t.matches('.form-select-list__text')) {
				const currentElem = t.closest('.form-select');
				const checkboxElem = currentElem.querySelector('input[type="checkbox"]');
				const radioElem = currentElem.querySelector('input[type="radio"]');
				setBtnValue(currentElem);
				if (radioElem) closeAll();
				return;
			}
			
			if (t.matches('.form-select__reset')) {
				const currentElem = t.closest('.form-select');
				resetOptions(currentElem);
				setBtnValue(currentElem);
				return;
			}

			if (t.matches('.form-select__accept')) {
				const currentElem = t.closest('.form-select');
				openToggle(currentElem);
				return;
			}

			if (t) t = t.parentElement;
		}
		
		closeAll();
	});
}

export default {
	init() {
		if (_state.isInit) return;

		Object.assign(_state, {
			body: document.body,
			forms: document.forms,
			formSelectElemAll: document.querySelectorAll('.form-select')
		});

		addClickEvents();
		addResetEvents();

		for (let i = 0; i < _state.formSelectElemAll.length; i++) {
			const element = _state.formSelectElemAll[i];
			setBtnValue(element, true);
		}

		_state.isInit = true;
	}
};

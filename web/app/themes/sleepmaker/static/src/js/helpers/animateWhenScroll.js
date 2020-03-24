import getCoords from './getCoords';

// нужно дработать

export default function animateWhenScroll() {
	const animateElements = document.querySelectorAll('.animate');
	const elementsList = {};
	const cbProps = {};
	const animateInSightEvent = new CustomEvent('animateInSight', { detail: cbProps });

	if (!animateElements.length) {
		return;
	}

	for (let i = 0; i < animateElements.length; i++) {
		const element = animateElements[i];
		let top = element.getBoundingClientRect().top + pageYOffset;
		let scrlTop = window.pageYOffset || document.documentElement.scrollTop;

		// добавляем элемент в список
		if (!elementsList[top]) {
			elementsList[top] = [];
		}
		elementsList[top].push(element);

		// всем элементам добавляется класс начального состояния анимации
		element.classList.add('animate--from');

		// если элемент при загрузке страницы находится в поле видимости
		if (scrlTop < +top && scrlTop + document.documentElement.clientHeight > +top) {
			// добавляем класс конечного состояния
			element.classList.add('animate--to');
		}
	}

	cbProps.elements = elementsList;

	window.addEventListener('scroll', () => {
		let scrlTop = window.pageYOffset || document.documentElement.scrollTop;
		requestAnimationFrame(() => {
			// проверяем, есть ли элемент попадающий в область видимости окна браузера
			for (const key in elementsList) {
				if (elementsList.hasOwnProperty(key)) {
					// если верхняя часть элемента появилась в область видимости
					// ищем совпадения из списка элементв объекта elementsList
					if (scrlTop < +key && scrlTop + document.documentElement.clientHeight > +key) {
						const elementArr = elementsList[key];
						elementArr.forEach(element => {
							if (!element) {
								console.warn('Error in animateWhenScroll: can\'t find target element');
								return;
							}
							cbProps.elementActive = element;
							element.classList.add('animate--to');
							// генерация кастомного события появления
							if (elementsList[key].event !== true) {
								element.dispatchEvent(animateInSightEvent);
								elementsList[key].event = true;
								// console.log(scrlTop, +key, document.documentElement.clientHeight);
							}
						});
					}
				}
			}
		});
	});
}

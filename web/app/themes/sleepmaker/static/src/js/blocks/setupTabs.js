import {hideStart, hideElement, showElement} from './toggleElVisible';
export default function setupTabs() {
	if (document.querySelectorAll('.js-tabs-wrapper').length) {
		// search all tabs wrappers on the page
		const tabsWrappers = document.querySelectorAll('.js-tabs-wrapper');

		tabsWrappers.forEach((wrapper) => {
			const data = wrapper.dataset.tabs;
			const triggers = data ? wrapper.querySelectorAll(`.js-tab-trigger[data-tabs="${data}"]`) : wrapper.querySelectorAll('.js-tab-trigger');
			const tabContents = data ? wrapper.querySelectorAll(`.js-tab-content[data-tabs="${data}"]`) : wrapper.querySelectorAll('.js-tab-content');
			let currentTrigger = data ? wrapper.querySelector(`.js-tab-trigger.active[data-tabs="${data}"]`) : wrapper.querySelector('.js-tab-trigger.active');
			let currentTriggerHash;

			if(currentTrigger) {
				// hide all contents besides active
				currentTriggerHash = currentTrigger.hash.slice(1);
				tabContents.forEach((content) => {
					currentTrigger.parentNode.classList.toggle('active');
					content.style.opacity = '1';
					content.style.transform = 'none';
					if (content.id !== currentTriggerHash) {
						hideStart(content);
					}
				});
			} else {
				currentTrigger = triggers[0];
				// hide all contents besides the first one
				tabContents.forEach((content, index) => {
					if (index === 0) {
						content.classList.toggle('active');
						triggers[0].classList.toggle('active');
						triggers[0].parentNode.classList.toggle('active');
					} else {
						hideStart(content);
					}
				});
			}

			let current = currentTrigger;
			triggers.forEach((trigger) => {
				trigger.addEventListener('click', (e) => {
					e.preventDefault();
					if(!trigger.classList.contains('active')) {
						current.classList.remove('active');
						current.parentElement.classList.remove('active');
						trigger.classList.add('active');
						trigger.parentElement.classList.add('active');
						tabContents.forEach((content) => {
							if (content.id !== trigger.hash.slice(1)) {
								hideElement(content);
								content.classList.remove('active');
							} else {
								showElement(content);
								content.classList.add('active');
							}
						});
						current = trigger;
					}
				});
			});
		});
	}
}


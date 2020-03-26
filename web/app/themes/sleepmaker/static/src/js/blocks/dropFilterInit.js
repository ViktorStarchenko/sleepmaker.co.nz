export default function dropFilterInit() {
	let dropFilters = document.querySelectorAll('.js-drop-filter');
	if(dropFilters.length) {
		dropFilters.forEach(item => {
			let defaultValue = item.querySelector('[data-select]').dataset.select;
			let selected = item.querySelector('.js-drop-filter-selected');
			let openTrigger = item.querySelector('.js-drop-filter-trigger');
			let selectItem = item.querySelectorAll('.js-drop-filter-item');
			let selectedArr = [];

			//open filter
			openTrigger.addEventListener('click', () => {
				if(!item.classList.contains('active')) {
					dropFilters.forEach(removeClass => {
						removeClass.classList.remove('active');
					});
					item.classList.add('active');
				} else {
					item.classList.remove('active');
				}
			});

			// selected element -> change text 
			selectItem.forEach(sItem => {
				let box = sItem.querySelector('input');
				let label = sItem.querySelector('label');
				
				if(box.checked) {
					selectedArr.push(label.innerText);
					selected.innerText = selectedArr.join(', ');

					if(selectedArr.length) {
						item.classList.add('selected');
					}
				}

				//select
				box.addEventListener('change', () => {
					if(box.checked) {
						selectedArr.push(label.innerText);
						selected.innerText = selectedArr.join(', ');

						if(selectedArr.length) {
							item.classList.add('selected');
						}
					} else {
						selectedArr.remove(label.innerText);
						selected.innerText = selectedArr.join(', ');

						if(!selectedArr.length) {
							item.classList.remove('selected');
							selected.innerText = defaultValue;
						}
					}
				});
			});

			//missclick -> close filter
			document.addEventListener('click', (e) => {
				if(e.target.closest('.js-drop-filter') === item) {
					return;
				} else {
					item.classList.remove('active');
					return;
				}
			});
		});
	}
}

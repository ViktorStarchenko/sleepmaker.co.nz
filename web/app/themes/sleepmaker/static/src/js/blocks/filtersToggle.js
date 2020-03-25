export default function filtersToggle() {
	let filtersTitles = document.querySelectorAll('.js-filter-title');
	let mql = window.matchMedia('(max-width: 768px)').matches;
	if(filtersTitles.length) {
		filtersTitles.forEach(titles => {
			let filterParent = titles.closest('.filters');
			let filterContent = filterParent.querySelector('.js-filter-content');

			titles.addEventListener('click', () => {
				if(window.matchMedia('(max-width: 768px)').matches) {
					if(titles.classList.contains('is-visible')) {
						titles.classList.remove('is-visible');
						$(filterContent).slideUp();
					} else {
						titles.classList.add('is-visible');
						$(filterContent).slideDown();
					}
				} else {
					return false;
				}
			});
		});
	}
}

import smoothscroll from 'smoothscroll-polyfill';

export default function scrollTo() {
	if(document.querySelectorAll('.js-scroll-to').length) {

		smoothscroll.polyfill();
	
		document.querySelectorAll('.js-scroll-to').forEach(item => {
			item.addEventListener('click',(e) => {
				try {
					item.blur();
				} catch (error) {}
				e.preventDefault();
				let targetel = item.getAttribute('href');
				let target = document.querySelector(targetel);
				let timeDelay = 0;
				
				setTimeout(function() {
					let offs = offset(target);
					window.scroll({
						top: offs - (window.matchMedia('(max-width: 768px)').matches ? '80' : '150'),
						behavior: 'smooth'
					});
				}, timeDelay);
			});
		});
	}

}

function offset(el) {
	var rect = el.getBoundingClientRect(),
		scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
		scrollTop = window.pageYOffset || document.documentElement.scrollTop;
	return rect.top + scrollTop;
}

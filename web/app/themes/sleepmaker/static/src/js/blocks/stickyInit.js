import Sticky from 'sticky-js';

export default function stickyInit() {

	if(document.querySelectorAll('.js-sticky').length) {
		let stickElem = new Sticky('.js-sticky');
	}
    

}

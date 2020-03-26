export default function setupAccordion() {

	if($('.js-acc').length) {
		let accordion = $('.js-acc');
		accordion.each(function() {
			let that = $(this);
			let trigg = that.find('.js-acc-trig');
			let targ = that.find('.js-acc-targ');
			let parentsLi = that.find('li');
			//   setTimeout(() => {
			//     that.find('li:eq(0) .js-acc-trig').addClass('active').next().slideDown();
			//   }, 200);
			trigg.click(function(e) {
				e.preventDefault();
				let _t = $(this);
				let parent = _t.closest('li');
				let dropDown = parent.find('.js-acc-targ');
				targ.not(dropDown).slideUp();

				if (_t.hasClass('active')) {
					dropDown.removeClass('active');
					_t.removeClass('active');
					parent.removeClass('active');
				} else {
					trigg.removeClass('active');
					targ.removeClass('active');
					parentsLi.removeClass('active');
					_t.addClass('active');
					parent.addClass('active');
					setTimeout(() => {
						dropDown.addClass('active');
					}, 50);
				}
				dropDown.stop(false, true).slideToggle();
			});
		});
	}
}

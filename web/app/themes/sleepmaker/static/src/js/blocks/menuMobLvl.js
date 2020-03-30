export default function menuMobLvl() {

	let lvlTrig = document.querySelectorAll('.js-menu-lvl-trig');
	let lvlTarg = document.querySelectorAll('.js-menu-lvl-targ');
	
	if(lvlTrig.length && lvlTarg.length) {
	    
	    // let lvlTrigArr = Array.from(lvlTrig);
	    let lvlTargArr = Array.from(lvlTarg);
	    
		lvlTrig.forEach(item => {
			item.addEventListener('click', () => {
				let trigData = item.dataset.trigLvl;
				
				lvlTargArr.filter(item => {
				
				    if(item.dataset.targLvl === trigData) {
				    
				        let itemPatent = item.closest('.menu-mob__body');
				        
				        itemPatent.classList.add('lvl-active');
				        setTimeout(() => {
							item.classList.add('is-visible');
							item.classList.add('is-z');
				        }, 200);
					}
					if(item.classList.contains('is-visible')) {
						item.classList.add('next-visible');
					}
				});
			});
		});
		
		let lvlCloseBtns = document.querySelectorAll('.js-menu-lvl-close');
		
		lvlCloseBtns.forEach((closeBtn) => {
		    closeBtn.addEventListener('click', () => {

				let btnPatent = closeBtn.closest('.menu-mob__body');
				let nextVisible = btnPatent.querySelector('.next-visible');

				let visibleLvl = closeBtn.closest('.js-menu-lvl-targ');

				visibleLvl.classList.remove('is-visible');
				setTimeout(() => {
					visibleLvl.classList.remove('is-z');
					if(nextVisible) {
						nextVisible.classList.remove('next-visible');
					}
				}, 250);
		        
				if(closeBtn.classList.contains('lvl-begin')) {
					setTimeout(() => {
						btnPatent.classList.remove('lvl-active');
					}, 200);
				}
		    });
		});
		
	}
}

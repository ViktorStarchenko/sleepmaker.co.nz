import Swiper from 'swiper';
import mobile from '../helpers/mobileDetect';
import debounce from '../helpers/debounce';
export default function slidersInit() {
	//home page secret card
	let homeCategorySliderParent = document.querySelector('.home-category-slider');
	if(homeCategorySliderParent) {
		let homeCategorySlider = homeCategorySliderParent.querySelector('.js-home-category-slider');
		let homeCategorySLiderNext = homeCategorySliderParent.querySelector('.js-home-category-next');
		let homeCategorySLiderPrev= homeCategorySliderParent.querySelector('.js-home-category-prev');

		let homeCategorySliderInit;
		let homeCategoryInit = false;

		function homeCategoryCheck() {

			if(window.matchMedia('(min-width:651px)').matches && !homeCategoryInit) {
				homeCategorySliderInit = new Swiper(homeCategorySlider,{
					watchOverflow: true,
					slidesPerView: 'auto',
					navigation: {
						nextEl: homeCategorySLiderNext,
						prevEl: homeCategorySLiderPrev,
					},
					on:{
						init: () => {
							homeCategoryInit = true;
						},
						destroy: () => {
							homeCategoryInit = false;
						}
					}
				});
			}
		} homeCategoryCheck();

		window.addEventListener('resize', debounce(() => {
			if(window.matchMedia('(max-width:650px)').matches && homeCategoryInit) {
				homeCategorySliderInit.destroy(true, false);
			} else {
				homeCategoryCheck();
			}
		}, 100));
	}

	let blogCardSliderParent = document.querySelector('.blog-card-slider');
	if(blogCardSliderParent) {
		let blogCardSlider = blogCardSliderParent.querySelector('.js-blog-card-slider');
		let paginationBlog = blogCardSliderParent.querySelector('.js-blog-card-slider-pagination');
		let blogCardSliderInit = new Swiper(blogCardSlider,{
			watchOverflow: true,
			slidesPerView : 'auto',
			pagination: {
				el: paginationBlog,
				type: 'bullets',
			},
		});
	}

	let articeCardSliderParent = document.querySelector('.article-card-slider');
	if(articeCardSliderParent) {
		let articeCardSlider = articeCardSliderParent.querySelector('.js-article-card-slider');
		let paginationArticle= articeCardSliderParent.querySelector('.js-article-card-slider-pagination');
		let articeCardSliderInit = new Swiper(articeCardSlider,{
			watchOverflow: true,
			slidesPerView : 'auto',
			pagination: {
				el: paginationArticle,
				type: 'bullets',
			},
		});
	}
	
	let technologiesSlider = document.querySelector('.js-technologies-slider');
	if(technologiesSlider) {
		let technologiesSlides = technologiesSlider.querySelectorAll('.swiper-slide');
		let technologiesSliderInit = new Swiper(technologiesSlider,{
			slidesPerView : 'auto',
			on: {
				init() {
					setTimeout(() => {
						console.log(technologiesSliderInit.slides[0]);
						technologiesSliderInit.slides[0].classList.add('swiper-slide-selected');
					}, 50);
				},
				reachEnd() {
					technologiesSlider.classList.add('is-end');
				},
				slideChangeTransitionStart() {
					if(technologiesSliderInit.isEnd) {
						technologiesSlider.classList.add('is-end');
					} else {
						technologiesSlider.classList.remove('is-end');
					}
				},
				click() {
					let activeClickSlide = technologiesSliderInit.clickedIndex;
					
					technologiesSlides.forEach((slide) => {
						slide.classList.remove('swiper-slide-selected');
					});
					technologiesSliderInit.slides[activeClickSlide].classList.add('swiper-slide-selected');
					setTimeout(() => {
						technologiesSliderInit.slideTo(activeClickSlide);
					}, 300);

				}

			}

		});
	}

	let rowSLider = document.querySelectorAll('.js-row-slider');
	if(rowSLider.length) {
		rowSLider.forEach(rowSLiderItem => {
			let rowSliderInit = new Swiper(rowSLiderItem, {
				slidesPerView: 'auto',
				on: {
					click() {
						let activeClick = rowSliderInit.clickedIndex;
						rowSliderInit.slideTo(activeClick);
					}
				}
			});
		});
	}
}

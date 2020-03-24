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
				console.log('kkkkkkk');
				homeCategorySliderInit = new Swiper(homeCategorySlider,{
					watchOverflow: true,
					slidesPerView: 'auto',
					navigation: {
						nextEl: homeCategorySLiderNext,
						prevEl: homeCategorySLiderPrev,
					},
					on:{
						init: () => {
							console.log('init');
							homeCategoryInit = true;
						},
						destroy: () => {
							console.log('destroy');
							homeCategoryInit = false;
						}
					}
				});
			}
		} homeCategoryCheck();

		window.addEventListener('resize', debounce(() => {
			if(window.matchMedia('(max-width:650px)').matches && homeCategoryInit) {
				console.log('aajaja');
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
	
}

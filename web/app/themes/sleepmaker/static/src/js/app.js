'use strict';

// Libs
import './lib/polyfills/index';

// Helpers
import './helpers/removeArrayItem.js';

// BEM blocks
// import Modal from './blocks/modal';
// import MenuMobile from './blocks/menu-mob';
// import Form from './blocks/form';
import slidersInit from './blocks/slidersInit';
import filtersToggle from './blocks/filtersToggle';
import setupAccordion from './blocks/setupAccordion';
import dropFilterInit from './blocks/dropFilterInit';
import setupTabs from './blocks/setupTabs';
import './blocks/toggleSpecialOffers';
// Init
// AppRoot.init();
// Modal.init();
// MenuMobile.init();
// Form.init();

window.addEventListener('load', () => {
	// ...
	slidersInit();
	filtersToggle();
	setupAccordion();
	dropFilterInit();
	setupTabs();

	window.toggleSpecialOffers();
});

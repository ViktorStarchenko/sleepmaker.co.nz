function theMouseWheel(e) {
	e.preventDefault();
}

export default function diasbleScroll(isDisabled) {
	window[isDisabled ?
		'addEventListener' :
		'removeEventListener'
	]('wheel', theMouseWheel, {
		passive: false
	});
};

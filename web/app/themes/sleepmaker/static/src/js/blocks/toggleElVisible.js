function hideStart(el) {
	el.style.display = 'none';
	el.style.opacity = '0';
	el.style.transform = 'translateY(10px)';
}
function hideElement(el) {
	el.style.opacity = '0';
	el.style.transform = 'translateY(10px)';
	setTimeout(() => {
		el.style.display = 'none';
	}, 300);
}
function showElement(el) {
	setTimeout(() => {
		el.style.display = '';
	}, 300);
	setTimeout(() => {
		el.style.opacity = '1';
		el.style.transform = 'none';
	}, 320);
}

export {hideStart, hideElement, showElement};

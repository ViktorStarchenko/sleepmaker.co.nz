/**
 * Расстояние до элемента от начала документа
 * @param {Element} elem
 * @returns {{ top: Number, left: Number }}
 */
export default function getCoords(elem) {
	if (!elem) {
		console.warn('Error in getCoords(elem): cant\'t find elem\nSomething may not work correctly');
		return 0;
	}
	var box = elem.getBoundingClientRect();
	return {
		top: box.top + pageYOffset,
		left: box.left + pageXOffset,
		right: box.left + pageXOffset + elem.clientWidth,
		bottom: box.top + pageYOffset + elem.clientHeight
	};
}

// Element.matches();
(function(el) {
	el.matches || (el.matches = el.matchesSelector || function(selector) {
		var matches = document.querySelectorAll(selector),
			th = this;
		return Array.prototype.some.call(matches, function(el) {
			return el === th;
		});
	});
})(Element.prototype);

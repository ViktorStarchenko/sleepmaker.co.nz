import {
	_qs,
	_qsa,
	cache
} from '../helpers/cache';

function isNode(o) {
	return (
		typeof Node === 'object' ? o instanceof Node :
			o && typeof o === 'object' && typeof o.nodeType === 'number' && typeof o.nodeName === 'string'
	);
}

function isElement(o) {
	return (
		typeof HTMLElement === 'object' ? o instanceof HTMLElement : //DOM2
			o && typeof o === 'object' && o !== null && o.nodeType === 1 && typeof o.nodeName === 'string'
	);
}

export default function bitrixPanelHeight(val = 0) {
	const bitrixPanel = _qs('#my-panel');
	return (isElement(bitrixPanel)) ? bitrixPanel.offsetHeight + val : 0;
}

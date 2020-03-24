/**
 * XMLHttpRexuest
 * 
 * @param {string} url 
 * @param {string} type 
 * @param {object} callback
 * 
 * @example
 * xhr('../data/file.json', 'json', function() {
 *     // do somthing
 * })
 */
export default function xhr(url, type, callback) {
	var xhr = new XMLHttpRequest();

	xhr.open('GET', url);
	xhr.responseType = type;
	xhr.send();
	xhr.onload = function() {
		if (callback) {
			callback(xhr.response);
		}
	};
}

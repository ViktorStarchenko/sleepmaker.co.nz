class Constantas {
	constructor() {
		this.list = {};
		this.props = {};
	}

	/**
	 * Парсинг констант
	 * @param {Element} node Элемент содержащий константы
	 * @param {Object} obj Днанные типа ключ и занчение
	 * @param {RegExp} regExp Регулярное выражение
	 * 
	 * @example
	 * // init
	 * const constants = new Constants;
	 * // first parse
	 * constants.parse(document.body, ua, /%lang ([^%]+?)%/i);
	 * // change values
	 */
	parse(node, obj, regExp) {
		this.props = {
			node,
			obj,
			regExp
		};

		const nodes = node.getElementsByTagName('*');

		let replaceText = (textNode) => {
			let constName = textNode.data.match(regExp);

			if (constName === null) {
				return;
			}

			if (constName[1] in obj) {
				textNode.data = obj[constName[1]];

				if (!this.list[constName[1]]) {
					this.list[constName[1]] = [];
				}
				this.list[constName[1]].push(textNode);

			} else {
				// console.warn("Константа не найдена:", textNode.data);
			}
		};

		if (node.firstChild && node.firstChild.nodeType === 3) {
			replaceText(node.firstChild);
		}

		for (var i = 0; i < nodes.length; i++) {
			if (nodes[i].firstChild && nodes[i]
				.firstChild.nodeType === 3) {
				replaceText(nodes[i].firstChild);
			}
		}
	}

	setData(obj) {
		for (let key in obj) {
			if (this.list[key] && this.list[key][0].data) {
				this.list[key].forEach(element => {
					element.data = obj[key];
				});
			}
		}
	}
}

export default Constantas;

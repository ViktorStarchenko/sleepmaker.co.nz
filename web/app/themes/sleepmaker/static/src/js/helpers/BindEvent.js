export default class BindEvent {
	static listeners = {};
	
	/**
	 * Подписка на событие пользовательского интерфейса.
	 * @param {string} evName имя События
	 * @param {callback} cb каллбэк фукция
	 */
	static add(eventName, cb) {
		if (!BindEvent.listeners[eventName]) {
			BindEvent.listeners[eventName] = [];
		}
		if (BindEvent.listeners[eventName]) {
			BindEvent.listeners[eventName].push(cb);
			// console.log("UI Events:",'"' + eventName + '"', "is adeded");
		}
	}
	
	/**
	 * Отправка события пользовательского интерфейса
	 * @param {string} evName имя события
	 * @param {any} data данные в любом виде
	 */
	static dispatch(eventName, data) {
		if (BindEvent.listeners[eventName]) {
			BindEvent.listeners[eventName].forEach(function(item) {
				item(data);
			});
		}
	}
	
	/**
	 * Удаление подписки на событие пользовательского интерфейса
	 * @param {string} evName имя События
	 * @param {function} fu фунуция (которая использывалась при подписке)
	 */
	static remove(eventName, fu) {
		if (BindEvent.listeners[eventName]) {
			BindEvent.listeners[eventName].forEach(function(item, i) {
				if (item === fu) {
					delete BindEvent.listeners[eventName][i];
					// console.log("UI Events:", '"' + eventName + '"', "is deleted");
				}
			});
		}
	}
}

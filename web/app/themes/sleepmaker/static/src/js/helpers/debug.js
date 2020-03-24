export default class Debug {
	/**
	 * Проверка на соответсвие имени хоста
	 * @param { ...String } arguments - добавление доверенных хостов
	 * @returns boolean
	 */
	static isLocal() {
		if (!location && !location.hostname) return;

		const hostName = location.hostname;
		let locals = ['localhost', '192.168', 'herokuapp', 'github', '127.0.0'];
		let concatArr = locals.concat([].slice.call(arguments));

		return concatArr.some(elem => {
			let isFind = (hostName + '').indexOf(elem) !== -1;

			if (isFind && !window['_isDebug']) {
				console.log('%c --- DEBUG MODE ---', 'background: #222; color: #99ff55; font-size: 1rem');
				window._isDebug = true;
			}

			return isFind;
		});
	};
}

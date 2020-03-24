/**
 * Свайпы тачпада
 */
export default class WheelSwipe {
	_lastVal = 100;
	_timer = null;
	_permission = true;
	_props = {
		wheelPrevent: false
	};

	/**
	 * @param {Function} cb 
	 * @param {Object} props 
	 * @param {Boolean} props.wheelPrevent 
	 */
	constructor(cb, props) {
		Object.assign(this._props, props);

		window.addEventListener('wheel', (e) => {
			if (this._props.wheelPrevent) {
				e.preventDefault();
			}

			let deltaAbs = Math.abs(e.deltaY);
			
			// console.log(deltaAbs);

			if (deltaAbs >= this._lastVal && deltaAbs > 50 ) {
				if (this._permission) {
					cb((e.deltaY > 0) ? 'down' : 'up');
					this._permission = false;
				}
				clearTimeout(this._timer);
				this._timer = setTimeout(() => {
					this._permission = true;
				}, 100);
			}

			this._lastVal = Math.abs(e.deltaY);
		}, {
			passive: !this._props.wheelPrevent
		});
	}
};

export default function videoInit() {
	let videoBtns = document.querySelectorAll('.js-video-button');
	if(videoBtns.length) {
		videoBtns.forEach((btn) => {
			let btnParent = btn.closest('.video');
			let videoPlayer = btnParent.querySelector('video');
			btn.addEventListener('click', () => {
				videoPlayer.setAttribute('controls', 'true');
				videoPlayer.play();
				btn.style.display = 'none';
			});
		});
	}
}


document.addEventListener('DOMContentLoaded', () => {
	const botones = document.querySelectorAll('[data-role = button]'),
		tabsInfo = document.querySelectorAll('[data-role = tab-info]'),
		//	imagPal = document.querySelector('#img-ppal'),
		imagPal = document.querySelector('#img-div'),
		imagenes = document.querySelectorAll('[data-role = img-slider]'),
		fondo = document.querySelector('[data-role = fondo]'),
		modal = document.querySelector('[data-role="modal-image"]'),
		closeModal = modal.querySelector('#closeModal'),
		imgModal = modal.querySelector('img')
	
	const actores = [closeModal, fondo, imagPal]
	
	getImgFondo = (imagen) => {
		const backgroundImage = window.getComputedStyle(imagen).backgroundImage;
		return backgroundImage.replace(/url\(["']?(.*?)["']?\)/, '$1');
	}
	
	modalAction = () => {
		modal.classList.toggle('-z-10')
		modal.classList.toggle('opacity-0')
		modal.classList.toggle('z-11')
		modal.classList.toggle('opacity-100')
		imgModal.src = getImgFondo(imagPal)
		imagPal.style.backgroundImage = 'url(' + getImgFondo(imagPal) + ')';
	}
	
	actores.forEach(actor => {
		actor.addEventListener('click', (event) => {
			if (actor === fondo && event.target.dataset.role === 'fondo')
				modalAction()
			else if (actor !== fondo)
				modalAction()
		})
	})
	
	actionText = () => {
		tabsInfo.forEach(tab => {
			if (tab.classList.contains('mostrado')) {
				tab.classList.remove('mostrado')
				let spans = tab.querySelectorAll('h3')
				let svgs = tab.querySelectorAll('svg')
				spans.forEach(span => span.classList.toggle('text-indigo-600'))
				svgs.forEach(svg => svg.classList.toggle('hidden'))
			}
		})
	}
	botones.forEach(function (boton) {
		boton.addEventListener('click', function (boton, index) {
			if (!this.parentElement.classList.contains('mostrado'))
				actionText()
			let spans = this.querySelectorAll('h3')
			let svgs = this.querySelectorAll('svg')
			spans.forEach(span => span.classList.toggle('text-indigo-600'))
			svgs.forEach(svg => svg.classList.toggle('hidden'))
			this.parentElement.classList.toggle('mostrado')
		})
	})
	
	function clickClassImg(imgTumb) {
		imagenes.forEach((imag) => {
			elem = imag.parentElement.previousElementSibling
			if (elem)
				elem.classList.add('ring-transparent')
		})
		const srcPal = getImgFondo(imagPal)
		const srcTumb = imgTumb.src
		imgTumb.src = srcPal
		imagPal.style.backgroundImage = 'url(' + srcTumb + ')';
	}
	
	imagenes.forEach(img => {
		img.addEventListener('click', function () {
			clickClassImg(img)
		})
	})
})

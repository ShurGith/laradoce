document.addEventListener('DOMContentLoaded', () => {
	const botones = document.querySelectorAll('[data-role = button]'),
		tabsInfo = document.querySelectorAll('[data-role = tab-info]'),
		imagPal = document.querySelector('#img-ppal'),
		imagenes = document.querySelectorAll('[data-role = img-slider]'),
		fondo = document.querySelector('[data-role = fondo]'),
		modal = document.querySelector('[data-role="modal-image"]'),
		closeModal = modal.querySelector('#closeModal'),
		imgModal = modal.querySelector('img')
	
	const actores = [closeModal, fondo, imagPal]
	
	modalAction = () => {
		modal.classList.toggle('-z-10')
		modal.classList.toggle('opacity-0')
		modal.classList.toggle('z-11')
		modal.classList.toggle('opacity-100')
		imgModal.src = imagPal.src
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
	
	function clickClassImg(img) {
		imagenes.forEach((imag) => {
			elem = imag.parentElement.previousElementSibling
			if (elem)
				elem.classList.add('ring-transparent')
		})
		const srcTumb = img.src
		const srcPal = imagPal.src
		imagPal.src = srcTumb
		img.src = srcPal
	}
	
	imagenes.forEach(img => {
		img.addEventListener('click', function () {
			clickClassImg(img)
		})
	})
})

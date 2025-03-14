document.addEventListener('DOMContentLoaded', () => {
	const btnsFav = document.querySelectorAll('[data-tipo=heart-button]'),
		divFavorites = document.getElementById("div-favorites"),
		flashMenssage = document.getElementById('flashMessage'),
		btnFlash = flashMenssage.querySelector('button'),
		// flashUnic = document.getElementById('favorite-unic'),
		contador = document.querySelector(".contador"),
		url = window.location.href.includes('/products/')
	
	const containsString = (obj, str) => {
		return Object.values(obj).some(value => typeof value === 'string' && value.includes(str));
	};
	
	if (btnFlash !== null) {
		btnFlash.addEventListener('click', () => {
			quitaFlash();
		});
	}
	
	quitaFlash = () => {
		flashMenssage.firstElementChild.classList.add('translate-x-full');
	};
	
	muestraFlash = () => {
		flashMenssage.firstElementChild.classList.remove('translate-x-full')
		setTimeout(quitaFlash, 3000)
	}
	toggleA = (elemento) => {
		elemento.classList.toggle('text-green-500')
		tipText = elemento.querySelectorAll('[data-tipo=tip-text]')
		for (t of tipText)
			t.classList.toggle('hidden')
	}
	
	if (!url)
		setTimeout(muestraFlash, 300);
	
	btnsFav.forEach((btnFav) => {
		btnFav.addEventListener("click", function () {
			productId = this.getAttribute("data-id"),
				toggleA(this)
			fetch(`/favorites/toggle/${productId}`, {
				method: "POST", headers: {
					"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
					"Content-Type": "application/json"
				}
			})
				.then(response => response.json())
				.then(data => {
					if (containsString(data.favorites, productId)) {
						contador.innerText = (+contador.innerText) + 1
						if (url) {
							document.querySelector('.fav-show-add').classList.remove('hidden')
							document.querySelector('.fav-show-remove').classList.add('hidden')
							muestraFlash()
						}
						
					} else {
						contador.innerText = (+contador.innerText) - 1
						if (url) {
							document.querySelector('.fav-show-remove').classList.remove('hidden')
							document.querySelector('.fav-show-add').classList.add('hidden')
							muestraFlash()
						}
					}
					if (contador.innerText === "0") {
						divFavorites.classList.add('hidden');
					} else {
						divFavorites.classList.remove('hidden');
					}
				});
		});
	})
});

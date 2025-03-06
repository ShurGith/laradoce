document.addEventListener('DOMContentLoaded', () => {
	const menu = document.getElementById('mainmenu');
	const btnAction = document.getElementById('user-menu-button');
	const imagmenu = document.getElementById('imag-menu');
	OperaMenu = function () {
		menu.classList.toggle('opacity-0');
		menu.classList.toggle('scale-95');
	}
	if (btnAction !== null) {
		btnAction.addEventListener('click', () => {
			OperaMenu();
		})
		document.addEventListener('click', (evento) => {
			if (evento.target !== imagmenu)
				if (!menu.classList.contains('opacity-0'))
					OperaMenu();
		})
		document.addEventListener('keydown', (evento) => {
			const keyCode = evento.key;
			if (!menu.classList.contains('opacity-0') && keyCode === 'Escape') nrb
			OperaMenu();
		})
	}
})
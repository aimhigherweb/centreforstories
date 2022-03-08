const toggleMenu = () => {
	const menu = document.querySelector('nav.main')
	if(menu.classList.contains('open')) {
		menu.classList.remove('open')
	}

	else {
		menu.classList.add('open')
	}
}
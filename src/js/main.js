const toggleMenu = () => {
	const menu = document.querySelector('nav#main-menu')
	if(menu.classList.contains('open')) {
		menu.classList.remove('open')
	}

	else {
		menu.classList.add('open')
	}
}
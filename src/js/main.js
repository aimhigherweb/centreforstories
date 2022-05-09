const toggleMenu = () => {
	const menu = document.querySelector('nav#main-menu')
	if(menu.classList.contains('open')) {
		menu.classList.remove('open')
	}

	else {
		menu.classList.add('open')
	}
}

const expandRepeatingEvents = (eventId, feedClass) => {
	const event = document.querySelector(`#${eventId}`)
	const feed = document.querySelector(`.${feedClass}`)

	if(event.classList.contains('open')) {
		event.classList.remove('open')
		feed.classList.remove('expanded')
	}
	else {
		event.classList.add('open')
		feed.classList.add('expanded')
	}
}
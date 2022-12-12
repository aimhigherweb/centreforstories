const toggleNav = (menuSelector) => {
	const menu = document.querySelector(menuSelector)
	if (menu.classList.contains('open')) {
		menu.classList.remove('open')
	}

	else {
		menu.classList.add('open')
	}
}

const toggleMenu = () => {
	toggleNav('nav#main-menu')
}

const toggleLessonSidebar = () => {
	toggleNav('nav#lesson_sidebar')
}



const expandRepeatingEvents = (eventId, feedClass) => {
	const event = document.querySelector(`#${eventId}`)
	const feed = document.querySelector(`.${feedClass}`)

	if (event.classList.contains('open')) {
		event.classList.remove('open')
		feed.classList.remove('expanded')

		setTimeout(function () {
			feed.querySelectorAll('li[class*="events_feed-module__event').forEach((e) => {
				if (e !== event) {
					e.style.height = null
				}
			})
		}, 5000);


	}
	else {
		feed.querySelectorAll('li[class*="events_feed-module__event').forEach((e) => {
			if (e !== event) {
				e.style.height = `${e.offsetHeight}px`
			}
		})

		event.classList.add('open')
		feed.classList.add('expanded')
	}
}

const trigger = (popup) => {
	console.log('triggered')
	console.log({ classes: popup.classList })
	if (popup.classList.contains('open')) {
		popup.classList.remove('open')
	}
	else {
		popup.classList.add('open')
	}

	window.localStorage.setItem('popupNotice', Date.parse(new Date()));

	console.log({ popup })

	return
}

const togglePopup = (popupID) => {
	const popup = document.querySelector(`#${popupID}`)

	if (!popup) return;

	if (popup.classList.contains('open')) {
		trigger(popup)

		return
	}

	const prevView = window.localStorage.getItem('popupNotice')

	console.log({ popup, prevView })


	if (!prevView) {
		console.log(`Haven't viewed the popup before`)
		trigger(popup)
		return
	}
	else if ((prevView + 2592000000) < Date.parse(new Date())) { //Previous date plus 30 days
		console.log(`Popup has changed`)
		trigger(popup)
		return
	}

	console.log({ popup })

	return
}

window.onload = () => {
	togglePopup('popup')
}
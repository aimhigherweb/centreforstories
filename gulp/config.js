const browserSync = require('browser-sync')

module.exports = {
	themeFolders: [
		'functions',
		'src',
		'blocks',
		'layouts',
		'partials',
		'acf',
		'parts'
	],
	themeFiles: [
		'./*.php',
		'./*.css',
		'./screenshot.png',
	],
	phpFiles: [
		'./*.php',
		'./**/*.php',
	],
	sourceMaps: '/src/maps',
	cssFiles: '.',
	compileFiles: [
		'src/scss/style.scss', 
		'src/scss/editor.scss',
		'partials/**/*.scss',
		'layouts/**/*.scss',
		'blocks/**/*.scss',
		'parts/**/*.scss',
	],
	sassPartials: [
		'src/scss/**/*.scss',
		'partials/**/*.scss',
		'layouts/**/*.scss',
		'blocks/**/*.scss',
		'parts/**/*.scss',
	],
	browserSync: browserSync.create(),
}
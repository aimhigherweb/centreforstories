require('dotenv').config()

const {watch, series} = require('gulp')

const {build, bundle} = require('./gulp/build')
const {compileSass} = require('./gulp/scss')
const { sassPartials, phpFiles, browserSync} = require('./gulp/config')

const serve = () => {
	browserSync.init({
		port: process.env.PORT || 3000,
		proxy: process.env.WP_URL,
		notify: false,
		injectChanges: true,
		open: false,
	})

	watch(sassPartials, series(compileSass))
	watch(phpFiles).on('change', browserSync.reload)
}

exports.build = build
exports.bundle = bundle
exports.default = series(compileSass, serve)

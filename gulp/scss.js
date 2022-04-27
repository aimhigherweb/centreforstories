require('dotenv').config()

const {src, dest} = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const postcss = require('gulp-postcss')
const gulpIf = require('gulp-if')
const header = require('gulp-header')
const map = require('vinyl-map')

const {compileFiles, cssFiles, browserSync} = require('./config')

const themeFiles = [
	'mixins',
	'animations',
	'defaults',
	'variables'
]

const checkFiles = (path) => themeFiles.some((file) => (
	path.match(RegExp(`${file}\\.scss`, 'i')) ||
	path.match(RegExp(`${file}(\\/|\\\\)`, 'i'))
))


const compileSass = async () => (
	src(compileFiles)
		.pipe(
			header(
				`@use 'sass:list';\n@use 'sass:map';\n@use 'sass:math';\n`
			)
		)
		.pipe(
			gulpIf(
				({path}) => (!checkFiles(path)), 
				header(`@use 'variables' as var;\n@use 'mixins';\n`)
			)
		)
		.pipe(
			postcss()
		)
		.pipe(
			sass({
				outputStyle: process.env.NODE_ENV !== 'production' ? 'expanded' : 'compressed',
				includePaths: [
					'src/scss',
				]
			}).on('error', sass.logError)
		)
		.pipe(
			dest(({path, base}) => {
				if(path.match(/\/src\/scss/)) {
					return cssFiles
				}
				return base
			})
		)
		.pipe(
			gulpIf(
				process.env.NODE_ENV !== 'production', 
				browserSync.stream()
			)
		)
)

module.exports = {
	compileSass
}
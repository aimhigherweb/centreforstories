require('dotenv').config()

const {src, dest, watch, task, series} = require('gulp')
const sass = require('gulp-dart-sass')
const sourcemaps = require('gulp-sourcemaps')
const browserSync = require('browser-sync').create()
const stylelint = require('gulp-stylelint')
const zip = require('gulp-zip')
const replace = require('gulp-replace')

//File Paths
const sassPartials = 'src/scss/**/*.scss'
const compileFiles = ['src/scss/style.scss', 'src/scss/editor.scss']
const cssFiles = '.'
const sourceMaps = '/src/maps'
const themeFiles = [
	'./*.php',
	'./**/*.php',
]
const buildFiles = [
	'./*.php',
	'./*.css',
	'./screenshot.png',
]
const buildFolders = [
	'functions',
	'src',
	'blocks',
	'layouts',
	'partials',
	'acf',
	'parts'
]

task('sass', () => {
	return src(compileFiles)
		.pipe(stylelint({
			failAfterError: false,
			reportOutputDir: false,
			fix: true,
			reporters: [
				{
					formatter: 'verbose',
					console: true
				}
			]
		}))
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(sourcemaps.write(sourceMaps))
		.pipe(dest(cssFiles))
		.pipe(browserSync.stream())
})

task('serve', () => {
	browserSync.init({
		port: process.env.PORT || 3000,
		proxy: process.env.WP_URL,
		notify: false,
		injectChanges: true,
		open: false,
	})

	watch(sassPartials, series('sass'))
	watch(themeFiles).on('change', browserSync.reload)
})

task('buildSass', () => {
	return src(compileFiles)
		.pipe(stylelint({
			failAfterError: false,
			reportOutputDir: false,
			fix: true,
			reporters: [
				{
					formatter: 'verbose',
					console: true
				}
			]
		}))
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(sourcemaps.write(sourceMaps))
		.pipe(dest(cssFiles))
})

task('buildFiles', () => {
	buildFolders.forEach((file, i) => {
		src(`${file}/**`, {
				allowEmpty: true,
			})
			.pipe(dest(`./dist/${file}`))
	})

	return src(buildFiles, {
			allowEmpty: true,
		})
		.pipe(dest('./dist'))

})

task('zip' , () => {
	src('./dist/partials/layout.php')
		.pipe(replace('/style.css', `/style.css?v${new Date().valueOf()}`))
		.pipe(replace(`<?php get_template_part('partials/dev-styles'); ?>`, ''))
		.pipe(dest('./dist/partials/'))
	return src('./dist/**')
		.pipe(zip(`${process.env.THEME_NAME}.zip`))
		.pipe(dest('.'))
})

task('build', series('buildSass', 'buildFiles','zip'))

task('default', series('serve'))
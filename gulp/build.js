require('dotenv').config()

const {src, dest, series} = require('gulp')
const bump = require('gulp-bump')
const zip = require('gulp-zip')
const replace = require('gulp-replace')

const {compileSass} = require('./scss')
const {themeFolders, themeFiles} = require('./config')

const buildFiles = (callback) => {
	themeFolders.forEach((file, i) => {
		src(`${file}/**`, {
				allowEmpty: true,
			})
			.pipe(dest(`./dist/${file}`))
	})

	return src(themeFiles, {
		allowEmpty: true,
	})
		.pipe(dest('./dist'))
}

const incrementVersion = (callback) => (
	src('./package.json')
		.pipe(bump({type: 'patch'}))
		.pipe(dest('./'))
)

const setVersion = (callback) => (
	src('./package.json')
	.pipe(replace(/"version": "(?<version>(?:\d+\.?){3})",/, (match) => {
		const version = match.match(/"version": "(?<version>(?:\d+\.?){3})",/)?.groups?.version

		src('./dist/partials/layout.php')
			.pipe(replace('/style.css', `/style.css?v${version}`))
			.pipe(replace(`<?php get_template_part('partials/dev-styles'); ?>`, ''))
			.pipe(dest('./dist/partials/'))
	}))
)

const zipTheme = () => (
	src('./dist/**')
		.pipe(zip(`${process.env.THEME_NAME}.zip`))
		.pipe(dest('.'))
)

const build = series(compileSass, buildFiles)
const bundle = series(build, incrementVersion, setVersion, zipTheme)

module.exports = {
	build,
	bundle
}
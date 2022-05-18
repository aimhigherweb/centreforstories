require('dotenv').config()

const {src, dest, series} = require('gulp')
const bump = require('gulp-bump')
const zip = require('gulp-zip')
const replace = require('gulp-replace')

const {compileSass} = require('./scss')
const {themeFolders, themeFiles} = require('./config')

const buildFolders = () => {
	const folders = themeFolders.map(folder => `${folder}/**/*`)

	return (
		src(
			folders, 
			{
				allowEmpty: true,
				base: '.'
			}
		)
		.pipe(dest(`./dist/`))
	)
}

const buildFiles = () => (
	src(themeFiles, {
		allowEmpty: true,
	})
		.pipe(dest('./dist'))
)



const incrementVersion = () => (
	src('./package.json')
		.pipe(bump({type: 'patch'}))
		.pipe(dest('./'))
)

const setVersion = () => (
	src('./package.json')
	.pipe(replace(/"version": "(?<version>(?:\d+\.?){3})",/, (match) => {
		const version = match.match(/"version": "(?<version>(?:\d+\.?){3})",/)?.groups?.version

		src('./dist/partials/layout/index.php')
			.pipe(replace('/style.css', `/style.css?v${version}`))
			.pipe(replace(`<?php get_template_part('partials/dev-styles/index'); ?>`, ''))
			.pipe(dest('./dist/partials/'))
	}))
)

const setEnv = () => (
	src('./dist/**/**/*.php')
		.pipe(replace(`'env' => 'dev'`, `'env' => 'production'`))
		.pipe(dest('./dist/'))
)

const zipTheme = () => (
	src('./dist/**')
		.pipe(zip(`${process.env.THEME_NAME}.zip`))
		.pipe(dest('.'))
)

// const build = series(compileSass, buildFolders, buildFiles, incrementVersion, setVersion, setEnv)

const build = series(compileSass, buildFolders, buildFiles, incrementVersion, setVersion, setEnv)

const bundle = series(build, zipTheme)

module.exports = {
	build,
	bundle
}
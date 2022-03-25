require('dotenv').config()

const {src, dest} = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const sourcemaps = require('gulp-sourcemaps')
const postcss = require('gulp-postcss')
const gulpIf = require('gulp-if')

const {compileFiles, sourceMaps, cssFiles, browserSync} = require('./config')

const compileSass = () => (
	src(compileFiles)
		.pipe(postcss())
		.pipe(sourcemaps.init())
		.pipe(sass({
				outputStyle: process.env.NODE_ENV !== 'production' ? 'expanded' : 'compressed'
			}).on('error', sass.logError))
		.pipe(sourcemaps.write(sourceMaps))
		.pipe(dest(cssFiles))
		.pipe(gulpIf(process.env.NODE_ENV !== 'production', browserSync.stream()))
)

module.exports = {
	compileSass
}
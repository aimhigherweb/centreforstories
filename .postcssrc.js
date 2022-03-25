const stylelint = require("stylelint");
const rgb = require('postcss-rgb')
const autoprefixer = require('autoprefixer')
const gapProperties = require('postcss-gap-properties')

const autoprefixOptions = {
	grid: false,
	supports: false,
	flexbox: false,
	remove: true
}

module.exports = ({env}) => ({
	syntax: 'postcss-scss',
	map: false,
	plugins: [
		stylelint({
			failAfterError: false,
			reportOutputDir: false,
			fix: true,
			customSyntax: 'scss',
			reporters: [
				{
					formatter: 'verbose',
					console: true
				}
			]
		}),
		rgb(),
		env === 'production' ? autoprefixer({...autoprefixOptions, env}) : false,
		env === 'production' ? gapProperties({preserve: true}) : false
	]
})
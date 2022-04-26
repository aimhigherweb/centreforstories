const stylelint = require("stylelint");
const rgb = require('postcss-rgb')
const autoprefixer = require('autoprefixer')
const gapProperties = require('postcss-gap-properties')
const modules = require('postcss-modules')

const autoprefixOptions = {
	grid: false,
	supports: false,
	flexbox: false,
	remove: true
}

module.exports = ({env}) => ({
	syntax: 'postcss-scss',
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
		modules({
			generateScopedName : '[name]__[local]___[hash:base64:5]',
		}),
		env === 'production' ? autoprefixer({...autoprefixOptions, env}) : false,
		env === 'production' ? gapProperties({preserve: true}) : false
	]
})
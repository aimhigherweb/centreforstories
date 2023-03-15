module.exports = {
	plugins: [
		'stylelint-scss',
		'stylelint-order'
	],
	extends: [
		'stylelint-config-standard',
		'stylelint-config-standard-scss',
		'stylelint-config-property-sort-order-smacss'
	],
	rules: {
		'order/order': [
			'custom-properties',
			'declarations'
		],
		'comment-empty-line-before': 'always',
		'rule-empty-line-before': [
			'always',
			{
				except: ['first-nested']
			}
		],
		'length-zero-no-unit': true,
		'color-hex-length': 'long',
		'color-no-invalid-hex': true,
		'selector-max-attribute': 3,
		'declaration-no-important': true,
		'shorthand-property-no-redundant-values': true,
		'number-max-precision': 3,
		'function-url-no-scheme-relative': true,
		'color-named': 'never',
		'no-invalid-double-slash-comments': true,
		'no-duplicate-selectors': true,
		'no-duplicate-at-import-rules': true,
		'comment-no-empty': true,
		'selector-type-no-unknown': true,
		'selector-pseudo-element-no-unknown': true,
		'selector-pseudo-class-no-unknown': [
			true,
			{
				ignorePseudoClasses: [
					'global'
				]
			}
		],
		'block-no-empty': true,
		'declaration-block-no-shorthand-property-overrides': true,
		'declaration-block-no-duplicate-properties': [true, { ignore: ["consecutive-duplicates"] }],
		'property-no-unknown': [
			true,
			{
				ignoreProperties: [
					'composes',
					'font-named-instance'
				]
			}
		],
		'unit-no-unknown': true,
		'string-no-newline': true,
		'function-calc-no-unspaced-operator': true,
		'no-descending-specificity': null,
		"selector-class-pattern": null,
		'no-invalid-position-at-import-rule': null,
		'custom-property-pattern': null,
		'scss/dollar-variable-pattern': null,
		'import-notation': null,
	}
}

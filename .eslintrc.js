module.exports = {
  root: true,
  env: {
    browser: true,
    node: true
  },
  parser: 'vue-eslint-parser',
  parserOptions: {
    parser: 'babel-eslint'
  },
  extends: [
    // https://github.com/vuejs/eslint-plugin-vue#priority-a-essential-error-prevention
    // consider switching to `plugin:vue/strongly-recommended` or `plugin:vue/recommended` for stricter rules.
    'plugin:vue/essential'
  ],
  // required to lint *.vue files
  plugins: [
    'vue'
  ],
  // add your custom rules here
  rules: {
    yoda: [
      'warn'
    ],
    semi: [
      'warn',
      'always'
    ],
    eqeqeq: [
      'warn',
      'always'
    ],
    quotes: [
      'warn',
      'single'
    ],
    'no-var': [
      'warn'
    ],
    // indent: ['warn', 2],
    // 'func-names': ['warn', 'as-needed'],
    // 'func-style': ['warn', 'declaration'],
    'comma-style': [
      'warn',
      'last'
    ],
    'quote-props': [
      'warn',
      'as-needed',
      {
        numbers: true
      }
    ],
    'brace-style': [
      'warn',
      '1tbs'
    ],
    'key-spacing': [
      'warn',
      {
        beforeColon: false,
        afterColon: true
      }
    ],
    'prefer-const': [
      'warn'
    ],
    'semi-spacing': [
      'warn',
      {
        after: true,
        before: false
      }
    ],
    'arrow-spacing': [
      'warn',
      {
        after: true,
        before: true
      }
    ],
    'comma-spacing': [
      'warn',
      {
        after: true
      }
    ],
    'padded-blocks': [
      'warn',
      'never'
    ],
    'block-spacing': [
      'warn',
      'always'
    ],
    'no-new-object': [
      'warn'
    ],
    'no-extra-semi': [
      'warn'
    ],
    'no-unreachable': [
      'warn'
    ],
    'no-const-assign': [
      'warn'
    ],
    'prefer-template': [
      'warn'
    ],
    'no-multi-spaces': [
      'warn'
    ],
    'keyword-spacing': [
      'warn',
      {
        after: true,
        before: true
      }
    ],
    'space-in-parens': [
      'warn',
      'never'
    ],
    'space-infix-ops': [
      'warn'
    ],
    'object-shorthand': [
      'warn'
    ],
    'no-sparse-arrays': [
      'warn'
    ],
    'func-call-spacing': [
      'warn',
      'never'
    ],
    'no-trailing-spaces': 'warn',
    'space-before-blocks': [
      'warn',
      'always'
    ],
    'object-curly-spacing': [
      'warn',
      'never'
    ],
    'template-tag-spacing': [
      'warn',
      'never'
    ],
    'switch-colon-spacing': [
      'warn',
      {
        after: true,
        before: false
      }
    ],
    'no-array-constructor': [
      'warn'
    ],
    'prefer-arrow-callback': [
      'warn'
    ],
    'array-bracket-spacing': [
      'warn',
      'never'
    ],
    'array-callback-return': [
      'warn'
    ],
    'no-multiple-empty-lines': [
      'warn',
      {
        max: 2
      }
    ],
    'computed-property-spacing': [
      'warn',
      'never'
    ],
    'space-before-function-paren': [
      'warn',
      'never'
    ],
    'no-whitespace-before-property': [
      'warn'
    ],
    'nonblock-statement-body-position': [
      'warn',
      'below'
    ],
    // VUE

    'vue/eqeqeq': [
      'warn',
      'always'
    ],
    'vue/v-on-style': [
      'warn'
    ],
    'vue/key-spacing': [
      'warn',
      {
        beforeColon: false,
        afterColon: true
      }
    ],
    'vue/html-quotes': [
      'warn',
      'double'
    ],
    'vue/brace-style': [
      'warn',
      '1tbs'
    ],
    'vue/v-bind-style': [
      'warn'
    ],
    'vue/block-spacing': [
      'warn',
      'always'
    ],
    'vue/arrow-spacing': [
      'warn',
      {
        after: true,
        before: true
      }
    ],
    'vue/no-unused-vars': [
      'warn'
    ],
    'vue/use-v-on-exact': [
      'warn'
    ],
    'vue/keyword-spacing': [
      'warn',
      {
        after: true,
        before: true
      }
    ],
    'vue/space-unary-ops': [
      'warn'
    ],
    'vue/no-multi-spaces': [
      'warn'
    ],
    'vue/space-infix-ops': [
      'warn'
    ],
    'vue/attributes-order': [
      'warn'
    ],
    'vue/this-in-template': [
      'warn',
      'never'
    ],
    'vue/v-on-function-call': [
      'warn',
      'never'
    ],
    'vue/order-in-components': [
      'warn',
      {
        order: [
          'el',
          'name',
          'head',
          'data',
          'props',
          'propsData',
          'model',
          'watch',
          'parent',
          'render',
          'layout',
          'mixins',
          'extends',
          'fetch',
          'apollo',
          'asyncData',
          'LIFECYCLE_HOOKS',
          'methods',
          'filters',
          'comments',
          'computed',
          'template',
          'functional',
          'directives',
          'middleware',
          'components',
          'validations',
          'renderError',
          'inheritAttrs'
        ]
      }
    ],
    'vue/object-curly-spacing': [
      'warn',
      'never'
    ],
    'vue/no-unused-components': [
      'warn'
    ],
    'vue/require-direct-export': [
      'warn'
    ],
    'vue/array-bracket-spacing': [
      'warn',
      'never'
    ],
    'vue/return-in-computed-property': [
      'off'
    ],
    'vue/mustache-interpolation-spacing': [
      'warn',
      'always'
    ],
    'vue/no-spaces-around-equal-signs-in-attribute': [
      'warn'
    ]
  }
};

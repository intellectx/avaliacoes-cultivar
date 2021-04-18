const mix = require('laravel-mix');

mix.ts('frontend/app.js', 'public/js').react()
  .postCss('frontend/css/app.css', 'public/css', [
    require('postcss-import')
  ])
  .webpackConfig(require('./webpack.config'));

if (mix.inProduction()) {
  mix.version();
}

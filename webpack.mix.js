const mix = require('laravel-mix');
const path = require('path');

mix.alias({
  ziggy: path.resolve('vendor/tightenco/ziggy/dist'),
});

mix.ts('frontend/app.js', 'public/js').react()
  .postCss('frontend/css/app.css', 'public/css', [
    require('postcss-import')
  ])
  .webpackConfig(require('./webpack.config'));

if (mix.inProduction()) {
  mix.version();
}

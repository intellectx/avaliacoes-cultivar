const mix = require('laravel-mix');
const path = require('path');

mix.alias({
  ziggy: path.resolve('vendor/tightenco/ziggy/dist'),
});

mix.options({
  hmrOptions: {
    host: '0.0.0.0',
    port: '8080'
  }
})

mix.ts('frontend/app.js', 'public/js').react()
  .postCss('frontend/css/app.css', 'public/css', [
    require('postcss-import')
  ])
  .webpackConfig(require('./webpack.config'));

if (!mix.inProduction()) {
  mix.sourceMaps();
}

if (mix.inProduction()) {
  mix.version();
}

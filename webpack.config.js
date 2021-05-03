const path = require('path');

module.exports = {
  /*output: {
    chunkFilename: 'js/[name].js?hash=[chunkhash]',
  },*/
  resolve: {
    alias: {
      '@': path.resolve('frontend'),
    },
  },
};

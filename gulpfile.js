var gulp = require('gulp'),
  path = {
    source: 'app/Resources/front/src',
    scripts: 'app/Resources/front/src/**/*.js',
    html: ['web/index.html', 'app/Resources/front/src/**/*.html'],
    output:'web/',
    css: 'css/*.css',
    bundle: 'web/vendors/',
    appmodule: 'app/Resources/front/src/app'
  },
  bundleTask = require('./tasks/bundle')(path),
  watchTask = require('./tasks/watch')(path);

gulp.task('default', ['watch']);

var gulp = require('gulp'),
  path = {
    source: 'app/Resources/front/src',
    scripts: 'app/Resources/front/src/**/*.js',
    html: ['app/Resources/front/index.html', 'app/Resources/front/src/**/*.html'],
    output:'web/',
    css: 'app/Resources/front/css/*.css',
    bundle: 'web/vendors/',
    appmodule: 'app/Resources/front/src/app'
  };

require('./tasks/bundle')(path);
require('./tasks/watch')(path);

gulp.task('default', ['watch']);

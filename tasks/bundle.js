var gulp = require('gulp'),
  runSequence = require('run-sequence'),
  del = require('del'),
  exec = require('gulp-exec'),
  useref = require('gulp-useref'),
  preprocess = require('gulp-preprocess'),
  ngAnnotate = require('gulp-ng-annotate'),
  jspm = require('jspm'),
  NODE_ENV = process.env.NODE_ENV || 'production',
  path;

module.exports = function (_path_) {
  path = _path_;
};

gulp.task('clean-bundle', function (done) {
  del(['web/app.js*', 'web/components', 'web/config', 'web/css', 'web/fonts', 'web/vendors', 'web/pages', 'web/index.html'], done);
});

gulp.task('bundle-app', function () {
  console.log('jspm bundle-sfx ' + path.appmodule + ' ' + path.bundle + 'app.js');
  //return jspm.bundleSFX(path.appmodule, path.bundle + 'app.js')
  //  .then(exec.reporter())
  //  .catch(exec.reporter());
  return gulp.src(path.source+'/app.js')
    .pipe(exec('jspm bundle-sfx ' + path.appmodule + ' ' + path.bundle + 'app.js'))
    .pipe(exec.reporter());
});

gulp.task('bundle-systemjs', function () {
  return gulp.src(['config.js', 'jspm_packages/system.js*', 'jspm_packages/es6-module-loader.js*'])
    .pipe(gulp.dest(path.bundle));
});

gulp.task('bundle-css', function () {
  return gulp.src(path.css)
    .pipe(gulp.dest(path.bundle + 'css'));
});

gulp.task('bundle-fonts', function () {
  return gulp.src('jspm_packages/github/twbs/bootstrap@3.3.4/fonts/*')
    .pipe(gulp.dest(path.output+'fonts'));
});

gulp.task('bundle-templates', function () {
  return gulp.src(path.source + '/**/*.html')
    .pipe(gulp.dest(path.output));
});

gulp.task('bundle-index', function () {
  var assets = useref.assets();

  return gulp.src([path.source+ '/../index.html'])
    .pipe(preprocess({
      context: {
        NODE_ENV: 'production'
      }
    }))
    .pipe(assets)
    .pipe(assets.restore())
    .pipe(useref())
    .pipe(gulp.dest(path.output));
});

gulp.task('bundle-statics', function () {
  runSequence(['css', 'build-html'], ['bundle-templates', 'bundle-systemjs', 'bundle-index', 'bundle-fonts']);
});

gulp.task('bundle', function () {
  runSequence('clean-bundle', 'bundle-app', 'bundle-statics');
});

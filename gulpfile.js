const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const rename = require('gulp-rename');
const path = require('path');

const srcDir = './assets/src/css';
const distDir = './assets/dist/css';

gulp.task('scss', () => {
  return gulp
    .src(path.join(srcDir, '/**/index.scss'))
    .pipe(sass().on('error', sass.logError))
    .pipe(rename(path =>
    {
      path.basename = 'index'
      path.dirname = path.dirname.split( '\\css\\' )[1]
    }))
    .pipe(gulp.dest(distDir));
});

gulp.task('watch', () => gulp.watch(
  srcDir + '/**/*.scss',
  done => gulp.series(['scss'])(done)
))
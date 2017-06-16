'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass');
const uglify = require('gulp-uglify');
const concat = require('gulp-concat');
const minifyCSS = require('gulp-minify-css');
const autoprefixer = require('gulp-autoprefixer');
const rename = require('gulp-rename');
const babel = require('gulp-babel');


gulp.task('styles', function() {

  gulp.src(['styles/scss/normalize.scss', 'styles/scss/grid.scss', 'styles/scss/lighttv.scss'])
    .pipe(sass().on('error', sass.logError))
    .pipe(minifyCSS({ compatibility: 'ie8' }))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
    .pipe(concat('lighttv.min.css'))
    .pipe(gulp.dest('styles/min/'))
});

gulp.task('scripts', function() {
  gulp.src('js/theme.js')
    .pipe(babel({
      presets: ['es2015']
    }))
    // .pipe(uglify())
    .pipe(rename('theme.min.js'))
    .pipe(gulp.dest('js/min/'))
});

//Watch task
gulp.task('default', function() {
  gulp.watch('styles/scss/*.scss', ['styles']);
  gulp.watch('styles/scss/*/*.scss', ['styles']);
  gulp.watch('js/theme.js', ['scripts']);
});

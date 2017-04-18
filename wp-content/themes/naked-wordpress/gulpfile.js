'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var minifyCSS = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var rename = require('gulp-rename');


gulp.task('styles', function() {

  gulp.src(['styles/scss/reset.scss', 'styles/scss/grid.scss', 'styles/scss/lighttv.scss'])
    .pipe(sass().on('error', sass.logError))
    .pipe(minifyCSS({ compatibility: 'ie8' }))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
    .pipe(concat('lighttv.min.css'))
    .pipe(gulp.dest('styles/min/'))
});

gulp.task('scripts', function() {
  gulp.src('js/theme.js')
    .pipe(uglify())
    .pipe(rename('theme.min.js'))
    .pipe(gulp.dest('js/min/'))
});

//Watch task
gulp.task('default', function() {
  gulp.watch('styles/scss/*.scss', ['styles']);
  gulp.watch('styles/scss/*/*.scss', ['styles']);
  gulp.watch('js/theme.js', ['scripts']);
});

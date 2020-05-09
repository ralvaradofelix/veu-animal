const gulp = require('gulp')
const sass = require('gulp-sass')
const postcss = require('gulp-postcss')
const autoprefixer = require('autoprefixer')
const sourcemaps = require('gulp-sourcemaps')
const useref = require('gulp-useref')
const uglify = require('gulp-uglify')
const gulpIf = require('gulp-if')
const cssnano = require('gulp-cssnano')
const imagemin = require('gulp-imagemin')
const cache = require('gulp-cache')
const del = require('del')
const runSequence = require('run-sequence')

// Compiles sass into css
gulp.task('sass', () => {
   return gulp.src('src/scss/**/*.scss')
      .pipe(sourcemaps.init())
      .pipe(sass({
         outputStyle: 'compressed',
         includePaths: ['./bower_components', './node_modules']
      }).on('error', sass.logError))
      .pipe(postcss([ autoprefixer() ]))
      .pipe(sourcemaps.write())
      .pipe(gulp.dest('src/css'));
})

gulp.task('watch', ['sass'], () => {
  gulp.watch('src/scss/**/*.scss', ['sass']);
})

gulp.task('useref', () => {
   return gulp.src('src/**/*.php')
      .pipe(useref())
      // .pipe(gulpIf('*.js', uglify()))
      .pipe(gulpIf('*.css', cssnano({
         discardComments: {
            removeAll: true
         }
      })))
      .pipe(gulp.dest('dist'));
})

gulp.task('images', () => {
  return gulp.src('src/images/**/*.+(png|jpg|jpeg|gif|svg)')
    // .pipe(cache(imagemin({
    //   interlaced: true
    // })))
    .pipe(gulp.dest('dist/images'))
});

gulp.task('icons', function() {
   return gulp.src('bower_components/components-font-awesome/fonts/**.*')
      .pipe(gulp.dest('src/fonts'));
});

gulp.task('fonts', () => {
  return gulp.src('src/fonts/**/*')
    .pipe(gulp.dest('dist/fonts'))
})

gulp.task('clean', () => {
  return del.sync(['dist/**/*', '!dist/images', '!dist/images/**/*']);
})

gulp.task('default', ['watch'])

gulp.task('build', (callback) => {
  runSequence(
    'clean',
    'sass',
    ['useref', 'images', 'fonts'],
    callback
  )
})

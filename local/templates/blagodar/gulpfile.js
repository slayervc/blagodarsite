var gulp = require('gulp'),
	sass = require('gulp-sass'),
	sourcemaps = require('gulp-sourcemaps');


gulp.task('sass', () => {
	gulp.src('src/scss/main.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: 'compact'
		}))
		.pipe(sourcemaps.write('./maps'))
		.pipe(gulp.dest('./dist/css'));
});


gulp.task('sass:watch', () => {
	gulp.watch('./src/scss/**/*.scss', ['sass']);
});
























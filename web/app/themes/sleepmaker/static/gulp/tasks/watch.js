import gulp from 'gulp';

gulp.task('watch', [
	'copy:watch',
	'svgmin:watch',
	'svgo:watch',
	'pug:watch',
	'list-pages:watch',
	'webpack:watch',
	'sass:watch'
]);

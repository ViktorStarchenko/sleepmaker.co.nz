import gulp from 'gulp';
import runSequence from 'run-sequence';
import config from '../config';

const build = (cb, options) => {
	const {
		isProduction = false,
		isRevision = false
	} = options || {};

	config.setEnv(isProduction ? 'production' : 'development');

	const taskNames = ['clean', 'svgo', 'sass', 'pug', 'copy', 'webpack', 'list-pages'];

	if (isRevision) taskNames.push('revision');
	if (!isProduction) taskNames.push('watch', 'server');

	runSequence(...taskNames);

	cb();
};

gulp.task('default', (cb) => { build(cb); });
gulp.task('build', (cb) => { build(cb, { isProduction: true }); });
gulp.task('static', (cb) => { build(cb, { isProduction: true, isRevision: true }); });

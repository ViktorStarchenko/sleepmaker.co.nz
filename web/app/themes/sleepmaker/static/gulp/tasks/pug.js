import gulp from 'gulp';
import config from '../config';
import pug from 'gulp-pug';
import plumber from 'gulp-plumber';
import cache from 'gulp-cached';

gulp.task('pug', () => gulp
	.src([`${config.src.templates}/pages/**/[^_]*.pug`])
	.pipe(plumber({ errorHandler: config.errorHandler }))
	.pipe(pug({
		basedir: config.src.templates,
		pretty: !config.production ? '\t' : false
	}))
	.pipe(cache('pugging'))
	.pipe(gulp.dest(config.dest.html))
);

gulp.task('pug:watch', () => {
	gulp.watch([`${config.src.templates}/**/*.pug`], ['pug']);
});

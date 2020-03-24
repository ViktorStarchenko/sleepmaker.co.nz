import gulp from 'gulp';
import rev from 'gulp-rev';
import collect from 'gulp-rev-collector';
import runSequence from 'run-sequence';
import config from '../config.js';

gulp.task('rev', () => {
	let assets = [`${config.dest.js}/*.js`, `${config.dest.css}/*.css`];

	return gulp.src(assets, { base: config.dest.root })
		.pipe(rev())
		.pipe(gulp.dest(config.dest.root))
		.pipe(rev.manifest())
		.pipe(gulp.dest(config.dest.root));
});

gulp.task('rev-collect', () => {
	return gulp.src([`${config.dest.root}/rev-manifest.json`, `${config.dest.root}/*.html`])
		.pipe(collect())
		.pipe(gulp.dest(config.dest.root))
	;
});

gulp.task('revision', (cb) => { runSequence('rev', 'rev-collect'); cb(); });

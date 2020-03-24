import gulp from 'gulp';
import sass from 'gulp-sass';
import sourcemaps from 'gulp-sourcemaps';
import postcss from 'gulp-postcss';
import autoprefixer from 'autoprefixer';
import mqpacker from 'css-mqpacker';
import cssnano from 'cssnano';
import gulpIf from 'gulp-if';
import cssvariables from 'postcss-css-variables';
// import pxtorem from 'postcss-pxtorem';
import config from '../config';
import sortCSSmq from 'sort-css-media-queries';

const processors = [
	autoprefixer({
		cascade: false
	}),
	cssvariables({
		preserve: true
	}),
	// pxtorem({
	// 	rootValue: 16,
	// 	propList: ['*'],
	// 	mediaQuery: false,
	// 	minPixelValue: 1
	// }),
	mqpacker({
		sort: sortCSSmq.desktopFirst
	}),
	cssnano({
		minifyFontValues: false,
		discardUnused: false
	})
];

gulp.task('sass', () => {
	return gulp
		.src(`${config.src.sass}/*.{sass,scss}`)
		.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: config.production ? 'compact' : 'expanded', // nested, expanded, compact, compressed
			precision: 5
		}))
		.on('error', config.errorHandler)
		.pipe(postcss(processors))
		.pipe(gulpIf(!config.production, sourcemaps.write('./')))
		.pipe(gulp.dest(config.dest.css));
});

gulp.task('sass:watch', () => {
	gulp.watch(`${config.src.sass}/**/*.{sass,scss}`, ['sass']);
});

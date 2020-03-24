import gulp from  'gulp';
import gutil from  'gulp-util';
import ftp from  'vinyl-ftp';
import config from '../config';

var conn = ftp.create( {
	// host:     'mywebsite.tld',
	// user:     'me',
	// password: 'mypass',
	host: config.ftp.host,
	user: config.ftp.user,
	password: config.ftp.password,
	parallel: 1,
	log: gutil.log,
	port: config.ftp.port,
} );

var globs = [
	config.dest.css + '/**',
	config.dest.js + '/**',
];
 
gulp.task( 'upload-js', function() {
	return gulp.src( globs, { base: config.dest.js, buffer: false } )
		.pipe( conn.newer( '/local/templates/main/js' ) ) // only upload newer files
		.pipe( conn.dest( '/local/templates/main/js' ) );
 
} );

gulp.task( 'upload-css', function() {
	return gulp.src( globs, { base: config.dest.css, buffer: false } )
		.pipe( conn.newer( '/local/templates/main/css' ) ) // only upload newer files
		.pipe( conn.dest( '/local/templates/main/css' ) );
 
} );

gulp.task('upload-ftp',
	['upload-js',
		'upload-css',
	]);

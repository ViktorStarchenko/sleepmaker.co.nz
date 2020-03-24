import util from 'gulp-util';

const production = util.env.production || util.env.prod || false;
const destPath = 'build';

const config = {
	env: 'development',
	production: production,
	revision: util.env.revision || false,

	src: {
		root: 'src',
		data: 'src/data',
		templates: 'src/templates',
		templatesData: 'src/templates/data',
		pagelist: 'src/index.yaml',
		sass: 'src/sass',
		// path for sass files that will be generated automatically via some of tasks
		sassGen: 'src/sass/generated',
		js: 'src/js',
		img: 'src/img',
		svg: 'src/img/svg',
		svgSource: 'src/svg/source',
		svgMin: 'src/svg/min',
		icons: 'src/icons',
		// path to png sources for sprite:png task
		iconsPng: 'src/icons',
		// path to svg sources for sprite:svg task
		iconsSvg: 'src/icons',
		// path to svg sources for iconfont task
		iconsFont: 'src/icons',
		fonts: 'src/fonts',
		lib: 'src/lib'
	},

	dest: {
		root: destPath,
		data: destPath + '/data',
		html: destPath,
		css: destPath + '/css',
		js: destPath + '/js',
		img: destPath + '/img',
		fonts: destPath + '/fonts',
		lib: destPath + '/lib'
	},
	
	ftp: {
		host: 'ip',
		user: 'name',
		password: 'pass',
		port: 21 //port
	},

	setEnv(env) {
		if (typeof env !== 'string') return;
		this.env = env;
		this.production = (env === 'production');
		process.env.NODE_ENV = env;
		util.log('Environment:', util.colors.white.bgRed(' ' + env + ' '));
	},

	errorHandler: require('./util/handle-errors')
};

module.exports = config;

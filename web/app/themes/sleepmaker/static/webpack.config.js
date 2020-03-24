import webpack from 'webpack';
import path from 'path';
import config from './gulp/config';
import '@babel/polyfill';
import UglifyJsPlugin from 'uglifyjs-webpack-plugin';
import { BundleAnalyzerPlugin } from 'webpack-bundle-analyzer';

export default (env) => {
	let isProduction,
		webpackConfig;

	if (env === undefined) {
		env = process.env.NODE_ENV;
	}

	isProduction = env === 'production';

	webpackConfig = {
		context: path.join(__dirname, config.src.js),
		entry: {
			app: ['@babel/polyfill', './app.js']
		},
		output: {
			filename: '[name].js',
			path: path.join(__dirname, config.dest.js),
			publicPath: 'js/',
		},
		resolve: {
			extensions: ['.js'],
			modules: ['node_modules', path.join(__dirname, 'src')],
			alias: {
				'@': path.resolve(__dirname, 'src/js'),
				'@components': path.resolve(__dirname, 'src/js/components'),
				'@helpers': path.resolve(__dirname, 'src/js/helpers'),
				'@lib': path.resolve(__dirname, 'src/js/lib'),
				'@vue': path.resolve(__dirname, 'src/js/vue'),
			},
		},
		devtool: isProduction ? '#source-map' : '#cheap-module-eval-source-map',
		context: path.resolve(__dirname, 'src/js'),
		module: {
			rules: [
				{
					enforce: 'pre',
					test: /\.js$/,
					exclude: [
						path.resolve(__dirname, 'node_modules'),
					],
					loader: 'eslint-loader',
					options: {
						fix: true,
						cache: true,
						ignorePattern: __dirname + '/src/js/lib/'
					}
				}, {
					test: /\.js$/,
					loader: 'babel-loader',
					options: {
						cacheDirectory: true
					},
					exclude: /node_modules\/(?!(dom7|ssr-window|swiper)\/).*/,
				}],
		},
		plugins: [
			new webpack.LoaderOptionsPlugin({
				options: {
					eslint: {
						formatter: require('eslint-formatter-pretty')
					}
				}
			}),

			new webpack.ProvidePlugin({
				$: 'jquery',
				jquery: 'jquery',
				jQuery: 'jquery',
				'window.jquery': 'jquery',
				'window.jQuery': 'jquery'
			}),

			new webpack.NoEmitOnErrorsPlugin(),

			new BundleAnalyzerPlugin({
				analyzerMode: 'static',
				analyzerPort: 4000,
				openAnalyzer: false,
			}),
		],
	};

	if (isProduction) {
		webpackConfig.plugins.push(
			new webpack.LoaderOptionsPlugin({
				minimize: true,
			}),
			new webpack.optimize.ModuleConcatenationPlugin(),
			// new webpack.optimize.DedupePlugin(),
			new UglifyJsPlugin({
				uglifyOptions: {
					output: {
						comments: true
					}
				},
				extractComments: true
			})
		);
	}
	return webpackConfig;
};

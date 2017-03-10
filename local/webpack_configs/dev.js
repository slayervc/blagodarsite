var path = require('path');
module.exports = function(env, settings) {
	return {
		entry: settings.entry,

		devtool: 'cheap-module-source-map',

		resolve: settings.resolve,

		output: {
			filename: '[name].js',
			path: path.resolve(__dirname + '/../', 'js'),
			sourceMapFilename: '[name].map'
		},


		module: {
			rules: [
				{
					test: /\.js$/, 
					loader: 'babel-loader',
					exclude: /(node_modules)/,
					options: {
						presets: ['es2015']
					}
				},
				{
					test: /\.vue$/,
					loader: 'vue-loader',
				},
				{
					test: /\.s[a|c]ss$/,
					loader: 'style!css!sass-loader'
				},
				{
					test: /\.handlebars$/, loader: "handlebars-loader", 
					options: {
						helperDirs: path.resolve(__dirname + "./../resources/js/templates/handlebars/helpers")
					}
				}
			],
		},
	}
};
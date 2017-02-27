var path = require('path');
module.exports = function(env) {
	return {
		entry: {
			reportLoader: './resources/js/report-loader.js',
			operationFormSubmit: './resources/js/operation-form-submit.js',
			category_app: './resources/vue/category_app.js'
		},

		devtool: 'cheap-module-source-map',

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
var path = require('path');

const config = {

	entry: {
		reportLoader: './assets/js/report-loader.js',
		operationFormSubmit: './assets/js/operation-form-submit.js',
		category_app: './assets/vue/category_app.js'
	},

	output: {
		filename: '[name].js',
		path: path.resolve(__dirname, 'js')
	},

	devtool: 'cheap-eval-source-map',

	module: {
		rules: [
			{
				test: /\.js$/, 
				loader: 'babel-loader',
				exclude: /node_modules/,
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
					helperDirs: __dirname + "/assets/js/templates/handlebars/helpers"
				}
			}
		],
			
	}


};



module.exports = config;

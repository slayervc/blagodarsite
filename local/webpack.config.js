var path = require('path');

const config = {

	entry: {
		reportLoader: './assets/js/report-loader.js'
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
				query: {
					presets: ['es2015']
				}
			},
			{test: /\.handlebars$/, loader: "handlebars-loader"}
		]
	}


};



module.exports = config;

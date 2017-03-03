var path = require('path');
var webpack = require('webpack');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');


module.exports = function (env, settings) {

  return {
    entry: settings.entry,
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
                options: {
                    presets: ['es2015']
                },
                exclude: /(node_modules)/
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

    plugins: [
        new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: '"production"'
            }
        }),
        // minify with dead-code elimination
        new UglifyJSPlugin({
            comments: false,
            sourceMap: false
        })
        
    ]
  }
}


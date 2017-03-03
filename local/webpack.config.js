var path = require('path');


function buildConfig(env) {

	var settings = {
		entry: {
			reportLoader: './resources/js/report-loader.js',
			operationFormSubmit: './resources/js/operation-form-submit.js',
			agent_app: './resources/vue/agent_app.js'
		},

		resolve: {
			alias: {
				BaseComponents: path.resolve(__dirname, 'resources/vue/BaseComponents')
			}
		}

	};

	return require('./webpack_configs/' + env + '.js')({env: env}, settings);
};


module.exports = buildConfig;

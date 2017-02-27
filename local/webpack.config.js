
function buildConfig(env) {
	return require('./webpack_configs/' + env + '.js')({env: env});
};


module.exports = buildConfig;

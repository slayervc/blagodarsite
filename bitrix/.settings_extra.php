<?php 
return Array(

	'complex_api_token' => [
		'value' => 'token_to_gen_sms__kcq5cb_vm25mvun3PcWSR',
		'readonly' => true
	],

	'complex_api_host' => [
		'value' => 'https://xn----8sbntbegpkx.xn--p1ai/v1.1/',
		'readonly' => true
	],


	'complex_api_test_host' => [
		'value' => 'https://xn----8sbntbegpkx.xn--p1ai/vt1.1/',
		'readonly' => true
	],


	'complex_api_uris' => [
		'value' => [
			'client' => [
				'info' => 'clients/getinfo',
				'sms' => 'clients/gencode',
				'register' => 'clients/add',
				'report' => 'clients/getreport'
			],
			'partner' => [
				'info' => 'partners/getinfo',
				'partner-list' => 'partners/getpartnerslist',
				'add-partner-balance' => 'partners/addbalancepartner',
				'gen-reg-code' => 'partners/genregcode/',
				'regclient' => 'partners/regclient/',
				'get-client-info' => 'partners/getinfoclient/',
				'add-client-balance' => 'partners/addbalance/',
				'add-client-balance-proc' => 'partners/addbalanceproc/',
				'gen-balance-code' => 'partners/gencode/',
				'remove-client-balance' => 'partners/removebalance/',
				'report' => 'partners/getreport',
				'add-category' => 'partners/addcategory',
				'set-category' => 'partners/setcategory',
				'get-categories' => 'partners/getcategories',
				'get-category-info' => 'partners/getcategoryinfo',
				'get-cities-list' => 'partners/getcitieslist',
				'add-partner-by-agent' => 'partners/addpartnerbyagent',
				'set-partner-by-agent' => 'partners/setpartnerbyagent',
				'get-partners-list-agent' => 'partners/getpartnerslistagent',
				'get-info-partner-agent' => 'partners/getinfopartneragent'
			],
		],
		'readonly' => true
	]


);
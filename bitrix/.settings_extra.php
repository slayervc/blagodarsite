<?php 
return Array(

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
				'add-partner-balace' => 'partners/addbalancepartner',
				'gen-reg-code' => 'partners/genregcode/',
				'regclient' => 'partners/regclient/',
				'get-client-info' => 'partners/getinfoclient/',
				'add-client-balance' => 'partners/addbalance/',
				'add-client-balance-proc' => 'partners/addbalanceproc',
				'gen-balance-code' => 'partners/gencode/',
				'remove-client-balance' => 'partners/removebalance/',
				'report' => 'partners/getreport'
			],
		],
		'readonly' => true
	]


);
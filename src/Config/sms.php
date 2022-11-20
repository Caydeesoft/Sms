<?php

return
[
	'production' =>
		[ 
			"safaricom" => [
                'apiUsername' => '',
                'apiPassword' => '',
                'cpid'        => '',
                'token_link'  => 'https://dsvc.safaricom.com:9480/api/auth/login',
                'refreshtoken_link' => 'https://dsvc.safaricom.com:9480/api/auth/RefreshToken',
                'bulk_link' => '',
                'sendsms_link' => '',
                'sendsms_callback' => '',
                'subscription_link' => ''
			],

			"airtel" => [



			],
			"telkom" => [



			],
			"equitel" => [



			],

		],
	'development' =>
		[ 
			"safaricom" => [
                'apiUsername' => '',
                'apiPassword' => '',
                'cpid'        => '',
                'token_link'  => 'https://dtsvc.safaricom.com:8480/api/auth/login',
                'refreshtoken_link' => 'https://dtsvc.safaricom.com:8480/api/auth/RefreshToken',
                'bulk_link' => '',
                'sendsms_link' => '',
                'sendsms_callback' => '',
                'subscription_link' => ''


			],

			"airtel" => [



			],
			"telkom" => [



			],
			"equitel" => [



			],

		],
];
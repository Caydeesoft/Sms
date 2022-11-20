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
                'bulk_link' => 'https://dsvc.safaricom.com:9480/api/public/CMS/bulksms',
                'bulk_link2' => 'https://dsvc2.safaricom.com:9480/api/public/CMS/bulksms',
                'sendsms_link' => 'https://dsvc.safaricom.com:9480/api/public/SDP/deactivate',
                'sendsms_callback' => '',
                'subscription_link' => 'https://dsvc.safaricom.com:9480/api/public/SDP/activate',
                'unsubscription_link' => 'https://dsvc.safaricom.com:9480/api/public/SDP/deactivate',
                'payment_link' => 'https://dsvc.safaricom.com:9480/api/public/SDP/paymentRequest',
                'payment_link2' => 'https://dsvc2.safaricom.com:9480/api/public/SDP/paymentRequest',
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
                'bulk_link' => 'https://dtsvc.safaricom.com:8480/api/public/CMS/bulksms',
                'sendsms_link' => 'https://dtsvc.safaricom.com:8480/api/public/SDP/deactivate',
                'sendsms_callback' => '',
                'subscription_link' => 'https://dtsvc.safaricom.com:8480/api/public/SDP/activate',
                'unsubscription_link' => 'https://dtsvc.safaricom.com:8480/api/public/SDP/deactivate' ,
                'payment_link'  => 'https://dtsvc.safaricom.com:8480/api/public/SDP/paymentRequest'

			],

			"airtel" => [



			],
			"telkom" => [



			],
			"equitel" => [



			],

		],
];
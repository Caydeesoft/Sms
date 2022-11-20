<?php
 namespace Caydeesoft\Sms\Libs;
 use Caydeesoft\Sms\Traits\Helper;
 use Illuminate\Support\Facades\Cache;
 use Illuminate\Support\Facades\Http;
 use Illuminate\Support\Facades\Log;
 use Illuminate\Support\Facades\Cookie;

class Safaricom implements SmsInterface
	{
		public $config;
		
	    public function __construct($env = 'production')
		    {
		      	if($env == 'production')
			        {
			            
			        }
		        else
			        {
			            
			        }
				   
		    }
		    
		public function token()
			{
                if(!Cache::has('token'))
                    {
                        Cache::put('token',$this->getAccessTokens(),30*100);
                    }
                return Cache::get('token')->token;
			} 

		public function getAccessTokens()
			{
				try
					{
						$credentials    =   ['username' => $this->config['apiUsername'],'password' => $this->config['apiPassword']];
			            $data           =   Http::withHeaders(['Content-Type'=>'application/json','X-Requested-With'=>'XMLHttpRequest'])
								                ->withOptions(['verify' => dirname(__DIR__)."/Resources/cacert.pem", 'http_errors' => false])
								                ->post($this->config['token_link'],$credentials);

			            if($data->successful())
				            {
				                return $data->object();
				            }
			
					}
				catch(\HttpException $e)
					{
						return $e->getMessage();
					}
			}
		public function getRefreshToken($refreshToken)
			{
				try
					{
						
			            $data           =   Http::withHeaders(['Content-Type'=>'application/json','X-Requested-With'=>'XMLHttpRequest','X-Authorization'=> 'Bearer '.$refreshToken])
								                ->withOptions(['verify' => dirname(__DIR__)."/Resources/cacert.pem", 'http_errors' => false])
								                ->get($this->config['refreshtoken_link']);

			            if($data->successful())
				            {
				                return $data->object();
				            }
					}
				catch(\HttpException $e)
					{
						return $e->getMessage();
					}
			}
		
		public function bulkSms($new_sdp_data)
			{
				$json_data  =   array(
										"timeStamp" => time(),
										"dataSet" => [
														array(
																"userName"          =>  $new_sdp_data['userName'],
																"channel"           =>  "sms",
																"packageId"         =>  $new_sdp_data['packageId'],
																"oa"                =>  $new_sdp_data['oa'],
																"msisdn"            =>  $new_sdp_data['msisdn'],
																"message"           =>  $new_sdp_data['message'],
																"uniqueId"          =>  $new_sdp_data['msgid'],
																"actionResponseURL" =>  $this->config['sendsms_callback']
															)
													]
									);
				$result     =   Helper::invoke_server($this->config['bulk_link'],$json_data,$this->token());

				return $result;

			}
		public function sendSms($dt)
			{
				
				$data   =   array(
									[ "name" => "LinkId"    , 'value' => $dt['linkid']    ],
									[ 'name' => 'Msisdn'    , 'value' => $dt['phone']     ],
									[ 'name' => 'OfferCode' , 'value' => $dt['offercode'] ],
									[ 'name' => 'Content'   , 'value' => $dt['msg']       ],				
					                [ 'name' => 'CpId'      , 'value' => $this->config['cpid'] 	  ]
								);

				$json_data  =   array(
										"requestId"         => $dt['id'],
										"channel"           => "APIGW",										
										"operation"         => "SendSMS",
										"requestParam"      =>  array("data" => $data)

									);

                return  Helper::invoke_server($this->config['sendsms_link'],$json_data,$this->token());


				
				
			}
		public function subscription($dt)
			{
				$data   =   array(
									[ 'name' => 'OfferCode' , 'value' => $dt['offercode'] ],
									[ 'name' => 'Msisdn'    , 'value' => $dt['phone']     ],
									[ "name" => "Language"  , 'value' => 'English'    ],
									[ 'name' => 'CpId'      , 'value' => $this->config['cpid']      ]
								);
				$json_data  =   array(
										"requestId"         =>  $dt['id'],
										"requestTimeStamp"  =>  date('YmdHis'),
										"channel"           =>  "SMS",
										"operation"         =>  "ACTIVATE",
										"requestParam"      =>  array("data" => $data)
									);
                return  Helper::invoke_server($this->config['subscription_link'],$json_data,$this->token());
			}
		public function unsubscription($dt)
			{
				$data   =   array(
									[ 'name' => 'OfferCode' , 'value' => $dt['offercode'] ],
									[ 'name' => 'Msisdn'    , 'value' => $dt['phone']     ],
									[ 'name' => 'CpId'      , 'value' => $this->config['cpid']      ]
								);
				$json_data  =   array(
										"requestId"         =>  $dt['id'],
										"requestTimeStamp"  =>  date('YmdHis'),
										"channel"           =>  "SMS",
										"sourceAddress"     =>  $dt['ipaddress'],
										"operation"         =>  "DEACTIVATE",
										"requestParam"      =>  array("data" => $data)
									);
                return  Helper::invoke_server($this->config['subscription_link'],$json_data,$this->token());
			}
		public function cpNotification($dt,$additionaldata = NULL)
			{
				$data   =   array(
									[ 'name' => 'OfferCode' , 'value' => $dt['offercode'] ],
									[ 'name' => 'Msisdn'    , 'value' => $dt['phone']     ],
									[ 'name' => 'Command'   , 'value' => $dt['command']   ]
								);
				$json_data  =   array(
										"requestId"         =>  $dt['id'],
										"requestTimeStamp"  =>  date('YmdHis'),
										"operation"         =>  "CP_NOTIFICATION",
										"requestParam"      =>  array("data" => $data)
									);
				if(is_array($additionaldata))
					{
						foreach($additionaldata as $key => $value)
							{
								$json_data["additionalData"][] = array( 'name' => $key , 'value' => $value );
							}
					}
			}
	}

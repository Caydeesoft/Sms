<?php
 namespace Caydeesoft\Sms\Libs;

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

			} 

		public function getAccessTokens()
			{
				try
					{
						$credentials    =   ['username' => $this->config['apiUsername'],'password' => $this->apiPassword];
			            $data           =   Http::withHeaders(['Content-Type'=>'application/json','X-Requested-With'=>'XMLHttpRequest'])
								                ->withOptions(['verify' => dirname(__DIR__)."/Resources/cacert.pem", 'http_errors' => false])
								                ->post($this->config['safaricom.token_link'],$credentials);

			            if($data->successful())
				            {
				                return $data->object();
				            }
			
					}
				catch(Exception $e)
					{
						return $e->getMessage();
					}
			}
		public function getRefreshToken($refreshToken)
			{
				try
					{
						
			            $data           =   Http::withHeaders(['Content-Type'=>'application/json','X-Requested-With'=>'XMLHttpRequest'])
								                ->withOptions(['verify' => dirname(__DIR__)."/Resources/cacert.pem", 'http_errors' => false])
								                ->get($this->config['safaricom.refreshtoken_link'],$credentials);

			            if($data->successful())
				            {
				                return $data->object();
				            }
					}
				catch(Exception $e)
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
																"actionResponseURL" =>  $this->cfg->sendSmsCallback
															)
													]
									);

				$data       =   json_encode($json_data);
				echo $data;
				$result     =   $this->curlRequest($this->cfg->BulkSendUrl,$data);
				if ($result)
					{
						return $result;
					}
				return FALSE;
			}
		public function sendSms($dt)
			{
				
				$data   =   array(
									[ "name" => "LinkId"    , 'value' => $dt['linkid']    ],
									[ 'name' => 'Msisdn'    , 'value' => $dt['phone']     ],
									[ 'name' => 'OfferCode' , 'value' => $dt['offercode'] ],
									[ 'name' => 'Content'   , 'value' => $dt['msg']       ],				
					                [ 'name' => 'CpId'      , 'value' => $this->cpid 	  ]
								);

				$json_data  =   array(
										"requestId"         => $dt['id'],
										"channel"           => "APIGW",										
										"operation"         => "SendSMS",
										"requestParam"      =>  array("data" => $data)

									);
			
				$result     =   $this->curlRequest($this->cfg->sendSmsUrl,json_encode($json_data));
				
				if ($result)
					{
						return $result;
					}
				return FALSE;
				
				
			}
		public function subscription($dt)
			{
				$data   =   array(
									[ 'name' => 'OfferCode' , 'value' => $dt['offercode'] ],
									[ 'name' => 'Msisdn'    , 'value' => $dt['phone']     ],
									[ "name" => "Language"  , 'value' => 'English'    ],
									[ 'name' => 'CpId'      , 'value' => $this->cpid      ]
								);
				$json_data  =   array(
										"requestId"         =>  $dt['id'],
										"requestTimeStamp"  =>  date('YmdHis'),
										"channel"           =>  "SMS",
										"operation"         =>  "ACTIVATE",
										"requestParam"      =>  array("data" => $data)
									);
				return $this->curlRequest($this->cfg->subscriptionUrl,json_encode($json_data));
			}
		public function unsubscription($dt)
			{
				$data   =   array(
									[ 'name' => 'OfferCode' , 'value' => $dt['offercode'] ],
									[ 'name' => 'Msisdn'    , 'value' => $dt['phone']     ],
									[ 'name' => 'CpId'      , 'value' => $this->cpid      ]
								);
				$json_data  =   array(
										"requestId"         =>  $dt['id'],
										"requestTimeStamp"  =>  date('YmdHis'),
										"channel"           =>  "SMS",
										"sourceAddress"     =>  $this->ci->input->ip_address(),
										"operation"         =>  "DEACTIVATE",
										"requestParam"      =>  array("data" => $data)
									);
				return $this->curlRequest($this->cfg->unSubscriptionUrl,json_encode($json_data));
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

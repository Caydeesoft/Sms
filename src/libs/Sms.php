<?php
namespace Caydeesoft\Sms\Libs;

use Caydeesoft\Sms\libs\SmsInterface as Provider;
class Sms
    {
        public $provider;
        public function __construct(Provider $provider)
            {
                $this->provider = $provider;
            }
        public function sendSms($request)
            {
                return $this->provider->sendSms($request);
            }    
    }
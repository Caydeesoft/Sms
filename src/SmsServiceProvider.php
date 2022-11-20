<?php
namespace Caydeesoft\Sms;

use Illuminate\Support\ServiceProvider;

class SmsServiceProvider  extends ServiceProvider
	{
	    public function boot()
	    	{
				$this->publishes([
					__DIR__ . '/Config/sms.php' => config_path('sms.php'),
				]);
	    	}
	    public function register()
	    	{
				$this->mergeConfigFrom(
					__DIR__ . '/Config/sms.php', 'sms'
				);
	    	}	
	}
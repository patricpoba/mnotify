<?php

namespace PatricPoba\Tests;

use PHPUnit\Framework\TestCase;
use PatricPoba\MnotifySms;
 
class MnotifySmsTest extends TestCase
{ 
	protected $mnotifySms ;
 
	protected $testValues = [
							'senderId' => 'MyStartUp',
							'apiKey'   => 'SDERWCSXCVEARAVESARAVES'
						];
	

	function setup()
	{   
		$this->mnotifySms = new MnotifySms($this->testValues['senderId'], $this->testValues['apiKey']);
	}

	/** @test */
	public function package_version_is_zero_point_one()
	{ 
		return $this->assertSame(MnotifySms::VERSION, '0.1.0');
	}
 
	public function test_sms_end_point_is_valid()
	{ 
		return $this->assertSame(MnotifySms::SMS_ENDPOINT, 'https://apps.mnotify.net/smsapi');
	}


	public function test_new_instance_with_constructor_arguments()
	{   
		$this->assertEquals($this->testValues['senderId'], 
							$this->mnotifySms->sender_id, 
							'Instance var $senderId not equal to '. $this->testValues['senderId']);

		$this->assertEquals($this->testValues['apiKey'], 
							$this->mnotifySms->getApiKey(), 
							'Instance var $apiKey not equal to '. $this->testValues['apiKey']); 
	}


	public function test_contructor_arguments_can_be_overridden()
	{  
		# re-setup
		// $this->setup();

		$newSenderId = 'MyBusiness';		
		$this->mnotifySms->from($newSenderId); 
		$this->assertEquals($this->mnotifySms->sender_id, $newSenderId, 'Constructor variable $sender_id could not be overridden');

		$newApiKey = 'fqwerxcfqwerfxcqerf';
		$this->mnotifySms->setApiKey($newApiKey); 
		$this->assertEquals($this->mnotifySms->getApiKey(), $newApiKey, 'Constructor variable $api_key could not be overridden');
  
	}


}
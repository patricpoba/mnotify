<?php

namespace PatricPoba\Tests;
 
use Orchestra\Testbench\TestCase;
use PatricPoba\MnotifySms;
use PatricPoba\Mnotify\Facades\Sms;
use PatricPoba\Mnotify\MnotifyServiceProvider;
 
class LaravelMnotifySmsTest extends TestCase
{ 
	protected function getPackageProviders($app)
    {
        return [MnotifyServiceProvider::class];
    }

  
    public function test_namespaces_are_valid()
	{ 
		// dd(app()->make('mNotifySms'));
		$this->assertInstanceOf(MnotifyServiceProvider::class, new MnotifyServiceProvider(app()));

		$this->assertInstanceOf(MnotifySms::class, new MnotifySms);

	}

	public function test_facade()
	{
		$this->assertInstanceOf(MnotifySms::class, app()->make('mNotifySms')); 
	}

}
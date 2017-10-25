<?php
/**
 * mNotify Api docs Url: http://developer.mnotify.com/SMS_API/Send_Single_SMS
 */
namespace PatricPoba; 
  
class MnotifySms 
{
	const SMS_ENDPOINT = 'https://apps.mnotify.net/smsapi';

	protected $sms_api_key;

	public $to;

	public $message;

	public $sender_id; 

	public $date_time; 


	/**
	 * Although config variable $sms_api_key can be set in the env,
	 * it can also be set via the constructor to enable swapping
	 * of api keys during runtime
	 * @param [type] $sms_api_key [description]
	 */
	public function __construct($sender_id = null, $sms_api_key = null)
	{ 
		$this->sender_id 	 = $sender_id ?: config('mnotify.sender_id');

		$this->sms_api_key =  $sms_api_key ?: config('mnotify.sms_api_key'); 
	}

	/**
	 * override sender_id parameter
	 * @param \PatricPoba\Mnotify\Sms
	 */
	public function from($senderId)
	{
		// limit sender id to 11 characters
		$this->sender_id = $senderId ;

		return $this;
	}


	public function setApiKey($sms_api_key)
	{
		// limit sender id to 11 characters
		$this->sms_api_key = $sms_api_key ;

		return $this;
	}
 
 	/**
 	 * Send Sms to Phone number
 	 * @param  int 		$to        	recepient phone number
 	 * @param  string $message    messge to be sent
 	 * @param  string $key       	api key
 	 * @param  string $date_time 	schedule
 	 * @return boolean|array      [description]
 	 */
	public function send($to = null, $message = null, $date_time = null )
	{  
		$this->to 					= $to ?: $this->to;
		$this->message 			= $message ?: $this->message; 
		$this->date_time 		= $date_time ?: $this->date_time;

		//prepare url
		$url = static::SMS_ENDPOINT .'?'
		            . "key=". $this->sms_api_key
		            . "&to=" . $this->to 
		            . "&msg=". urlencode($this->message) 
		            . "&sender_id=" .  substr($this->sender_id, 0, 11) ;
		            
		if( !is_null($date_time) ) $url .= '&date_time='. $date_time ;
		            
		return $errorCode = file_get_contents($url) ;
		
		return $errorCode == '1000' 
								? true 
								: [ 'error_code' => $errorCode, 'error_message' => $this->errorMessage($errorCode) ]; 
	}	 


	public function schedule($date_time, $to = null, $message = null )
	{
		return $this->send($to, $message, $date_time);
	}

	/**
	 * Although config variable $sms_api_key can be set in the env,
	 * it can also be set via the constructor to enable swapping
	 * of api keys during runtime
	 * @param int $balance
	 */
	public function balance()
	{  
		$url= static::SMS_ENDPOINT .'/balance?key=' .$this->sms_api_key;

		return file_get_contents($url);
	}

	/**
	 * Inteprete error code
	 * @param  int $errorCode [error code returned by api]
	 * @return string  'error message'
	 */
	public function errorMessage($errorCode)
	{
		switch($errorCode){                                           
			case '1000':
				return 'Message sent';
				break;

			case '1002':
				return 'Message not sent';
				break;

			case '1003':
				return 'You do not have enough balance';
				break;

			case '1004':
				return 'Invalid API Key';
				break;

			case '1005':
				return 'Phone number not valid';
				break;

			case '1006':
				return 'Invalid Sender ID';
				break;

			case '1008':
				return 'Empty message';
				break; 
			default:
				return 'unknown error code';
		}
	}


}

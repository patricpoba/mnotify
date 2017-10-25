# mNotify SMS  
This package enables sending of sms from your laravel application using  [mNotify.com](https://www.mnotify.com) as a service provider.
The Voice feature will be added in future releases

## Installation
Download and install composer (from `http://www.getcomposer.org/download`) if you do not have it already.
 
Method 1: Require this package with composer:

```shell
composer require patricpoba/mnotify
```

Method 2: Add the following to your project `composer.json` file 
```
{
    "require": {
       "patricpoba/mnotify": "0.1.*"
    }
}
```
and run this command
```
composer update
```

After updating composer, add the ServiceProvider to the providers array in config/app.php
 
### Laravel <= 5.4 :
If you're using laravel 5.5, you can skip this step.
```php
PatricPoba\Mnotify\MnotifyServiceProvider::class, 
```

Add the facade of this package to the $aliases array.

```php
'Sms'  => PatricPoba\Mnotify\Facades\Sms::class,
```

### Configuration
Before you can start sending sms you will need to set your api key and default sender ID in your /.env file
You can find your api key here `https://apps.mnotify.net/api/api` 
These config files can be changed  from the laravel application. See examples 
```
<!-- /.env file -->
MNOTIFY_SMS_API_KEY=YourKeyGoesHere
MNOTIFY_SENDER_ID=MyApp
```
 
 
## Usage
Below is a basic usage guide for sending sms and checking sms balance of your mnotify account.

### Sending Sms
Sms messages can be sent using the facade or the class file.
In this example, we are going to send sms from our laravel application using mnotify.com's sms api
```php 
 
# Basic sending(uses api_key set in .env file)
Sms::send('02XXXXXXXXX', 'Testing test');

# To use a different api key,
Sms::setApiKey('API_KEY_GOES_HERE')->send('0275799028', 'Testing App');

# To customise sender Id,
# NB: sender Id must not be more than 11 characters
Sms::from('CompanyName')->send('02XXXXXXXX', 'Testing App');

```


### Sceduling 
A date and time in Y-m-d H:i:s format. This datetime should only be added when you want to schedule the message at a later time
```php 
$dateTime = \Carbon\Carbon::now()->addMinutes(30); // format: 2017-05-02 00:59:00

Smd::schedule($dateTime, '0275799028', 'Testing Application')

```


### Checking Sms balance 
This returns your mnotify.com sms balance.
```php 
Sms::balance();

# To check the balance using an api key different from the one set in the .env file,
Sms::setApiKey('API_KEY_GOES_HERE')->balance();

```

## Contributing

Thank you for considering contributing to the package! To contribute, fork this repository, write some code and then submit a pull request to the develop branch. :-)

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
# Laravel Api Error Handler
a useful package for handle your exception when you are developing a API
## :inbox_tray: Installation
you can install this package via Composer:
```bash
composer require hamidreza2005/laravel-api-error-handler
```
and after installation you can run following command to publish config files
```bash
php artisan vendor:publish --tag laravel-api-error-handler
```
## :gear: Configuration
for configure this package go to `config/api-error-handler.php`
```php
<?php  
  
return [  
  "Symfony\Component\HttpKernel\Exception\NotFoundHttpException" => "\hamidreza2005\LaravelApiErrorHandler\Exceptions\NotFoundException",  
  "ErrorException" => "\hamidreza2005\LaravelApiErrorHandler\Exceptions\ServerInternalException",  
  "Illuminate\Database\QueryException" => "\hamidreza2005\LaravelApiErrorHandler\Exceptions\ServerInternalException",  
  "Illuminate\Auth\AuthenticationException" => "\hamidreza2005\LaravelApiErrorHandler\Exceptions\AccessDeniedException",  
  "Symfony\Component\HttpKernel\Exception\HttpException" => "\hamidreza2005\LaravelApiErrorHandler\Exceptions\AccessDeniedException",  
  "Illuminate\Validation\ValidationException" => "\hamidreza2005\LaravelApiErrorHandler\Exceptions\ValidationException", 
  "Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException"=>"\hamidreza2005\LaravelApiErrorHandler\Exceptions\NotFoundException", 
];
```
this package provide some common exception like `ModelNotFound` But if you want to customize it you can do like this :
```php
<?php  
  
return [  
  "Your Error Namespace" => "the class that handle this error",   
];
```
|Class| Status Code  | Message|
|--|--|--|
|NotFoundException  |404  |Not Found|
|ServerInternalException|500|Server Internal Error
|AccessDeniedException|403|Access Denied|
|ValidationException|422|it returns all errors in validation|
|DefaultException|the status code of the Error|the message of the Error|

## :rocket: let this package get your Errors
go to the `app\Exceptions\Handler.php` and put this code:
```php
<?php  
  
namespace App\Exceptions;  
  
use hamidreza2005\LaravelApiErrorHandler\Traits\ApiErrorHandler;  
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;  
use Throwable;  
  
class Handler extends ExceptionHandler  
{  
	  use ApiErrorHandler;  
	  /**  
	 * A list of the exception types that are not reported. * * @var 		array  
	 */  
	 protected $dontReport = [  
		  //  
	  ];  
  
	  /**  
	 * A list of the inputs that are never flashed for validation exceptions. * * @var array  
	 */  
	 protected $dontFlash = [  
		  'password',  
		  'password_confirmation',  
	 ];  
	  /**  
	 * Register the exception handling callbacks for the application. * * @return void  
	 */
	 public function register()  
	 {
	   //  
	 }  
  
	 public function render($request, Throwable $e)  
	 {
		  return $this->handleError($this->prepareException($e));  
	 }
 }
```
## Make Your Own Error Handler!
if you want to make your own handler instead of using default handler you can make a class in everywhere you want **but your class have to Extends `hamidreza2005\LaravelApiErrorHandler\Exceptions\ExceptionAbstract`**

for Example:
```php
<?php  
  
  
namespace myNamespace;  
  
  
class MyException extends ExceptionAbstract  
{  
	  public function handleStatusCode():void  
	  {  
		  $this->statusCode = 2018;  
	  }
	   
	  public function handleMessage():void  
	  {  
		  $this->message = "My Message";  
	  }
 }
```
and you can do like this in `config/api-error-handler.php`:
```php
<?php

return [
	"ErrorException" => "myNamespace\MyException"
];
```
### ❗ Notice
**if an unknown Exception appeared this package automaticlly show it in the response but if you don't want that you can set `APP_DEBUG` to `false` in `.env` . when `APP_DEBUG` is `false` Server Internal shown in response** 
## :scroll: License  
  
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.  
  
--------------------  
  
### :raising_hand: Contributing  
If you find an issue, or have a better way to do something, feel free to open an issue , or a pull request.  

# Laravel Api Error Handler
a useful package for handling exception in laravel. 
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
to configure this package go to `config/api-error-handler.php`
```php
<?php  
  
return [  
    /*
     * this is where you define which handler deal with which errors. each handler can handle multiple errors
     */

    "handlers" =>[
        NotFoundExceptionHandler::class => [
            "Symfony\Component\HttpKernel\Exception\NotFoundHttpException",
            "Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException"
        ],
        ServerInternalExceptionHandler::class => [
            "ErrorException",
            "Illuminate\Database\QueryException"
        ],
        AccessDeniedExceptionHandler::class => [
            "Illuminate\Auth\AuthenticationException",
            "Symfony\Component\HttpKernel\Exception\HttpException"
        ],
        ValidationExceptionHandler::class => [
            "Illuminate\Validation\ValidationException"
        ],
    ],

    /*
     * if the app is not in debug mode. all unknown exceptions will be handled by this.
     */
    "internal_error_handler" => ServerInternalExceptionHandler::class,
];
```
this package provides some handlers for common exceptions like `ModelNotFound` But if you want to customize it you can do like this :
```php
<?php  
  
return [  
  YourHandler::class => [
        // exceptions
    ],   
];
```
|Class| Status Code                      | Message                      |
|--|----------------------------------|------------------------------|
|NotFoundException  | 404                              | Not Found                    |
|ServerInternalException| 500                              | Server Internal Error        
|AccessDeniedException| 403                              | Access Denied                |
|ValidationException| 422                              | all validation errors        |
|DefaultException| the status code of the Exception | the message of the Exception |

## :rocket: how to let handlers do their job ?
add `ApiErrorHandler` trait to `ExceptionHandler` located in `app\Exceptions\Handler.php`:
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
		  return $this->handle($this->prepareException($e));  
	 }
 }
```
## Make Your Own Exception Handler!
if you want to make your own handler your class has to extend `hamidreza2005\LaravelApiErrorHandler\Handlers\ExceptionHandler`

i.e:
```php
<?php  

class MyException extends ExceptionHandler  
{  
	  public function handleStatusCode():void  
	  {  
		  $this->statusCode = 499;  
	  }
	   
	  public function handleMessage():void  
	  {  
		  $this->message = "My Message";  
	  }
 }
```
 
## :scroll: License  
  
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.  
  
--------------------  
  
### :raising_hand: Contributing  
If you find an issue, or have a better way to do something, feel free to open an issue , or a pull request.  

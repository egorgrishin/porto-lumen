<?php

use Core\Classes\Illuminate\Application;
use Core\Exceptions\Handler;
use Core\Kernels\Kernel;
use Core\Middleware\FieldsAsArray;
use Core\Providers\AppServiceProvider;
use Core\Providers\AuthServiceProvider;
use Core\Providers\DatabaseServiceProvider;
use Core\Providers\EventServiceProvider;
use Core\Providers\RequestServiceProvider;
use Core\Providers\RouteServiceProvider;
use Illuminate\Contracts\Console\Kernel as LumenKernel;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Laravel\Lumen\Bootstrap\LoadEnvironmentVariables;

require_once __DIR__ . '/../vendor/autoload.php';

(new LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Application(dirname(__DIR__));

$app->withFacades();
$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like, or you can make another file.
|
*/

$app->singleton(ExceptionHandler::class, Handler::class);
$app->singleton(LumenKernel::class, Kernel::class);

/*
|--------------------------------------------------------------------------
| Register Config Files
|--------------------------------------------------------------------------
|
| Now we will register the "app" configuration file. If the file exists in
| your configuration directory it will be loaded; otherwise, we'll load
| the default version. You may register other files below as needed.
|
*/

$app->configure('app');

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

$app->middleware([
    FieldsAsArray::class,
]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->register(AppServiceProvider::class);
$app->register(AuthServiceProvider::class);
$app->register(DatabaseServiceProvider::class);
$app->register(RequestServiceProvider::class);
$app->register(RouteServiceProvider::class);
$app->register(EventServiceProvider::class);

return $app;

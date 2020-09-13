<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
use Illuminate\Support\Str;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/////////   Menggunakan Method Langsung - function(){ }   /////////
$router->get('/key', function ()  {
    return Str::random(32);
});

/////////   Method Request   /////////
//another: put patch delete option method
$router->get('/get_example', function ()  {
    return 'Hello from GET Method';
});
$router->post('/post_example', function ()  {
    return 'Hello from post Method';
});

/////////   Dynamic Route   /////////
//http://localhost:8001/user/32
$router->get('/user/{id}', function ($id)  {
    return 'Hello from user with id: '.$id;
});

//http://localhost:8001/post/32/comments/alo
$router->get('post/{postId}/comments/{commentId}', function ($postId,$commentId)  {
    return 'Hello from post with id: '.$postId.' and comment: '.$commentId;
});

/////////   Optional Param   /////////
//Note: harus ada nilai default
//http://localhost:8001/optional/32
$router->get('optional[/{id}]', function ($id = null)  {
    return 'Hello from optional with id: '.$id;
});

/////////   Nama alias   /////////
//http://localhost:8001/profile/id
$router->get('profile/id', ['as' => 'route.profile', function ()  {
    return 'Hello from route with nama alias: '.route('route.profile');
}]);

/////////   Redirect   /////////
//Note: jika di akses melalui chrome, url akan ganti ke url di redirect
$router->get('profile', function ()  {
    return redirect()->route('route.profile');
});

/////////   Middleware   /////////
//http://localhost:8001/customer/home?age=13
//http://localhost:8001/customer/home?age=20
$router->get('customer/home', ['middleware' => 'age',function() {
    return 'Customer, cukup umur';
}]);

$router->get('fail', function() {
    return 'Customer gak cukup umur';
});

/////////   Group   /////////
$router->group(['prefix' => 'admin'], function() use ($router) {
    //http://localhost:8001/admin/home
    $router->get('home', function() {
        return 'Home Admin';
    });
    //http://localhost:8001/admin/dashboard
    $router->get('dashboard', function() {
        return 'Dashboard Admin';
    });
});

/////////   Group with middleware   /////////
$router->group(['prefix' => 'miniadmin', 'middleware' => 'auth'], function() use ($router) {
});

/////////   Use controller   /////////
//http://localhost:8001/controller
$router->get('controller', 'ExampleController@sampleMethod');

/////////   Send value directly to controller   /////////
//http://localhost:8001/controller/7
$router->get('controller/{id}', 'ExampleController@sampleMethodById');

//http://localhost:8001/controller2/7/ikhwan
$router->post('controller2/{id}/{search}', 'ExampleController@searchById');

/////////   Alias with controller   /////////
//http://localhost:8001/controller3
$router->get('controller3', ['as' => 'alias', 'uses' => 'ExampleController@getAlias']);

//http://localhost:8001/controller3/testAlias
$router->get('controller3/testAlias', ['as' => 'alias.action', 'uses' => 'ExampleController@getAliasAction']);

/////////   Middlaware with controller   /////////
//http://localhost:8001/controller4?age=18
$router->get('controller4', ['middleware' => 'age', 'uses' => 'ExampleController@sampleMethod']);

/////////   Send value with Request to controller   /////////
//http://localhost:8001/controller5
$router->get('controller5', 'ExampleController@testRequest');

//http://localhost:8001/controller6
$router->post('controller6', 'ExampleController@testManyRequest');

/////////   Response with header, status code, dll   /////////
//http://localhost:8001/controller7
$router->post('controller7', 'ExampleController@response');
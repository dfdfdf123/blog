<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| First we need to get an application instance. This creates an instance
| of the application / container and bootstraps the application so it
| is ready to receive HTTP / Console requests from the environment.
|
*/

$app = require __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

class Dev extends IlluminateDatabaseEloquentModel {  
    protected $table = 'devs';
}

$app->get('dev', function() {
    return response()->json(Dev::all());
});

$app->get('dev/{id}', function($id) {
    return response()->json(Dev::find($id));
});

$app->post('dev', function(Request $request) {
    $dev = new Dev();
    $dev->name = $request->input('name');
    $dev->focus = $request->input('focus');
    $dev->hireDate = $request->input('hireDate');
  
    $dev->save();
    return response()->json($dev, 201);
});

$app->delete('dev/{id}', function($id) {
    Dev::find($id)->delete();
    return response('', 200);
});

$app->patch('dev/{id}', function(Request $request, $id) {
    $dev = Dev::find($id);
    $dev->name = $request->input('name', $dev->name);
    $dev->focus = $request->input('focus', $dev->focus);
    $dev->hireDate = $request->input('hireDate', $dev->hireDate);
  
    $dev->save();
    return response()->json($dev);
});

$app->run();

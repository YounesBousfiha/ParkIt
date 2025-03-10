<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/swagger-ui', function () {
    return view('swagger-ui');
});

Route::get('/docs/paritapi', function () {
    $filePath = storage_path('api-docs/apiv1.yaml');
    if (!file_exists($filePath)) {
        abort(404, 'Swagger file not found');
    }
    return Response::file($filePath, [
        'Content-Type' => 'application/x-yaml',
    ]);
});

/*Route::get('/docs/parkings', function () {
    $filePath = storage_path('api-docs/ParkingsDocs.json');

    if (!file_exists($filePath)) {
        abort(404, 'Swagger file not found');
    }

    return Response::file($filePath, [
        'Content-Type' => 'application/json',
    ]);
});

Route::get('/docs/reservations', function () {
    $filePath = storage_path('api-docs/ReservationsDocs.json');

    if (!file_exists($filePath)) {
        abort(404, 'Swagger file not found');
    }

    return Response::file($filePath, [
        'Content-Type' => 'application/json',
    ]);
});*/


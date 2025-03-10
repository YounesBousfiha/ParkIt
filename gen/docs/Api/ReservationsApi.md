# OpenAPI\Client\ReservationsApi

All URIs are relative to http://127.0.0.1:8000/api, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createReservation()**](ReservationsApi.md#createReservation) | **POST** /reservations | Create Reservation |
| [**deleteReservation()**](ReservationsApi.md#deleteReservation) | **DELETE** /reservations/{reservation_id} | Delete Reservation |
| [**getAllReservations()**](ReservationsApi.md#getAllReservations) | **GET** /reservations | Get All Reservations |
| [**getOneReservation()**](ReservationsApi.md#getOneReservation) | **GET** /reservations/{reservation_id} | Get One Reservation |
| [**myReservation()**](ReservationsApi.md#myReservation) | **GET** /myreservations | My Reservations |
| [**updateReservation()**](ReservationsApi.md#updateReservation) | **PUT** /reservations/{reservation_id} | Update Reservation |


## `createReservation()`

```php
createReservation($body)
```

Create Reservation

Creates a new reservation.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\ReservationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \OpenAPI\Client\Model\CreateReservationRequest(); // \OpenAPI\Client\Model\CreateReservationRequest | The reservation request details.

try {
    $apiInstance->createReservation($body);
} catch (Exception $e) {
    echo 'Exception when calling ReservationsApi->createReservation: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **body** | [**\OpenAPI\Client\Model\CreateReservationRequest**](../Model/CreateReservationRequest.md)| The reservation request details. | |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteReservation()`

```php
deleteReservation($reservation_id)
```

Delete Reservation

Deletes a specific reservation.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\ReservationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$reservation_id = 56; // int | The ID of the reservation to delete.

try {
    $apiInstance->deleteReservation($reservation_id);
} catch (Exception $e) {
    echo 'Exception when calling ReservationsApi->deleteReservation: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **reservation_id** | **int**| The ID of the reservation to delete. | |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getAllReservations()`

```php
getAllReservations()
```

Get All Reservations

Retrieves a list of all reservations.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\ReservationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $apiInstance->getAllReservations();
} catch (Exception $e) {
    echo 'Exception when calling ReservationsApi->getAllReservations: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOneReservation()`

```php
getOneReservation($reservation_id)
```

Get One Reservation

Retrieves a specific reservation by its ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\ReservationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$reservation_id = 56; // int | The ID of the reservation to retrieve.

try {
    $apiInstance->getOneReservation($reservation_id);
} catch (Exception $e) {
    echo 'Exception when calling ReservationsApi->getOneReservation: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **reservation_id** | **int**| The ID of the reservation to retrieve. | |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `myReservation()`

```php
myReservation()
```

My Reservations

Retrieves reservations for the currently authenticated user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\ReservationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $apiInstance->myReservation();
} catch (Exception $e) {
    echo 'Exception when calling ReservationsApi->myReservation: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateReservation()`

```php
updateReservation($reservation_id, $body)
```

Update Reservation

Updates an existing reservation.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\ReservationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$reservation_id = 56; // int | The ID of the reservation to update.
$body = new \OpenAPI\Client\Model\UpdateReservationRequest(); // \OpenAPI\Client\Model\UpdateReservationRequest | The updated reservation details.

try {
    $apiInstance->updateReservation($reservation_id, $body);
} catch (Exception $e) {
    echo 'Exception when calling ReservationsApi->updateReservation: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **reservation_id** | **int**| The ID of the reservation to update. | |
| **body** | [**\OpenAPI\Client\Model\UpdateReservationRequest**](../Model/UpdateReservationRequest.md)| The updated reservation details. | |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

# OpenAPI\Client\ParkingApi

All URIs are relative to http://127.0.0.1:8000/api, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**allParking()**](ParkingApi.md#allParking) | **GET** /parkings | Get All Parkings |
| [**createParking()**](ParkingApi.md#createParking) | **POST** /parkings | Create Parking |
| [**deleteParking()**](ParkingApi.md#deleteParking) | **DELETE** /parkings/{parking_id} | Delete Parking |
| [**getOneParking()**](ParkingApi.md#getOneParking) | **GET** /parkings/{parking_id} | Get One Parking |
| [**parkingAvalability()**](ParkingApi.md#parkingAvalability) | **GET** /parkings/avalability | Parking Availability |
| [**statistiques()**](ParkingApi.md#statistiques) | **GET** /parkings/stats | Statistics |
| [**updateParking()**](ParkingApi.md#updateParking) | **PUT** /parkings/{parking_id} | Update Parking |


## `allParking()`

```php
allParking()
```

Get All Parkings

Retrieves a list of all parking locations.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\ParkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $apiInstance->allParking();
} catch (Exception $e) {
    echo 'Exception when calling ParkingApi->allParking: ', $e->getMessage(), PHP_EOL;
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

## `createParking()`

```php
createParking($body)
```

Create Parking

Creates a new parking location.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\ParkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \OpenAPI\Client\Model\CreateParkingRequest(); // \OpenAPI\Client\Model\CreateParkingRequest | The parking location details.

try {
    $apiInstance->createParking($body);
} catch (Exception $e) {
    echo 'Exception when calling ParkingApi->createParking: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **body** | [**\OpenAPI\Client\Model\CreateParkingRequest**](../Model/CreateParkingRequest.md)| The parking location details. | |

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

## `deleteParking()`

```php
deleteParking($parking_id)
```

Delete Parking

Deletes a specific parking location.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\ParkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$parking_id = 56; // int | The ID of the parking location to delete.

try {
    $apiInstance->deleteParking($parking_id);
} catch (Exception $e) {
    echo 'Exception when calling ParkingApi->deleteParking: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **parking_id** | **int**| The ID of the parking location to delete. | |

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

## `getOneParking()`

```php
getOneParking($parking_id)
```

Get One Parking

Retrieves a specific parking location by its ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\ParkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$parking_id = 56; // int | The ID of the parking location to retrieve.

try {
    $apiInstance->getOneParking($parking_id);
} catch (Exception $e) {
    echo 'Exception when calling ParkingApi->getOneParking: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **parking_id** | **int**| The ID of the parking location to retrieve. | |

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

## `parkingAvalability()`

```php
parkingAvalability($zone)
```

Parking Availability

Checks the availability of parking spaces in a specific zone.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\ParkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$zone = 'zone_example'; // string | The zone to check for parking availability.

try {
    $apiInstance->parkingAvalability($zone);
} catch (Exception $e) {
    echo 'Exception when calling ParkingApi->parkingAvalability: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone to check for parking availability. | |

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

## `statistiques()`

```php
statistiques()
```

Statistics

Retrieves statistics related to parking usage.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\ParkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $apiInstance->statistiques();
} catch (Exception $e) {
    echo 'Exception when calling ParkingApi->statistiques: ', $e->getMessage(), PHP_EOL;
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

## `updateParking()`

```php
updateParking($parking_id, $body)
```

Update Parking

Updates an existing parking location.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\ParkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$parking_id = 56; // int | The ID of the parking location to update.
$body = new \OpenAPI\Client\Model\UpdateParkingRequest(); // \OpenAPI\Client\Model\UpdateParkingRequest | The updated parking location details.

try {
    $apiInstance->updateParking($parking_id, $body);
} catch (Exception $e) {
    echo 'Exception when calling ParkingApi->updateParking: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **parking_id** | **int**| The ID of the parking location to update. | |
| **body** | [**\OpenAPI\Client\Model\UpdateParkingRequest**](../Model/UpdateParkingRequest.md)| The updated parking location details. | |

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

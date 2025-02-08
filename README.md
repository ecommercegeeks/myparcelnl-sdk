# A Saloon based PHP SDK for MyParcel

The official SDK for MyParcel contains many smart features that in practice get in the way more than help. So we
developed this dumb SDK.

This SDK stays close to the [API documentation](https://developer.myparcel.nl/api-reference/). DTOs and Enums are used where it makes sense. This SDK is light
on documentation, because autocomplete will show you the way.

## Usage

Installation

```bash
composer require ecommercegeeks/myparcel-sdk
```

### Creating a label

```php
// Creating a connector doesn't make a network request yet, so can be initialized safely at application init.
$connector = new Connector($apiKey);

// Fill the DTOs
$shipment = new Shipment(recipient: new Recipient(...), ...);

// Create the request
$shipmentRequest = new AddShipments([$shipment]);

// Send the request
$response = $connector->send($shipmentRequest);

// Convert the request to an array of Shipment ids
$ids = $response->dtoOrFail();
```

For more usage examples, have a look at the tests in the `tests/Feature` folder.

## Be careful

This is a dumb SDK, so this SDK doesn't check correctness of the data. You have to take into account that the MyParcel
service is also lenient on data errors. You can easily create a label for a non-existent address. When you delete 
non-existing shipments, MyParcel doesn't respond with an error.

## Implemented requests

| Request           | Endpoint                | dto()              | Description               |
|-------------------|-------------------------|--------------------|---------------------------|
| AddShipment       | POST   /shipments       |                    |                           |
| GetShipments      | GET    /shipments       |                    |                           |
| UpdateShipment    | PATCH  /shipments       |                    |                           |
| DeleteShipment    | DELETE /shipments       |                    |                           |
| GetLocations      | GET    /locations       | array of locations | Endpoint is limited to NL |
| MatchLocations    | GET    /locations/match | -                  |                           |
| GetShipmentLabels | GET    /shipment_labels |                    |                           |


## Testing

Testing is performed against the actual API. Copy `test.example.env` to `test.env` and enter your API key. Then execute
the test suite by running `./vendor/bin/pest`. Because the tests are executed against the actual API, no CI/CD is in
place.

### Feature tests

The feature tests in the `tests/Feature` folder go through a cycle where a shipment is created and then either updated
or deleted. All feature tests either delete or hide the shipments after the cycle.

## Contributing

When you find an endpoint which is not implemented yet you are invited to add the required classes to this SDK through
a pull request. Take the following in order:

### Request classes

All DTO arguments are provided through the constructor. We use one class for both the request and the response, when
arguments are not required for a request, or not always present in responses, these arguments are default null so should
be last in the argument list of the constructor.

### Tests

Because tests are performed against the production API, make sure that tests delete or hide all created shipments.

When you are working in the test suite, you can display the sent request and response by setting `$this->debug = true`
within the test.

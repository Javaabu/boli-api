# Boli API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/javaabu/boli-api.svg?style=flat-square)](https://packagist.org/packages/javaabu/boli-api)
[![Build Status](https://img.shields.io/travis/javaabu/boli-api/master.svg?style=flat-square)](https://travis-ci.org/javaabu/boli-api)
[![Quality Score](https://img.shields.io/scrutinizer/g/javaabu/boli-api.svg?style=flat-square)](https://scrutinizer-ci.com/g/javaabu/boli-api)
[![Total Downloads](https://img.shields.io/packagist/dt/javaabu/boli-api.svg?style=flat-square)](https://packagist.org/packages/javaabu/boli-api)

PHP SDK for Ministry of Economic Development's [Boli System](https://business.egov.mv/)

## Contents

- [Installation](#installation)
    - [Setting up the Boli API credentials](#setting-up-the-boli-api-credentials)
- [Usage](#usage)
    - [Available Methods](#available-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)
- [Disclaimer](#disclaimer)

## Installation

You can install the package via composer:

``` bash
composer require javaabu/boli-api
```

**Laravel 5.5** and above uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.

After updating composer, add the ServiceProvider to the providers array in config/app.php

```php
// config/app.php
'providers' => [
    ...
    Javaabu\Boli\BoliServiceProvider::class,
],
```

Optionally add the facade.
```php
// config/app.php
'aliases' => [
    ...
    'Boli' => Javaabu\Boli\Facades\Boli::class,
],
```

### Setting up the Boli API credentials

Add your Boli Username, Password, and Url (optional) to your `config/services.php`:

```php
// config/services.php
...
'boli' => [
    'username' => env('BOLI_USERNAME'), // Boli API username 
    'password' => env('BOLI_PASSWORD'), // Boli API password 
    'url' => env('BOLI_API_URL'), // optional, use only if you need to override the default,
                                  // defaults to https://api-business.egov.mv/WebApi/api/   
],
...
```

## Usage

Using the App container:


``` php
$boli = App::make('boli');
$entity = $boli->getBusinessEntity('C-0933/2017');
```

Using the Facade

``` php
use Boli;

$entity = Boli::getBusinessEntity('C-0933/2017');
```

### Available Methods

``` php
Boli::getBusiness($business_registration_number); // for business entities + business names
Boli::getBusinessEntity($business_registration_number);
Boli::getProduct($product_registration_number);
Boli::getBusinessName($business_name_registration_number);
Boli::getImportLicense($import_license_number);
```  

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email info@javaabu.com instead of using the issue tracker.

## Credits

- [Javaabu Pvt. Ltd.](https://github.com/javaabu)
- [Mohamed Jailam](http://github.com/muhammedjailam)
- [Arushad Ahmed (@dash8x)](http://arushad.org)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Disclaimer

This package is not in any way officially affiliated with Maldives Ministry of Economic Development.
The "Boli" name has been used under fair use.

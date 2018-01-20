[![Build Status](https://travis-ci.org/Deveodk/core-exception.svg?branch=master)](https://travis-ci.org/Deveodk/core-exception)
[![Coverage Status](https://coveralls.io/repos/github/Deveodk/core-exception/badge.svg?branch=master)](https://coveralls.io/github/Deveodk/core-exception?branch=master)
[![Coding Standards](https://img.shields.io/badge/cs-PSR--2--R-yellow.svg)](https://github.com/php-fig-rectified/fig-rectified-standards)
[![Latest Stable Version](https://poser.pugx.org/deveodk/core-exception/v/stable)](https://packagist.org/packages/deveodk/core-exception)
[![Total Downloads](https://poser.pugx.org/deveodk/core-exception/downloads)](https://packagist.org/packages/deveodk/core-exception)
[![License](https://poser.pugx.org/deveodk/core-exception/license)](https://packagist.org/packages/deveodk/core-exception)


## core-exception

> To be used explicitly with Core by Deveo

## Requirements

This package requires the following:

* Composer
* Core by Deveo
* Laravel 5.5+
* PHP 7.1+

## Installation

Installation via Composer:

```bash
composer require deveodk/core-exception
```

## Disclaimer

Core components are an opinionated approach to designing modern Application Programming Interfaces (APIs). Every component is specifically designed to be used with Core by Deveo and is therefore not compatible with other frameworks such as standard Laravel.

## What it does

Core exception formats exceptions to a readable and parsable format. With Core exception we can also track exceptions using reporters like sentry.


## Exceptions codes


On of the key aspects of core exception is the custom error codes, with every exception we must provide a coresponding error code. 


The error codes can be configured in

``` core->exceptions.php ````


default there are several exception codes defined. To add new exceptions add it under the appropriate category, the naming of the parent array is not important as it find them recursivly so only the key of the error is important.

```php
/*
     * Exception codes for the core exception based platform.
     */
    'error_codes' => [
        // A1000 series
        'Creation failed' => [
            'A1000' => \DeveoDK\Core\Exception\Exceptions\Crud\CreationFailedException::class,
        ],

        // A2000 series
        'Deletion failed' => [
            'A2000' => \DeveoDK\Core\Exception\Exceptions\Crud\DeleteFailedException::class,
        ],

        // A3000 series
        'Update failed' => [
            'A3000' => \DeveoDK\Core\Exception\Exceptions\Crud\UpdateFailedException::class,
        ],

        // A4000 series
        'Read failed' => [
            'A4000' => \DeveoDK\Core\Exception\Exceptions\Crud\ReadFailedException::class
        ],

        // B1000 series
        'Notification failed' => [],

        // C1000 series
        'Framework general errors' => [
            'C1000' => \DeveoDK\Core\Exception\Exceptions\Http\ToManyRequestsException::class,
            'C1001' => \DeveoDK\Core\Exception\Exceptions\Http\MethodNotAllowedException::class,
            'C1003' => \DeveoDK\Core\Exception\Exceptions\Http\ResourceNotFoundException::class,
            'C1004' => \DeveoDK\Core\Exception\Exceptions\Validation\ValidationException::class,
        ],

        // D1000 series
        'Authorization errors' => [],
    ],
```


## Translating exceptions

#### General exceptions

To translate a general error go to ``` resources->translation->{locale}->exceptions.php ```

Simply place a new entry with the class path as key.

```php
	\DeveoDK\Core\Exception\Exceptions\Http\ResourceNotFoundException::class => [
        'title' => 'Not found',
        'message' => 'The requested resource was not found'
    ],
```


#### Bundle exceptions

When using bundle exceptions you must go to ``` {bundle}->translations->{lang}->exceptions.php ```

Then place a new entry like so 

Simply place a new entry with the class path as key.

```php
	\DeveoDK\Core\Exception\Exceptions\Http\ResourceNotFoundException::class => [
        'title' => 'Not found',
        'message' => 'The requested resource was not found'
    ],
```


Its important that you define the bundle in the __constructor() like so 

```php
	public function __construct()
    {
    	// The param is the case sensitive name of the bundle
        parent::__construct('User');
    }
```


---

[![Deveo footer](https://s3-eu-west-1.amazonaws.com/rk-solutions/github_footer.png)](https://deveo.dk)
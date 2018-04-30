<p align="center">
    <img src="https://raw.githubusercontent.com/YourAppRocks/eloquent-uuid/master/docs/yourAppRocks-logo.png" alt="YourApp.Rocks logo" >
</p>


# Eloquent UUID

[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-build]][link-build]
[![Latest Stable Version][ico-stable]][link-stable]
[![Total Downloads][ico-downloads]][link-downloads]

Simple and flexible Laravel package that adds support for UUID generation automatically for any Eloquent model.

* Generate `uuid` automatically.
* Choose a custom name for the `uuid` column in your table. *(default 'uuid')*
* Choose the version of the generated uuid. *(default '4')*
* Checks for `uuid version` and `column name`. *(throws the InvalidUuidVersionException and MissingUuidColumnException exceptions)*
* Prevents update on uuid value.

### What is a UUID?

A universally unique identifier (UUID) is a 128-bit number used to identify information in computer systems. is a 36 character long identifier made up of 32 alphanumeric characters with four hyphens in amongst it.
For example:`123E4567-E89b-12D3-A456-426655440000` containing letters and numbers. that will uniquely identify something. you can read more [here](https://en.wikipedia.org/wiki/Universally_unique_identifier).

## Installation

You can install the package via Composer:

``` bash
composer require your-app-rocks/eloquent-uuid
```

or via `composer.json` file

```json
{
    "require": {
        "your-app-rocks/eloquent-uuid": "~1.2"
    }
}
```

## Usage

### Create table

Create your table with a `uuid` column. For example:

```php
Schema::create('users', function (Blueprint $table) {
    $table->uuid('uuid');
    $table->string('name');
    $table->timestamps();
});
```
### Create model

In your eloquent model, add trait ``HasUuid``:

```php
<?php

namespace App\YourNameSpace;

use Illuminate\Database\Eloquent\Model;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class User extends Model
{
    use HasUuid;
}
```
### Create Controller

```php
<?php

namespace App\YourNameSpace;

use App\YourNameSpace\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * When a new record is inserted into the table `(with the create() or save() methods)`,
     * Trait "HasUuid" will automatically generate a uuid version 4* for the 'uuid' column of your schema.
     */
    public function store(Request $request)
    {
        $user = User::create($request->all()); // Automatically generate a uuid

        return $user->getUuid() // Return UUID value.
    }

    /**
     * Get User by custom 'UUID' key name - Implicit Binding.
     * See https://laravel.com/docs/5.6/routing#route-model-binding
     *
     * @param User $user
     * @return void
     */
    public function show(User $user)
    {
        return $user;
    }

    //OR

    /**
     * Get User by scope query.
     */
    public function show($uuid)
    {
        $user = User::findByUuid($uuid);

        return $user;
    }
}
```

## Customization

You can easily config the package for your needs by changing the *column name* and *uuid version*. For example:

```php
//Create table
Schema::create('posts', function (Blueprint $table) {
    $table->uuid('universally_unique_id');
    $table->string('title');
    $table->timestamps();
});

//Eloquent Model
class Post extends Model
{
    use HasUuid;

    protected $uuidColumnName = 'universally_unique_id';
    protected $uuidVersion = 1;    // Available 1,3,4 or 5
    protected $uuidString  = '';   // Needed when $uuidVersion is "3 or 5"
}
```
## Advance Customization

This package was built to be flexible and easy to customize!

You can use trait ``Uuidable`` to create your own trait with your custom code.

### Methods

#### YourAppRocks\EloquentUuid\Traits\Uuidable;

- getUuidColumnName()        ``// Get the column name. ( default 'uuid' )``
- setUuidColumnName($name)   ``// Set the custom column name.``
- getUuid()                  ``// Get the uuid value.``
- setUuid($value)            ``// Set the uuid value.``
- generateUuid()             ``// Generate the UUID value. ( Using Ramsey\Uuid )``
- getUuidVersion()           ``// Get uuid version or default to 4.``
- setUuidVersion($value)     ``// Set uuid version.``
- getUuidString()            ``// Get string to generate uuid version 3 and 5.``
- setUuidString($value = '') ``// Set string to generate uuid version 3 and 5.``

### Example custom code

Replacing trait ``HasUuid`` for ``MyUuidTrait``:


```php
//Create table
Schema::create('users', function (Blueprint $table) {
    $table->uuid('uuid');
    $table->string('name');
    $table->timestamps();
});

//Create MyUuidTrait with custom code
use YourAppRocks\EloquentUuid\Traits\Uuidable;

trait MyUuidTrait
{
    use Uuidable;

    /**
     * Boot trait on the model.
     *
     * @return void
     */
    public static function bootMyUuidTrait()
    {
        static::creating(function ($model) {
            // My custom code here.
        });

        static::saving(function ($model) {
            // My custom code here.
        });
    }

    // My custom code here.
}

//Create Model
use MyUuidTrait;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use MyUuidTrait;
}

```
## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [João Roberto][link-author]
- [All Contributors][link-contributors]

This package is inspired by [this][link-inspire] package.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-build]: https://travis-ci.org/YourAppRocks/eloquent-uuid.svg?branch=master
[ico-downloads]: https://poser.pugx.org/your-app-rocks/eloquent-uuid/downloads
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg
[ico-stable]: https://poser.pugx.org/your-app-rocks/eloquent-uuid/v/stable

[link-author]: https://github.com/joaorobertopb
[link-build]: https://travis-ci.org/YourAppRocks/eloquent-uuid
[link-contributors]: ../../contributors
[link-downloads]: https://packagist.org/packages/your-app-rocks/eloquent-uuid
[link-inspire]: https://github.com/kblais/laravel-uuid/
[link-stable]: https://packagist.org/packages/your-app-rocks/eloquent-uuid


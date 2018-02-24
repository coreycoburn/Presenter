# Laravel View Presenter
The `coburncodes/presenter` package allows you to easily integrate view presenters to keep your models tidy.

This packaged is adopted from [`Laracasts' view presenter`](https://github.com/laracasts/Presenter). This package is compatible with Laravel v5.6+.

This package also provides extra conveniences like:
- Publish a config file to change the path of your view presenters
- Includes an artisan command to generate new view presenters for your models.

## Install

You can install the package via composer:

``` bash
$ composer require coburncodes/presenter
```

### Config file
A config file can be published if you would like to change the default location of where the presenters are stored. By default, the view presenters are stored in the `Presenters` directory in the app root. Simply publish the config file by running:
``` bash
$ php artisan vendor:publish
```
Find the presenter vendor
``` bash
Provider: Coburncodes\Presenter\Providers\PresenterServiceProvider
```

## Usage
### Add trait to model:
To implement a view Presenter to a model add the `presentable` trait to your model.
```php
use Coburncodes\Presenter\Presentable;

class User
{
    use Presentable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];
...
```

### Create the presenter using Artisan
An artisan command is included in the package to generate a view presenter for a model. Simply run:
``` bash
$ php artisan presenter:generate
```
Follow the command prompts. Enter the name of the model that you want to create a presenter for as well as to create an initial method to present.

### Create the presenter manually
You can manually create a presenter in your `Presenters` directory. The package uses the convention of `ModelPresenter` as the class name for each presenter. i.e. `UserPresenter`. See the following example:
``` php
<?php

namespace App\Presenters;

use Coburncodes\Presenter\Presenter;

class UserPresenter extends Presenter
{
    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
```

### Implement in your view
Before integrating this package, you might write:
``` php
public function index()
{
    return Auth::user()->first_name . ' ' . Auth::user()->last_name;
}
```
This becomes very messy and you are not DRYing up your code.

Using this package, you add the `present()` method plus the method name you used in your presenter.
``` php
public function index()
{
    return Auth::user()->present()->fullName;
}
```

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
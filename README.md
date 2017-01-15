## Usage

### Step 1: Add in composer.json

```
"require": {
    "blumen/generators": "dev-master"
},
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/leopaglia/blumen-mvc-generator"
    }
]
```

### Step 2: Run composer install

```
composer install
```

### Step 3: Add the Service Provider in app.php

```php
$app->register(Blumen\Generators\Providers\GeneratorServiceProvider::class);
```


### Step 4: Run Artisan

Run `php artisan` from the console, and you'll see the new `make:mvc` command.

## Example:

```
php artisan make:mvc device
```

That will create in your base laravel path:
-- OUTDATED
```
app
|-- Http
|    |
|    +-- Controllers 
|    |    +- DeviceController.php
|    |    |
|    |    +- Dependencies
|    |          +-- DeviceController.php
|    |
|    +-- Routes
|         +-- Device.php
|
|-- Services
|    +- DeviceService.php
|    |
|    +- Dependencies
|          +-- DeviceService.php
|
+-- Repositories
|    +- DeviceRepository.php
|
+-- Models
     +- Device.php
```


All of these properly using the laravel IoC with dependency injection

`DeviceController.php`:
```
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Dependencies\DeviceController as Dependencies;

/**
 * Class DeviceController
 * @package App\Http\Controllers
 */
class DeviceController extends Dependencies {

}
```


`Dependencies/DeviceController.php`:
```
<?php

namespace App\Http\Controllers\Dependencies;

use App\Services\DeviceService;
use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * Class DeviceController
 * @package App\Http\Controllers\Dependencies
 */
class DeviceController extends BaseController {

    /**
     * @var DeviceService $DeviceService
     */
    protected $DeviceService;

    public function __construct(DeviceService $DeviceService) {
        $this->DeviceService = $DeviceService;
    }

}
```


Some parametric generic stuff coming soon..
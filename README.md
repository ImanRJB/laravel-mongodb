# Laravel Mongodb (Transactional support)

### Introduction


Jensseger's laravel-mongodb extension package is very popular among Laravel developers, but it lacks a transactional feature. mongoDB 4.x supports multi-document transactions. Therefore, this package extends [Jenssegers/laravel-mongodb](https://github.com/jenssegers/laravel-mongodb) with transactional support.

1. mongoDB transactions are based on the mongoDB4.x replica set environment. [mongoDB](https://docs.mongodb.com/manual/core/transactions)
2. This package depends on [Jenssegers/laravel-mongodb](https://packagist.org/packages/jenssegers/mongodb), so it needs to be installed first.

### Installation

Regarding the use of packages, it is necessary to replace [Jenssegers/laravel-mongodb](https://packagist.org/packages/jenssegers/mongodb#installation):

Install by composer
```bash
composer require imanrjb/laravel-mongodb
```

Laravel
```php
//Jenssegers\Mongodb\MongodbServiceProvider::class,
ImanRjb\Mongodb\MongodbServiceProvider::class
```

Lumen
```php
//$app->register(Jenssegers\Mongodb\MongodbServiceProvider::class);
$app->register(ImanRjb\Mongodb\MongodbServiceProvider::class);

$app->withEloquent();
```

Eloquent
--------
Eloquent only expands on transaction-related content, so it directly replaces [Jenssegers/laravel-mongodb](https://github.com/jenssegers/laravel-mongodb#eloquent)

```php
use ImanRjb\Mongodb\Eloquent\Model;

class User extends Model {}
```

```php
use ImanRjb\Mongodb\Eloquent\Model;

class MyModel extends Model {

    protected $connection = 'mongodb';

}
```

For more Eloquent documentation see (http://laravel.com/docs/eloquent)

### Usage

```php
DB::connection('mongodb')->beginTransaction();

try {
    User::insert($userData);
    UserInfo::insert($userInfoData);
    
    DB::connection('mongodb')->commit();
} catch (\Exception $e) {
    DB::connection('mongodb')->rollBack();
    throw $e;
}
```

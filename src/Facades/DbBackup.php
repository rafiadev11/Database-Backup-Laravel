<?php
/**
 * Created by PhpStorm.
 * User: rrafia
 * Date: 2/1/17
 * Time: 10:07 AM
 */

namespace Aracademia\LaravelDatabaseBackup\Facades;


use Illuminate\Support\Facades\Facade;

class DbBackup extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'DbBackup';
    }
}
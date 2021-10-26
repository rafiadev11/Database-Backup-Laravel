<?php
/**
 * Created by PhpStorm.
 * User: rrafia
 * Date: 2/1/17
 * Time: 10:01 AM
 */

namespace Aracademia\LaravelDatabaseBackup;


use Aracademia\LaravelDatabaseBackup\Console\DbBackupCommand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class DbBackupServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/DbBackupConfig.php' => config_path('DbBackup.php'),
        ]);
    }
    public function register()
    {
        $this->app->singleton('DbBackup',function($app)
        {
            return new DbBackup();
        });
        $this->app->singleton('DbBackupCommand',function($app)
        {
            return new DbBackupCommand();
        });

        $this->commands('DbBackupCommand');

        //register our facades
        $this->app->booting(function()
        {
            AliasLoader::getInstance()->alias('DbBackup','Aracademia\LaravelDatabaseBackup\Facades\DbBackup');
        });
    }
}
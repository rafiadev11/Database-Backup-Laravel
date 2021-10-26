<?php
/**
 * Created by PhpStorm.
 * User: rrafia
 * Date: 2/1/17
 * Time: 10:02 AM
 */

namespace Aracademia\LaravelDatabaseBackup;


class DbBackup
{
    public function backup()
    {
        $command = "mysqldump -u homestead -psecret bullard > ".storage_path('app/DbBackup/bullard.sql');
    }
}
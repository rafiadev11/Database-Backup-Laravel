<?php
/**
 * Created by PhpStorm.
 * User: rrafia
 * Date: 2/1/17
 * Time: 10:03 AM
 */
return [
    'use_laravel_default_db_config'             =>  'yes', //yes no

    //if your answer was No for the command above please fill in the following config info
    'db_backup_host'                            =>  env('DB_BACKUP_HOST','localhost'),
    'db_backup_user'                            =>  env('DB_BACKUP_USER','homestead'),
    'db_backup_password'                        =>  env('DB_BACKUP_PASS','secret'),
    'db_backup_database_name'                   =>  env('DB_BACKUP_DATABASE_NAME','homestead'),

    //If you would like to backup a single table within database, enter the table name below
    'db_backup_table_name'                      =>  env('DB_BACKUP_TABLE_NAME'),

    //DB Backup Path
    'db_backup_path'                            =>  env('DB_BACKUP_PATH',storage_path('app/DbBackup'))
];
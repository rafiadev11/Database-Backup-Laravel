<?php
/**
 * Created by PhpStorm.
 * User: rrafia
 * Date: 2/1/17
 * Time: 10:05 AM
 */

namespace Aracademia\LaravelDatabaseBackup\Console;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DbBackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DbBackup:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup your database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Database backup started...');

        if(!File::exists(config('DbBackup.db_backup_path')))
        {
            $this->info("Creating ".config('DbBackup.db_backup_path')." directory...");

            File::makeDirectory(config('DbBackup.db_backup_path'));

            $this->info(config('DbBackup.db_backup_path')." created");
        }

        if(strtolower(config('DbBackup.use_laravel_default_db_config')) == 'yes')
        {
            $command = $this->dbCommandBuilder(env('DB_HOST'),env('DB_DATABASE'), env('DB_USERNAME'), env('DB_PASSWORD'));
        }
        else
        {
            $command = $this->dbCommandBuilder(config('DbBackup.db_backup_host'), config('DbBackup.db_backup_database_name'), config('DbBackup.db_backup_user'), config('DbBackup.db_backup_password'));
        }

        exec($command);

        $this->info('Backup complete');
    }

    private function dbCommandBuilder($host, $db_name, $db_username, $db_password)
    {
        if(!is_null(config('DbBackup.db_backup_table_names')))
        {
            $this->info("Table(s) backup in progress...");
            $command = "mysqldump --opt --host=".$host." --user=".$db_username." --password=".$db_password." ".$db_name." ".config('DbBackup.db_backup_table_names')." > ".config('DbBackup.db_backup_path')."/".$db_name."_".str_replace(' ','_',config('DbBackup.db_backup_table_names'))."".date('_m_d_y_g-ia').".sql";
            return $command;
        }

        $this->info("Database backup in progress...");
        $command = "mysqldump --opt --host=".$host." --user=".$db_username." --password=".$db_password." ".$db_name." > ".config('DbBackup.db_backup_path')."/".$db_name."".date('_m_d_y_g-ia').".sql";
        return $command;
    }
}
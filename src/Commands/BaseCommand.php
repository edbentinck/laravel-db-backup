<?php

namespace Coreproc\LaravelDbBackup\Commands;

use Illuminate\Console\Command;
use Config;
use Coreproc\LaravelDbBackup\DatabaseBuilder;
use Coreproc\LaravelDbBackup\ConsoleColors;

class BaseCommand extends Command
{
    protected $databaseBuilder;
    protected $colors;

    public function __construct(DatabaseBuilder $databaseBuilder)
    {
        parent::__construct();

        $this->databaseBuilder = $databaseBuilder;
        $this->colors          = new ConsoleColors();
    }

    public function getDatabase($databaseDriver)
    {
        //$database   = $database ?: config('database.default');
        $realConfig = config('database.connections.' . $databaseDriver);

        return $this->databaseBuilder->getDatabase($realConfig);
    }

    protected function getDumpsPath()
    {
        return config('laravel-db-backup.path');
    }
}

<?php

use Coreproc\LaravelDbBackup\DatabaseBuilder;

class DatabaseBuilderTest extends \PHPUnit_Framework_TestCase
{

    public function testMySQL()
    {
        $config = [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'database',
            'username'  => 'root',
            'password'  => '',
            'port'      => '3307',
        ];

        $databaseBuilder = new DatabaseBuilder();
        $database = $databaseBuilder->getDatabase($config);

        $this->assertInstanceOf('Coreproc\LaravelDbBackup\Databases\MySQLDatabase', $database);
    }

    public function testSqlite()
    {
        $config = [
            'driver'   => 'sqlite',
            'database' => __DIR__.'/../database/production.sqlite',
        ];

        $databaseBuilder = new DatabaseBuilder();
        $database = $databaseBuilder->getDatabase($config);

        $this->assertInstanceOf('Coreproc\LaravelDbBackup\Databases\SqliteDatabase', $database);
    }

    public function testPostgres()
    {
        $config = [
            'driver'    => 'pgsql',
            'host'      => 'localhost',
            'database'  => 'database',
            'username'  => 'root',
            'password'  => 'paso',
        ];

        $databaseBuilder = new DatabaseBuilder();
        $database = $databaseBuilder->getDatabase($config);

        $this->assertInstanceOf('Coreproc\LaravelDbBackup\Databases\PostgresDatabase', $database);
    }

    public function testUnsupported()
    {
        $config = [
            'driver'   => 'unsupported'
        ];

        $this->setExpectedException('Exception');

        $databaseBuilder = new DatabaseBuilder();
        $database = $databaseBuilder->getDatabase($config);
    }
}

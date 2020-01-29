<?php

namespace kiraxe\AdminCrmBundle\Services\DbDump\Dump;

use kiraxe\AdminCrmBundle\Services\DbDump\DumpInterface\FileDump;
use PDO;




abstract class DbDump
{
    protected $dbrender;
    protected $pdoconnection;
    protected $dbname;
    protected $file;
    protected $fileName;

    public function __construct(FileDump $render)
    {
        $this->dbrender = $render;
    }

    public function changeDb(FileDump $render) : void {
        $this->dbrender = $render;
    }

    abstract public function getPdoConnection(): PDO;

    abstract public function getDump() : array;

    abstract public function getDbname() : string;

}
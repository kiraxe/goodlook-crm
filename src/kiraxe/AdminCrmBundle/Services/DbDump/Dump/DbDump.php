<?php

namespace kiraxe\AdminCrmBundle\Services\DbDump\Dump;

use kiraxe\AdminCrmBundle\Services\DbDump\DumpInterface\Dump;
use PDO;




abstract class DbDump
{
    protected $dbrender;
    protected $pdoconnection;
    protected $dbname;

    public function __construct(Dump $render)
    {
        $this->dbrender = $render;
    }

    public function changeDb(Dump $render) : void {
        $this->dbrender = $render;
    }

    abstract public function getPdoConnection(): PDO;

    abstract public function getDump() : array;

    abstract public function getDbname() : string;

}
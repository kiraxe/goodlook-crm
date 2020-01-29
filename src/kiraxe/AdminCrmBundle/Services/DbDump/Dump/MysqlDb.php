<?php


namespace kiraxe\AdminCrmBundle\Services\DbDump\Dump;

use kiraxe\AdminCrmBundle\Services\DbDump\Dump\DbDump;
use kiraxe\AdminCrmBundle\Services\DbDump\Dump\MysqlFileDump;
use PDO;

class MysqlDb extends DbDump
{

    public function __construct(MysqlFileDump $render, Config $config)
    {
        parent::__construct($render);
        $option = $config->getOptions();
        $params = $config->getDbParams();
        $host = $params['mysql']['host'];
        $dbname = $params['mysql']['name'];
        $port = $params['mysql']['port'];
        $charset = $params['mysql']['charset'];
        $user =  $params['mysql']['user'];
        $password = $params['mysql']['password'];
        $dns = "mysql:host=$host;dbname=$dbname;charset=$charset;port=$port";
        $this->dbconnection = new PDO($dns, $user, $password, $option);
        $this->dbname = $dbname;
    }

    public function getPdoConnection(): PDO
    {
        return $this->pdoconnection;
    }

    public function getDbname(): string
    {
        return $this->dbname;
    }

    public function getDump(): array

    {
        $connect = $this->pdoconnection;

        $tables = $this->dbrender->getTableAllName($connect);

        $result = [];

        $step = 0;
        foreach ($tables as $table) {

            $result[$step] = $this->dbrender->getCreateTable($connect, $table);

            $result[$step] = $this->dbrender->getPrimaryTable($connect, $table);

            $result[$step] = $this->dbrender->getKeyTable($connect, $table);

            $result[$step] = $this->dbrender->getDumpDBTables($connect, $table);

            $step++;

        }

        return $result;
    }
}
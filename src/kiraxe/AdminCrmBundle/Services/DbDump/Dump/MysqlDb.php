<?php


namespace kiraxe\AdminCrmBundle\Services\DbDump\Dump;

use kiraxe\AdminCrmBundle\Services\DbDump\Dump\DbDump;
use kiraxe\AdminCrmBundle\Services\DbDump\Dump\MysqlDump;
use kiraxe\AdminCrmBundle\Services\DbDump\Config\Config;
use PDO;

class MysqlDb extends DbDump
{

    public function __construct(MysqlDump $render)
    {
        parent::__construct($render);
        $option = Config::getOptions();
        $params = Config::getDbParams();
        $host = $params['mysql']['host'];
        $dbname = $params['mysql']['name'];
        $port = $params['mysql']['port'];
        $charset = $params['mysql']['charset'];
        $user =  $params['mysql']['user'];
        $password = $params['mysql']['password'];
        $dns = "mysql:host=$host;dbname=$dbname;charset=$charset;port=$port";
        $this->pdoconnection = new PDO($dns, $user, $password, $option);
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

    public function getDump($value, $table = null)
    {
        $connect = $this->getPdoConnection();
        $dbname = $this->getDbname();


        switch ($value) {
            case "tables":
                $result = $this->dbrender->getTableAllName($connect);
                break;
            case "create":
                $result = $this->dbrender->getCreateTable($connect, $table);
                break;
            case "insert":
                $result = $this->dbrender->getDumpDBTables($connect, $table);
                break;
            case "key":
                $result = $this->dbrender->getKeyTable($connect, $table, $dbname);
                break;
        }

        /*$step = 0;
        foreach ($tables as $table) {

            $result[$step] = $this->dbrender->getCreateTable($connect, $table);

            $result[$step] = $this->dbrender->getPrimaryTable($connect, $table, $dbname);

            $result[$step] = $this->dbrender->getKeyTable($connect, $table, $dbname);

            $result[$step] = $this->dbrender->getDumpDBTables($connect, $table);

            $step++;

        }*/

        return $result;
    }
}
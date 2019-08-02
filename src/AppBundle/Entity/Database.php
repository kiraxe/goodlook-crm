<?php
namespace AppBundle\Entity;
use Doctrine\DBAL\Driver\Connection;

class Database
{
    /**
    *
    * @var Connection
    */
    private $connection;

    public function __construct(Connection $dbalConnection) {
        $this->connection = $dbalConnection;
    }

    public function getTables() {

        $sql = 'SHOW TABLES FROM `goodlook-crm`'; 

        $tables = $this->connection->fetchAll($sql);

        $array;

        $step = 0;

        for($i = 0; $i < count($tables); $i++) {
            foreach( $tables[$i] as $key => $value) {
               $array[$step] = $value;
               $step++;
            }
        }

        return $array;
    }

    

}

?>
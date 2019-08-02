<?php

namespace AppBundle\Entity;

use Doctrine\DBAL\Driver\Connection;


class Users
{
    /**
    *
    * @var Connection
    */
    private $connection;

    public function __construct(Connection $dbalConnection) {
        $this->connection = $dbalConnection;
    }

    public function getID() {

        $sql = 'SELECT id FROM users'; 

        $ids = $this->connection->fetchAll($sql);

        return $ids;
    }

    public function getName() {
        $sql = 'SELECT name FROM users';

        $name = $this->connection->fetchAll($sql);

        return $name;
    }

    public function getUsers() {

        $sql = 'SELECT * FROM users';

        $users = $this->connection->fetchAll($sql);

        return $users;
    }
    
    public function insertNewLine($name, $lastname) {
        $this->connection->insert('users', array('name' => 'Артём', 'lastname' => 'Альбе'));
    } 


}

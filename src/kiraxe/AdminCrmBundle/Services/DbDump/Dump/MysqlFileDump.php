<?php

namespace kiraxe\AdminCrmBundle\Services\DbDump\Dump;

use kiraxe\AdminCrmBundle\Services\DbDump\DumpInterface\FileDump;


class MysqlFileDump implements FileDump
{
    /**
     * @return array
     */
    public function getTableAllName($pdoconnection) : array
    {
        $pdo = $this->getPdoConnection();

        $stmt = $pdo->query('SELECT table_name AS name FROM information_schema.tables WHERE table_schema = DATABASE()');

        while($row = $stmt->fetch()) {
            $result[] = $row['name'];
        }

        return $result;

    }

    /**
     * @param $table
     * @return string
     */
    public function getCreateTable($pdoconnection, $table): string {
        $pdo = $this->getPdoConnection();
        $stmt = $pdo->query('SHOW CREATE TABLE '. $table);
        $result = $stmt->fetch();

        //$resultAraay = explode(',', $result);

        return $result['Create Table'];
    }

    /**
     * @param $table
     * @return array
     */
    public function getPrimaryTable($pdoconnection, $table): array {
        $pdo = $this->getPdoConnection();
        $stmt = $pdo->query('SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA ='. "'" .$this->dbname . "'" .'AND TABLE_NAME ='. "'" . $table . "'" .' AND CONSTRAINT_NAME <> '. "'PRIMARY'" .' AND REFERENCED_TABLE_NAME is not null');
        while($row = $stmt->fetch()) {
            $result[] = $row;
        }

        return $result;
    }

    /**
     * @param $table
     * @return array
     */
    public function getKeyTable($pdoconnection, $table): array {
        $pdo = $this->getPdoConnection();
        $stmt = $pdo->query('SHOW KEYS FROM . ' . "`" . $table . "`" . ' FROM '. "`" .$this->dbname ."`");
        while($row = $stmt->fetch()) {
            $result[] = $row;
        }

        return $result;
    }

    /**
     * @param $table
     * @return array
     */
    public function getDumpDBTables($pdoconnection, $table) : array {
        $pdo = $this->getPdoConnection();
        $stmt = $pdo->query('SELECT * FROM '. $table);

        while ($row = $stmt->fetch()) {
            $result[] = $row;
        }

        return $result;
    }
}
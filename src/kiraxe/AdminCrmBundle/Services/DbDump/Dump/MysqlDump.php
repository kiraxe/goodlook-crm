<?php

namespace kiraxe\AdminCrmBundle\Services\DbDump\Dump;

use kiraxe\AdminCrmBundle\Services\DbDump\DumpInterface\Dump;



class MysqlDump implements Dump
{
    /**
     * @param $pdoconnection
     * @return array
     */
    public function getTableAllName($pdoconnection) : array
    {


        $stmt = $pdoconnection->query('SELECT table_name AS name FROM information_schema.tables WHERE table_schema = DATABASE()');

        while($row = $stmt->fetch()) {
            $result[] = $row['name'];
        }

        return $result;

    }

    /**
     * @param $table
     * @param $pdoconnection
     * @return string
     */
    public function getCreateTable($pdoconnection, $table): string {

        $result = [];

        $stmt = $pdoconnection->query('SHOW CREATE TABLE '. $table);
        $result = $stmt->fetch();

        return $result['Create Table'];
    }

    /**
     * @param $table
     * @param $pdoconnection
     * @param $dbname
     * @return array
     */
    public function getPrimaryTable($pdoconnection, $table, $dbname): array {

        $result = [];

        $stmt = $pdoconnection->query('SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA ='. "'" . $dbname . "'" .'AND TABLE_NAME ='. "'" . $table . "'" .' AND CONSTRAINT_NAME <> '. "'PRIMARY'" .' AND REFERENCED_TABLE_NAME is not null');
        while($row = $stmt->fetch()) {
            $result[] = $row;
        }

        return $result;
    }

    /**
     * @param $table
     * @param $pdoconnection
     * @return array
     */
    public function getKeyTable($pdoconnection, $table, $dbname): array {

        $result = [];

        $stmt = $pdoconnection->query('SHOW KEYS FROM . ' . "`" . $table . "`" . ' FROM '. "`" . $dbname ."`");
        while($row = $stmt->fetch()) {
            $result[] = $row;
        }

        return $result;
    }

    /**
     * @param $table
     * @param $pdoconnection
     * @return array
     */
    public function getDumpDBTables($pdoconnection, $table) : array {

        $result = [];

        $stmt = $pdoconnection->query('SELECT * FROM '. $table);

        while ($row = $stmt->fetch()) {
            $result[] = $row;
        }

        return $result;
    }
}
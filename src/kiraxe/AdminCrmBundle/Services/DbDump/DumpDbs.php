<?php


namespace kiraxe\AdminCrmBundle\Services\DbDump;

use PDO;


class DumpDbs
{
    private $pdoConnection;
    private $file;
    private $fileName;
    private $dbname;

    public function __construct($host, $port, $dbname, $user, $password, $charset)
    {
        $this->dbname = $dbname;
        $dns = "mysql:host=$host;dbname=$dbname;charset=$charset;port=$port";
        $option = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $this->pdoConnection = new PDO($dns, $user, $password, $option);
    }

    /**
     * @return PDO
     */
    public function getPdoConnection(): PDO
    {
        return $this->pdoConnection;
    }

    /**
     * @return array
     */
    public function getTableAllName() : array
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
    public function getCreateTable($table): string {
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
    public function getPrimaryTable($table): array {
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
    public function getKeyTable($table): array {
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
    public function getDumpDBTables($table) : array {
        $pdo = $this->getPdoConnection();
        $stmt = $pdo->query('SELECT * FROM '. $table);

        while ($row = $stmt->fetch()) {
            $result[] = $row;
        }

        return $result;
    }

    /**
     * @param $table
     */
    public function openFile($name) {

        $this->fileName = $name.time()."_dump.sql";

        $this->file = fopen($name.time()."_dump.sql", "w");

        $text = "
            -- SQL Dump
            -- version: 1.0
            -- База данных: `". $this->dbname ."`
            -- 
            -- ------------------------------------------------------
            -- ------------------------------------------------------
            
        ";

        fwrite($this->file, $text);
    }

    /**
     * @return string
     */
    public function getDump() :string {
        $tables = $this->getTableAllName();
        $file = "";

        foreach ($tables as $table) {

            $text = "
                
             --
             -- Структура таблицы - ". $table ."
             --
                
            ";

            $text .= "\r\n\r\n";

            fwrite($this->file, $text);

            $text = "";

            $text .= "DROP TABLE IF EXISTS `". $table ."`;";

            $text .= "\r\n\r\n";

            $text .= $this->getCreateTable($table).";";

            $text .="\r\n\r\n";

            fwrite($this->file, $text);

            $text = "";
            $text .= "
            -- 
            -- Dump BD - tables :". $table."
            --
             ";

            $text .="\r\n\r\n";

            $value = $this->getDumpDBTables($table);

            $i = 0;
            foreach($value[0] as $key => $val) {
                if ($i == 0) $colomnName = "(";
                $colomnName .= "`" . $key . "`,";
                $i++;
            }

            $colomnName = rtrim($colomnName,",");
            $colomnName .= ")";

            $text .="\nINSERT INTO `" . $table . "` " . $colomnName . " VALUES";

            $text .="\r\n";

            fwrite($this->file, $text);

            $text = "";


            for ($i = 0; $i < count($value); $i++) {
                if ($i == 0) $text .= "(";
                else $text .= ",\r\n(";

                foreach ($value[$i] as $val ) {
                    $text .= "'" . $val . "',";
                }

                $text = rtrim($text,",");
                $text .= ")";

            }

            $text .=";";

            $text .="\r\n\r\n";

            fwrite($this->file, $text);

        }

        foreach ($tables as $table) {


            $text = "";
            $text .= "
            -- 
            -- Индексы таблицы :". $table."
            --
             ";

            $text .="\r\n\r\n";

            $tableKey = $this->getKeyTable($table);

            $text .= 'ALTER TABLE ' .  '`' . $table . '`';

            $text .="\r\n";

            for ($i = 0; $i < count($tableKey); $i++) {

                if ($tableKey[$i]['Key_name'] == 'PRIMARY') {
                    $text .= '  ADD PRIMARY KEY ' . "(`" . $tableKey[$i]['Column_name'] . "`),";
                }

                if (!$tableKey[$i]['Non_unique'] && $tableKey[$i]['Key_name'] != 'PRIMARY') {
                    $text .= '  ADD UNIQUE KEY ' . '`' . $tableKey[$i]['Key_name'] . '`' . " (`" . $tableKey[$i]['Column_name'] . "`),";
                }

                if ($tableKey[$i]['Non_unique']) {
                    $text .= '  ADD KEY ' . '`' . $tableKey[$i]['Key_name'] . '`' . " (`" . $tableKey[$i]['Column_name'] . "`),";
                }

                //$text .= "\r\n";

            }
            $text = rtrim($text,",");

            $text .="\r\n\r\n";

            fwrite($this->file, $text);


        }


        fclose($this->file);

        $file = readfile($this->fileName);

        return $file;

    }

}
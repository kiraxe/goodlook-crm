<?php


namespace kiraxe\AdminCrmBundle\Services\DbDump\FileWriter;


use kiraxe\AdminCrmBundle\Services\DbDump\Dump\MysqlDb;
use kiraxe\AdminCrmBundle\Services\DbDump\FileInterface\WriterInterface;

class WriterSql extends Writer
{
    protected $mysqlDb;

    public function __construct(WriterInterface $render, MysqlDb $mysqlDb)
    {
        parent::__construct($render);
        $this->mysqlDb = $mysqlDb;
    }

    public function openFile($name)
    {
        $this->setFileName($name.time()."_dump.sql");
        $this->file = fopen($this->getFileName(), "w");
    }

    public function writeFile()
    {
        $text = "";

        $tables = $this->mysqlDb->getDump('tables');

        $text = $this->render->getTitle($this->mysqlDb);

        foreach ( $tables as $table) {
            $text .= $this->render->getstructureTable($table);
            $text .= $this->render->getCreate($table);
            $text .= $this->mysqlDb->getDump('create', $table);
            $text .= $this->render->getDumpDb($table);
            $value = $this->mysqlDb->getDump('insert', $table);
            $text .= $this->render->getInsert($table, $value);
            $text .= $this->render->getValues($value);
        }

        foreach ( $tables as $table) {
            $text .= $this->render->getIndex($table);
            $tableKey = $this->mysqlDb->getDump('key', $table);
            $text .= $this->render->getAlter($tableKey, $table);
        }

        fwrite($this->file, $text);

        fclose($this->file);
    }

    public function getFile()
    {
        $this->writeFile();
        $file = readfile($this->getFileName());
        unlink($this->getFileName());
        return $file;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName($filename)
    {
        $this->fileName = $filename;
    }
}
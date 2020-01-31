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

        $text = $this->render->getTitle($this->mysqlDb);

        fwrite($this->getFile(), $text);

        fclose($this->file);
    }

    public function getFile()
    {
        //$this->writeFile();
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
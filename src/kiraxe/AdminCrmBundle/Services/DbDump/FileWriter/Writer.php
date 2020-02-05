<?php


namespace kiraxe\AdminCrmBundle\Services\DbDump\FileWriter;


use kiraxe\AdminCrmBundle\Services\DbDump\FileInterface\WriterInterface;

abstract class Writer
{
    protected $render;
    protected $file;
    protected $fileName;


    public function __construct(WriterInterface $render)
    {
        $this->render = $render;
    }

    abstract public function openFile($name);
    abstract public function writeFile();
    abstract public function getFile();
    abstract public function getFileName();
    abstract public function setFileName($filename);
}
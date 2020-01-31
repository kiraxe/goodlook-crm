<?php


namespace kiraxe\AdminCrmBundle\Services\DbDump\FileInterface;


interface WriterInterface
{
    public function getTitle($mysqlDb):string;
}
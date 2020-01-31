<?php


namespace kiraxe\AdminCrmBundle\Services\DbDump\FileWriter;


use kiraxe\AdminCrmBundle\Services\DbDump\FileInterface\WriterInterface;

class WriterSqlPart implements WriterInterface
{
    public function getTitle($mysqlDb): string
    {
        $text = "
            -- SQL Dump
            -- version: 1.0
            -- База данных: `". $mysqlDb->getDbname() ."`
            -- 
            -- ------------------------------------------------------
            -- ------------------------------------------------------
            
        ";

        return $text;
    }
}
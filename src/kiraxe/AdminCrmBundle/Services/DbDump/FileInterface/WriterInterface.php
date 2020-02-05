<?php


namespace kiraxe\AdminCrmBundle\Services\DbDump\FileInterface;


interface WriterInterface
{
    public function getTitle($mysqlDb):string;
    public function getstructureTable($table):string;
    public function getCreate($table):string;
    public function getDumpDb($table):string;
    public function getInsert($table, $value):string;
    public function getValues($value):string;
    public function getIndex($table):string;
    public function getAlter($tableKey, $table);
}
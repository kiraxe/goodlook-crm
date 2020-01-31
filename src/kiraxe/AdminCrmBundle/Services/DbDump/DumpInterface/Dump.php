<?php


namespace kiraxe\AdminCrmBundle\Services\DbDump\DumpInterface;


interface Dump
{
    function getTableAllName($pdoconnection) : array;

    function getCreateTable($pdoconnection, $table): string;

    function getPrimaryTable($pdoconnection, $table, $dbname): array;

    function getKeyTable($pdoconnection, $table, $dbname): array;

    function getDumpDBTables($pdoconnection, $table);
}
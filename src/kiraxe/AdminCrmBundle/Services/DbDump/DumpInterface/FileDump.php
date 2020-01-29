<?php


namespace kiraxe\AdminCrmBundle\Services\DbDump\DumpInterface;


interface FileDump
{
    function getTableAllName($pdoconnection) : array;

    function getCreateTable($pdoconnection, $table): string;

    function getPrimaryTable($pdoconnection, $table): array;

    function getKeyTable($pdoconnection, $table): array;

    function getDumpDBTables($pdoconnection, $table);
}
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

    public function getstructureTable($table): string
    {

            $text = "
                
             --
             -- Структура таблицы - " . $table . "
             --
                
            ";

            $text .= "\r\n\r\n";

        return $text;
    }

    public function getCreate($table): string
    {
        $text = "";

        $text .= "DROP TABLE IF EXISTS `". $table ."`;";

        $text .= "\r\n\r\n";

        return $text;

    }

    public function getDumpDb($table): string
    {
        $text ="\r\n\r\n";

        $text .= "
            -- 
            -- Dump BD - tables :". $table."
            --
             ";

        $text .="\r\n\r\n";

        return $text;
    }

    public function getInsert($table, $value): string
    {
        $text = "";
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

        return $text;
    }

    public function getValues($value): string
    {
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

        return $text;
    }

    public function getIndex($table): string
    {
        $text = "";
        $text .= "
            -- 
            -- Индексы таблицы :". $table."
            --
             ";

        $text .="\r\n\r\n";

        return $text;
    }

    public function getAlter($tableKey, $table)
    {
        $text = "";

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

        }

        $text = rtrim($text,",");

        $text .="\r\n\r\n";

        return $text;
    }
}
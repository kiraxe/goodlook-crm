<?php

namespace kiraxe\AdminCrmBundle\Services\DbDump\Config;

use PDO;

class Config {

    private $parameters = [
        'mysql' => [
            'host' => '127.0.0.1',
            'port' => null,
            'name' => 'gl',
            'user' => 'root',
            'charset' => 'UTF8',
            'password' => null
        ]
    ];

    private $option = [
        'mysql' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    ];

    public function getDbParams() : array {
        return $this->parameters;
    }

    public function getOptions(): array {
        return $this->option;
    }
}
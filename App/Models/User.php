<?php

namespace App\Models;

use Core\Model;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class User
{
    /**
     * No one outside model needs know which table we're using right?!
     * @var string
     */
    private $table = "students";

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @param string $table
     */
    public function setTable(string $table): void
    {
        $this->table = $table;
    }
}

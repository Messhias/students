<?php
/**
 * @author Fabio William Conceição
 * @email messhias@gmail.com
 */

namespace App\Models;

/**
 * User (students) model.
 *
 * PHP version 7.1
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

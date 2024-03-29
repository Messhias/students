<?php

/**
 * @author Fabio William Conceição
 * @email messhias@gmail.com
 */

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.1
 */
class Config
{
    /**
     * Database host
     * @var string
     */
    const DB_HOST = "database_students";

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'students_docker';

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'root';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = 'docker';

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;
}

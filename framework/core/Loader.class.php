<?php
/**
 * Created by fabioconceicao.
 * FILE: Loader.class.phpss.php
 * User: fabioconceicao
 * Date: 2019-06-17
 * Time: 17:34
 */

/**
 * Class loader
 *
 * Responsible to loading all the framework application into the global context of application
 */
class Loader
{
    // Load library classes
    public function library($lib)
    {
        include LIB_PATH . "$lib.class.php";
    }

    // loader helper functions. Naming conversion is xxx_helper.php;
    public function helper($helper)
    {
        include HELPER_PATH . "{$helper}_helper.php";
    }
}

<?php
/**
 * Created by fabioconceicao.
 * FILE: Controller.php
 * User: fabioconceicao
 * Date: 2019-06-17
 * Time: 17:30
 */

/**
 * Class Controller
 *
 * Base controller method to be in the application
 */
class Controller
{
    // Base Controller has a property called $loader, it is an instance of Loader class(introduced later)
    protected $loader;

    public function __construct(){
        $this->loader = new Loader();
    }

    public function redirect($url, $message , $wait = 0){
        if ($wait == 0){
            header("Location:$url");
        } else {
            include CURR_VIEW_PATH . "message.html";
        }
        exit;

    }
}
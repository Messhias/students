<?php
/**
 * Created by fabioconceicao.
 * FILE: Controller.class.class.php
 * User: fabioconceicao
 * Date: 2019-06-17
 * Time: 17:30
 */

/**
 * Class Controller.class
 *
 * Base controller method to be in the application
 */
class Controller
{
    /**
     * Base Controller.class has a property called $loader, it is an instance of loader class(introduced later)
     * @var class
     */
    protected $loader;

    /**
     * Controller.class constructor.
     */
    public function __construct()
    {
        $this->loader = new Loader();
    }

    /**
     * @param     $url
     * @param     $message
     * @param int $wait
     */
    public function redirect($url, $message , $wait = 0)
    {
        if ($wait == 0){
            header("Location:$url");
        } else {
            include CURR_VIEW_PATH . "message.html";
        }
        exit;
    }
}
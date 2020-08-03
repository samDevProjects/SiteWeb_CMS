<?php
class Controller{

    public $request;
    //We store data that we want to display in this array
    private $vars = array();
    public $layout = 'default';
    private $rendered = false;
    /**
     * Initialize the request with all its parameters (controller, action and params)
     */
    function __construct($request){
        $this->request = $request;
    }

    /**
     * Allows rendering views by the controller
     * @param $view the index page
     */
    public function render($view){
        if($this->rendered){
            return false;
        }
        extract($this->vars);
        if (strpos($view, DS) === 0) {
            $view = ROOT.DS.'view'.$view.'.php';
        }else {
            $view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
        }
        
        ob_start();
        require($view);
        $content_for_layout = ob_get_clean();
        require ROOT.DS.'view'.DS.'layout'.DS.$this->layout.'.php';
        $this->rendered = true;
    }
    /**
     * Inserts variables we injected in PageController inside the array $vars
     * @param $key is the variable name
     * @param $value is the variable value
     */
    public function set($key, $value=null){
        if(is_array($key)){
            $this->vars += $key;
        }else {
            $this->vars[$key] = $value;
        }
    }
}
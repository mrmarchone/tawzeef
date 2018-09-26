<?php
class FrontController {
    protected $_lang = 'en';
    protected $_controller = 'home';
    protected $_method = 'default';
    protected $_params = [];
    protected $_url = [];
    protected function parseUrl () 
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = trim($url, '/');
        $url = explode('/', $url, 5);
        array_shift($url); // Delete This From Server
        return $url;
    }
    public function dispatch () 
    {
        $this->_url = $this->parseUrl();
        if (!empty($this->_url[0])) {
            $this->_lang = $this->_url[0];
        }
        if (!empty($this->_url[1])) {
            $this->_controller = $this->_url[1];
        }
        if (!empty($this->_url[2])) {
            $this->_method = $this->_url[2];
        }
        if (!empty($this->_url[3])) {
            $this->_params = $this->_url[3];
            $this->_params = explode('/', $this->_params);
        }
        if (file_exists(Controllers . ucfirst($this->_controller) . '.php')) 
        {
            $controller = new $this->_controller();
            if (method_exists($controller, $this->_method)) {
                $method = $this->_method;
                $controller->$method();
                call_user_func_array([$controller, $method], $this->_params);
            } else {
                $this->_method = 'default';
            }
        } else {
            $this->_controller = "error";
        }
    }
}
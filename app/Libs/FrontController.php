<?php
class FrontController {
    public $lang = 'en';
    public $className = 'index';
    public $actionName = 'default';
    public function url () {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = trim($url, '/');
        $url = explode('/', $url);
        array_shift($url);
        return $url;
    }
    public function route () {
        if (count($this->url()) !== 0) {
            if (!empty($this->url()[0])) {
                $this->lang = $this->url()[0];
            }
            if (!empty($this->url()[1])) {
                $this->className = $this->url()[1];
            }
            if (!empty($this->url()[2])) {
                $this->actionName = $this->url()[2];
            }
        }
        if (class_exists($this->className)) {
            if (method_exists($this->className, $this->actionName)) {
                $this->actionName();
            }
        }
    }
}
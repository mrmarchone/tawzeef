<?php

class Controller {
    public function view ($view = '', $params = '') {
        require_once Views . $view . '.view.php';
    }
}
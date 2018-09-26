<?php
class Home extends Controller {
    public function default ($name = '') {
        $this->view('Home/home');   
    }
}
?>
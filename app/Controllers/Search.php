<?php
class Search extends Controller {
    public function search ()
    {
        $r = Model::readAll("*", "`users-v1`");
        foreach ($r as $k => $v) {
            echo json_encode($v);
        }
    }
}
?>
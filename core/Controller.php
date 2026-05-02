<?php
class Controller{
    public function view($file, $data = []){
        require "../app/views/".$file.".php";
    }

    public function redirect($page){
        header("Location: ?page=".$page);
        exit();
    }
}

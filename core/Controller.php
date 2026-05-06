<?php
class Controller{
    public function view($file, $data = []){
        require "../app/views/".$file.".php";
    }

    public function redirect($page){
        header("Location: ?page=".$page);
        exit();
    }

    public function setFlash($message, $type = 'success'){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flash'] = [
            'message' => $message,
            'type' => $type
        ];
    }
}

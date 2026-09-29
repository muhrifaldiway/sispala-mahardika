<?php

class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);

        $viewPath = ROOT_PATH . '/app/Views/' . $view . '.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View tidak ditemukan: " . $view);
        }
    }

    protected function redirect($url)
    {
        header('Location: ' . BASE_URL . $url);
        exit;
    }
}
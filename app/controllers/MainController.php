<?php


namespace app\controllers;


use amp\Controller;

class MainController extends Controller
{

    public function indexAction()
    {
        debug(__METHOD__);
        debug($this->route);
        debug($this->model);
    }
}
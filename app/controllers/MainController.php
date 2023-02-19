<?php


namespace app\controllers;


use amp\Controller;

class MainController extends Controller
{

    public function indexAction()
    {
        $this->setMeta('Main page', 'Main page of ishop', 'keywords');

    }
}
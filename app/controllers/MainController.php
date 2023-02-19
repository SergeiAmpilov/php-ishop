<?php


namespace app\controllers;


use amp\Controller;
use app\models\Main;


/* @property Main $model   */

class MainController extends Controller
{

    public function indexAction()
    {
        $this->setMeta('Main page', 'Main page of ishop', 'keywords');

        $names = $this->model->getNames();
        $test = 'test';

        $this->set(compact('names', 'test'));
    }
}
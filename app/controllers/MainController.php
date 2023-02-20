<?php


namespace app\controllers;


use amp\Controller;
use amp\View;
use app\models\Main;
use RedBeanPHP\R;


/* @property Main $model   */
/* @property View $view   */
class MainController extends Controller
{

    public function indexAction()
    {
        $this->setMeta('Main page', 'Main page of ishop', 'keywords');
        $oneName = R::getRow('SELECT * FROM name WHERE id = 3');

        $names = $this->model->getNames();
        $test = 'test';

        $this->set(compact('names', 'test'));
    }
}
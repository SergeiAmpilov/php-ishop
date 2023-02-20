<?php


namespace amp;


abstract class Controller
{
    public array $data = []; // data for View
    public array $meta = [];
    public string | false $layout = ''; /* false - for AJAX request */
    public string $view = '';
    public object | string $model;



    public function __construct( public array $route = [] )
    {

    }

    public function getModel()
    {
        $model = 'app\models\\' . $this->route['admin_prefix'] . $this->route['controller'];
        $this->model = $model;

        if (class_exists($model)) {
            $this->model = new $model();
        } else {
            throw new \Exception("No such model $model", 404);
        }
    }

    public function getView()
    {
        $this->view = $this->view ?: $this->route['action'];
        (new View($this->route, $this->layout, $this->view, $this->meta))->render($this->data);
    }

    public function set($data)
    {
        $this->data = $data;
    }

    public function setMeta($title = '', $description = '', $keywords = '')
    {
        $this->meta = compact('title', 'description', 'keywords');
    }

}
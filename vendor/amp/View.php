<?php


namespace amp;


class View
{
    public string $content = '';

    public function __construct(
        public $route,
        public string | bool $layout = '',
        public $view = '',
        public $mets = []
    )
    {
        if ($this->layout !== false) {
            $this->layout = $this->layout ?: LAYOUT;
        }
    }

    public function render($data)
    {
        if (is_array($data)) {
            extract($data);
        }
        $prefix = str_replace('\\', '/', $this->route['admin_prefix']);
        $view_file = APP . "/views/{$prefix}{$this->route['controller']}/{$this->view}.php" ;

        if (file_exists($view_file)) {
            ob_start();
            require_once $view_file;
            $this->content = ob_get_clean();
        } else {
            throw new \Exception("No such view {$view_file}", 500);
        }

        if ($this->layout !== false) {
            $layout_file = APP . "/views/layouts/{$this->layout}.php" ;
            if (file_exists($layout_file)) {
                require_once $layout_file;
            } else {
                throw new \Exception("Not found layout $layout_file", 500);
            }
        }
    }

}
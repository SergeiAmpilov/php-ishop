<?php


namespace amp;


use RedBeanPHP\R;

class View
{
    public string $content = '';

    public function __construct(
        public $route,
        public string | bool $layout = '',
        public $view = '',
        public $meta = []
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

    public function getMeta()
    {
        $out = '<title>' . h($this->meta['title']) . '</title>' . PHP_EOL;
        $out .= '<meta name="description" content="' . h($this->meta['description']) . '">';
        $out .= '<meta name="keywords" content="' . h($this->meta['keywords']) . '">';

        return $out;
    }

    public function getDbLogs()
    {
        if (DEBUG) {

            $logs = R::getDatabaseAdapter()
                        ->getDatabase()
                        ->getLogger();

            $allLogs = array_merge(
                $logs->grep('SELECT'),
                $logs->grep('INSERT'),
                $logs->grep('DELETE')
            );
        }
    }

    public function getPart($file, $data = null)
    {
        if (is_array($data)) {
            extract($data);
        }

        $file = APP . "/views/{$file}.php";

        if (file_exists($file)) {
            require $file;
        } else {
            throw new \Exception("No such view {$file}", 500);
        }


    }

}
<?php


namespace amp;


class App
{

    public static $app;

    public function __construct()
    {
        $query = trim(urldecode($_SERVER['QUERY_STRING']), '/');

        new ErrorHandler();
        self::$app = Registry::getInstance();
        $this->getParams();

        Router::dispatch($query);
    }

    protected function getParams()
    {
        if (is_file(CONFIG . '/params.php'))
        {
            $params = require_once (CONFIG . '/params.php');
            foreach ($params as $key => $value) {
                self::$app->setProperty($key, $value);
            }
        }
    }


}
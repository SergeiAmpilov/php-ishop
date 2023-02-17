<?php


namespace amp;


class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) {
            error_reporting(E_ALL);
        } else {
            error_reporting(NIL);
        }

        set_exception_handler([$this, 'exceptionHandler']);
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
    }

    public function errorHandler($errno, $errstr, $errfile, $errline) {
        $this->logError(
            $errstr,
            $errfile,
            $errline
        );

        $this->displayError(
            $errno,
            $errstr,
            $errfile,
            $errline
        );
    }

    public function fatalErrorHandler() {
        $error = error_get_last();

        if (!empty($error && $error['TYPE'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR) )) {
            $this->logError(
                $error['message'],
                $error['file'],
                $error['line'],
            );
            ob_end_clean();
            $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
            ob_end_flush();
        }
    }

    public function exceptionHandler(\Throwable $e)
    {
        $this->logError(
            $e->getMessage(),
            $e->getFile(),
            $e->getLine()
        );

        $this->displayError(
            'Exeption',
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $e->getCode()
        );
    }

    protected function logError(string $message = '', string $file = '', string $line = '')
    {
        file_put_contents(
            LOGS . '/errors.log',
            "[ " . date("d.m.Y H:i:s") . " ] Error message: $message | File: $file | Line: $line " . PHP_EOL . " ==== " . PHP_EOL,
            FILE_APPEND
        );
    }

    protected function displayError($errno, $errstr, $errfile, $errline, $responseCode = 500)
    {
        if ($responseCode === 0) {
            $responseCode = 500;
        }

        http_response_code($responseCode); // отправляем пользователю новый код

        if (!DEBUG && $responseCode === 404) {
            require_once WWW . "/errors/404.php";
            die;
        }

        if (DEBUG) {
            require_once WWW . '/errors/development.php';
        } else {
            require_once WWW . '/errors/production.php';
        }
        die;
    }

}
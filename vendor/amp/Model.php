<?php


namespace amp;


abstract class Model
{
    public array $attributes = []; // автозаполнение модели данными
    public array $errors = []; // возможные ошибки при валидации данных
    public array $rules = []; // правила валидации данных
    public array $labels = []; // указание какое именно поле не прошло валидацию

    public function __construct()
    {
        Db::getInstance();
    }

}
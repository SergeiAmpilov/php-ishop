<?php


namespace amp;


class Registry
{
    use TSingleton;

    protected static array $properties = [];

    public function setProperty(string $name, $value)
    {
        self::$properties[$name] = $value;
    }

    public function getProperty(string $name)
    {
        return self::$properties[$name] ?: null;
    }

    public function getProperties(): array
    {
        return self::$properties;
    }
}
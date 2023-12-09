<?php

namespace App;

use App\Models\User;

/**
 * @property-read User $user
 */
class App
{
    private static App $app;

    public static function getInstance(): App
    {
        if (!isset(self::$app))
            self::$app = new self();
        return self::$app;
    }

    public function __get(string $name)
    {
        if (property_exists($this, $name))
            return $this->$name;

        $method = 'get'.str_replace('_', '', ucwords($name, '_'));
        if (method_exists($this, $method))
            return $this->$method();

        return null;
    }

    public function __set(string $name, $value): void
    {
        if (property_exists($this, $name))
            $this->$name = $value;

        $method = 'set'.str_replace('_', '', ucwords($name, '_'));
        if (method_exists($this, $method))
            $this->$method($value);
    }

    public function getUser()
    {
        return auth()->user();
    }
}

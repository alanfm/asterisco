<?php

namespace System\Core;

class DependencyInjection
{
    private $container = [];

    public function __set(string $name, $value)
    {
        $this->container[$name] = $value;

        return $this;
    }

    public function __get(string $name)
    {
        return $this->container[$name] ?? null;
    }
}
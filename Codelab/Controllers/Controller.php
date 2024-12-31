<?php

namespace Controller;

class Controller
{
    protected $controllerName;
    protected $controllerMethod;

    public function getControllerAttribute()
    {
        return [
            "ControllerName" => $this->controllerName,
            "Method" => $this->controllerMethod
        ];
    }
}

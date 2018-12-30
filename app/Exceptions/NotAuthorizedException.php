<?php

namespace App\Exceptions;

use Exception;

class NotAuthorizedException extends Exception
{
    protected $route;

    public function redirectTo($route) {
        $this->route = $route;

        return $this;
    }

    public function route() {
        return $this->route;
    }
}

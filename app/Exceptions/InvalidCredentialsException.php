<?php

namespace App\Exceptions;

use Exception;

class InvalidCredentialsException extends Exception
{
    public function render()
    {
        return response()->failed([
        ], $this->getMessage());
    }

    public function report()
    {
        return false;
    }
}

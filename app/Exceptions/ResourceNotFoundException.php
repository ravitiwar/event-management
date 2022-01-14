<?php

namespace App\Exceptions;

use Exception;

class ResourceNotFoundException extends Exception
{
    public function render()
    {
        return response()->failed([], $this->getMessage());
    }

    public function report()
    {
        return false;
    }
}

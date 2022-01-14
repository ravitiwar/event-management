<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;

class ValidationFailedException extends ValidationException
{
    protected $errors;

    function render()
    {
        return response()->failed($this->errors(), $this->getMessage(),'VALIDATION_FAILED');
    }
}

<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Exception;

abstract class BaseException extends Exception
{
    use ApiResponse;

    abstract public function render();
}

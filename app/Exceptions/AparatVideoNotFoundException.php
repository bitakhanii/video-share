<?php

namespace App\Exceptions;

use Exception;

class AparatVideoNotFoundException extends Exception
{
    protected $message = 'Video Not Found in Aparat!';
}

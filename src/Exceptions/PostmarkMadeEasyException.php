<?php

namespace Weareframework\PostmarkMadeEasy\Exceptions;

use Exception;

class PostmarkMadeEasyException extends Exception
{
    public function __construct($message, $code, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ":[{$this->code}]: {$this->message}\n";
    }
}

<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class InvalidRequestEception extends Exception
{
    public function __construct($message = "", $code = 400)
    {
        parent::__construct($message, $code);
    }

    public function render()
    {
        if (request()->expectsJson()) {
            return response()->json(['msg' => $this->message], $this->code);
        }

        return view('pages.error', ['msg' => $this->message]);
    }
}

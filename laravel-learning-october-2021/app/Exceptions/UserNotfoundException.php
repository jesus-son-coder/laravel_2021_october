<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserNotfoundException extends Exception
{
    public function report()
    {

    }


    /**
     * render the exception into a HTTP response.
     *
     * @param Request
     * @return Response
     */
    public function render($request)
    {
        return view('user.notfound');
    }
}



<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        // Constantes Globales :
        // ---------------------
        echo config('constants.OWT_APP');

        echo config('constants.OWT_KEY');

        echo config('constants.OWT_SECRET');


        // Utilisation d'un custom Helper :
        $string = removeWhiteSpace("Online Web Tutor");

    }
}

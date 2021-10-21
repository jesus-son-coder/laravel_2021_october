<?php

if(!function_exists("removeWhiteSpace")){

    function removeWhiteSpace($string){

        return strtolower(str_replace(" ", "-", $string));
    }
}


<?php

class ClearInput
{

    public static
    function clearName($inputString)
    {
        $inputString = strip_tags($inputString); // remove html tag
        $inputString = str_replace(" ", "", $inputString); // remove white space 
        $inputString = strtolower($inputString); // convert lower case 
        $inputString = ucfirst($inputString);
        return $inputString;
    }
    public static function clearUserName($inputString)
    {
        $inputString = strip_tags($inputString);
        $inputString = str_replace(" ", "", $inputString);
        return $inputString;
    }
    public static function clearEmail($inputString)
    {
        $inputString = strip_tags($inputString);
        $inputString = str_replace(" ", "", $inputString);
        return $inputString;
    }
    public static function clearPassword($inputString)
    {
        $inputString = strip_tags($inputString);
        return $inputString;
    }
}

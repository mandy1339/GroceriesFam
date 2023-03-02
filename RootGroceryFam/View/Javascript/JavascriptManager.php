<?php
require_once(BASEDIR . '/Template/NavigationHeader.php');



class JavascriptManager 
{
    public static function includeJQueryScript()
    {        
        return "<script src=\"https://code.jquery.com/jquery-3.6.0.min.js\" type=\"text/javascript\"></script>";
    }

    public static function includeGroceryItemAutocompleteScript()
    {
        $path = Navigation::get_site_name() . "/View/Javascript/groceryItemAutocomplete.js";
        return "<script src=\"$path\" type=\"text/javascript\"></script>";
    }
    
    public static function includeOnClickGroceryItemCheckBoxScript()
    {
        $path = Navigation::get_site_name() . "/View/Javascript/onClickGroceryItemCheckBoxScript.js";
        return "<script src=\"$path\" type=\"text/javascript\"></script>";
    }

}

?>
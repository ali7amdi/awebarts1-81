<?php

/*
 * Validator.php Class
 * 
 *  * Validation :
 *      - Stings
 *      - email
 *      - url
 *      - ip
 *      - integer value
 *      - requied 
 * 
 *  * Sanitization:
 *      - Stings
 *      - email
 *      - url
 *      - ip
 * 
 */

/**
 * Description of Validator
 *
 * @author Ali7amdi
 */
class Validator {

    //put your code here

    function checkStings($value, $key) {
        $pattern = "^[A-Za-z][أ-ي][0-9]'\",().:-$";
        $validate = eregi($pattern, $value);

        if ($validate == FALSE)
            throw new Exception("Error: the $key must be a string");

        return $validate;
    }

    function checkEmail($value, $key) {
        $validate = filter_var($value, FILTER_VALIDATE_EMAIL);

        if ($validate == FALSE)
            throw new Exception("Error: the $key must be a valid email");

        return $validate;
    }

    function checkurl($value, $key) {
        $validate = filter_var($value, FILTER_VALIDATE_URL);

        if ($validate == FALSE)
            throw new Exception("Error: the $key must be a valid URL");

        return $validate;
    }

    function checkIP($value, $key) {
        $validate = filter_var($value, FILTER_VALIDATE_IP);

        if ($validate == FALSE)
            throw new Exception("Error: the $key must be a valid IP");

        return $validate;
    }

    function checkInteger($value, $key) {
        $validate = filter_var($value, FILTER_VALIDATE_INT);

        if ($validate == FALSE)
            throw new Exception("Error: the $key must be a valid INT");

        return $validate;
    }

    function checkRequired($value, $key) {
        $validate = empty($value);

        if ($validate == FALSE)
            throw new Exception("Error: the $key must be not empaty");

        return $validate;
    }

    function sanitizeItem($value, $key) 
    {
        $flag = NULL;
        
        switch ($key) {
            case email:
                $value = substr($value, 0, 250);
                $filter = FILTER_SANITIZE_EMAIL;
                break;
            
            case url:
                $filter = FILTER_SANITIZE_URL;
                break;
            
            case int:
                $filter = FILTER_SANITIZE_NUMBER_INT;    
                break;
            
            default:
                $filter = FILTER_SANITIZE_STRING;  
                $flag = FILTER_FLAG_NO_ENCODE_QUOTES;
                break;
        }
        $validate = filter_var($value, $filter, $flag);
        if ($validate == FALSE)
            throw new Exception("Error: the $key is invalid!");

        return $validate;
    }
}

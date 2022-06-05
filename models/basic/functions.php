<?php

function checkRegexWriteMessage($string, $regex, $message, &$errorArray, $inputField = "", &$isThereEmpty = false) {
    if ($string == "") {
        $isThereEmpty = true;
    }
    if(is_array($regex)) {
        foreach($regex as $singleRegex) {
            if(!preg_match($singleRegex, $string)) {
                $errorArray[] = [$message, $inputField];
                break;
            }
        }
    }
    else {
        if(!preg_match($regex, $string)) {
            $errorArray[] = [$message, $inputField];
        }
    }
}
function writeErrorInFormField($inputField, $additionalClasses = "") {
    if(isset($_SESSION["errors"])) {
        $allErrors = $_SESSION["errors"];
        foreach($allErrors as $error) {
            if($error[1] == $inputField) {
                echo "<p id='$error[1]-info' class='form-error $additionalClasses' style='display: flex;'><svg viewBox='0 0 512 512'><path fill='#cf454a' d='M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z'/></svg><span>$error[0]</span></p>";
            }
        }
    }
}
function cropString($string, $maxLength) {
    if(strlen($string) > $maxLength) {
        return substr($string, 0, $maxLength)."...";
    }
    else return $string;
}
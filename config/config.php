<?php
define("BASE_URL", "http://127.0.0.1/ClothesShop/");
define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"]."/ClothesShop/");
define("ENV_FILE", ABSOLUTE_PATH."/config/.env");
define("LOG_FILE", ABSOLUTE_PATH."/data/log.txt");

/* Opens .env file and finds wanted value in it. */
function env($fileName){
    $open = fopen(ENV_FILE, "r");
    $data = file(ENV_FILE);
    $finalValue = "";
    foreach($data as $key=>$value){
        $dataValues = explode("=", $value);
        if($dataValues[0] == $fileName) {
            $finalValue = trim($dataValues[1]);
        }
    }
    return $finalValue;
}

define("SERVER", env("SERVER"));
define("DATABASE", env("DBNAME"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));
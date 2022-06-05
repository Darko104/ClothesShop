<?php
    header("Content-type: application/json");
    session_start();

    
    if( isset($_POST["type"]) ){
        include "../../config/connection.php";
        include "functions.php";

        $type = $_POST["type"];

        switch ($type) {
            case "category":
                $values = getProductCategories();
                break;
            case "collection":
                $values = getProductCollections();
                break;
            case "brand":
                $values = getProductBrands();
                break;
        }

        echo json_encode($values);
        http_response_code(200);
    }
    else {
        http_response_code(404);
    }
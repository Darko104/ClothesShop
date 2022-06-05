<?php 
    header("Content-type: application/json");
    session_start();

    if ( !isset($_SESSION['logged_user']) || (isset($_SESSION['logged_user']) && $_SESSION['logged_user']->privilege == 2) ) {
        http_response_code(401);
    }
    else {
        if ( isset($_GET["category"]) && isset($_GET["collection"]) && isset($_GET["brand"]) && isset($_GET["min-price"]) && isset($_GET["max-price"]) && isset($_GET["keyword"]) && isset($_GET["sort"]) && isset($_GET["sorttype"])) {
            include "../../config/connection.php";
            include "functions.php";

            $products = getAndFilterProducts($_GET);
            echo json_encode($products);
            http_response_code(200);
        }
        else {
            http_response_code(404);
        }
    }
?>
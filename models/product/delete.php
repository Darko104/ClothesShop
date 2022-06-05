<?php 
    header("Content-type: application/json");
    session_start();

    if ( !isset($_SESSION['logged_user']) || (isset($_SESSION['logged_user']) && $_SESSION['logged_user']->privilege == 2) ) {
        http_response_code(401);
    }
    else {
        if(isset($_POST['productId'])){
            include "../../config/connection.php";
            include "functions.php";

            $productId = $_POST['productId'];

            try {
                $conn->beginTransaction();

                $query = "DELETE FROM product WHERE id = :id";
                $stsm = $conn->prepare($query);
                $stsm->bindParam(":id", $productId);
                $stsm->execute();

                $conn->commit();

                $products = getAllProducts("productName", "asc");
                echo json_encode($products);
                http_response_code(200);
            }
            catch(PDOException $exception) {
                $conn->rollback();
                http_response_code(500);
            }
        }
        else {
            http_response_code(404);
        }
    }
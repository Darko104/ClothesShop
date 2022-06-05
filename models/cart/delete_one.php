<?php
    header("Content-type: application/json");
    session_start();

    if ( !isset($_SESSION["logged_user"]) ) {
        $productId = $_POST["productId"];
        $response = ["authentication" => false, "productid" => $productId];
        
        echo json_encode($response);
        http_response_code(200);
    }
    else {
        if( isset($_POST['productId']) ) {
            $response = ["authentication" => true];
            include "../../config/connection.php";
            include "functions.php";

            $userId = $_SESSION["logged_user"]->id;
            $productId = $_POST["productId"];

            try {
                $conn->beginTransaction();
                
                $query = "DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id";
    
                $stsm = $conn->prepare($query);
                $stsm->bindParam(":user_id", $userId);
                $stsm->bindParam(":product_id", $productId);
                $stsm->execute();
    
                $conn->commit();
                echo json_encode($response);
                http_response_code(200);
            }
            catch(PDOException $exception) {
                $conn->rollback();
                echo json_encode(['error', 'Error entering data: ' . $exception->getMessage()]);
                http_response_code(500);
            }
        }
        else {
            http_response_code(404);
        }
    }
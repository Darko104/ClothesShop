<?php
    header("Content-type: application/json");
    session_start();

    if ( !isset($_SESSION["logged_user"]) ) {
        $productId = $_POST["productId"];
        $quantity = $_POST["quantity"];
        $response = ["authentication" => false, "productid" => $productId, "quantity" => $quantity];
        echo json_encode($response);
        http_response_code(200);
    }
    else {
        if( isset($_POST['productId']) && isset($_POST['quantity']) ) {
            $response = ["authentication" => true];
            include "../../config/connection.php";
            include "functions.php";

            $userId = $_SESSION["logged_user"]->id;
            $productId = $_POST["productId"];
            $quantity = $_POST["quantity"];

            $doesElementExist = isProductInCart($userId, $productId);

            if ($doesElementExist == 0 || $doesElementExist == 2) {
                $response = ["message" => "Error! Product not found."];
                echo json_encode($response);
                http_response_code(409);
            }
            else if ($doesElementExist == 1) {
                try {
                    $conn->beginTransaction();
                    
                    $query = "UPDATE cart SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id";
        
                    $stsm = $conn->prepare($query);
                    $stsm->bindParam(":quantity", $quantity);
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
        }
        else {
            http_response_code(404);
        }
    }
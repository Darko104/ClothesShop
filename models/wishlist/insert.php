<?php
    header("Content-type: application/json");
    session_start();
    require_once "functions.php";

    if ( !isset($_SESSION["logged_user"]) ) {
        http_response_code(401);
    }
    else {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            include "../../config/connection.php";

            $userId = $_SESSION["logged_user"]->id;
            $productId = $_POST["productId"];

    
            $doesElementExist = isProductInWishlist($userId, $productId);

            if ($doesElementExist == 1 || $doesElementExist == 2) {
                $response = ["message" => "You have already added this item or valid ID parameter has been changed."];
                echo json_encode($response);
                http_response_code(409);
            }
            else if ($doesElementExist == false) {
                try {
                    $conn->beginTransaction();
                    
                    $query = "INSERT INTO wishlist (user_id, product_id) VALUES (:user_id, :product_id)";
        
                    $stsm = $conn->prepare($query);
                    $stsm->bindParam(":user_id", $userId);
                    $stsm->bindParam(":product_id", $productId);
                    $stsm->execute();
        
                    $conn->commit();
                    $response = ["message" => "Item added to your wishlist."];
                    echo json_encode($response);
                    http_response_code(201);
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
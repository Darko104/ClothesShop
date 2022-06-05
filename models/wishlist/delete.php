<?php
    header("Content-type: application/json");
    session_start();
    require_once "functions.php";

    if ( !isset($_SESSION["logged_user"]) ) {
        http_response_code(401);
    }
    else {
        if(isset($_POST['productId'])){
            include "../../config/connection.php";

            $userId = $_SESSION["logged_user"]->id;
            $productId = $_POST["productId"];

            $query = "DELETE FROM wishlist WHERE user_id = :user_id AND product_id = :product_id";

            $doesElementExist = isProductInWishlist($userId, $productId);

            if ($doesElementExist == 0 || $doesElementExist == 2) {
                $response = ["message" => "This item is not in your wishlist or valid ID parameter has been changed."];
                echo json_encode($response);
                http_response_code(404);
            }
            else {
                try {
                    $conn->beginTransaction();
                    
                    $stsm = $conn->prepare($query);
                    $stsm->bindParam(":user_id", $userId);
                    $stsm->bindParam(":product_id", $productId);
                    $stsm->execute();

                    $conn->commit();
                    $response = ["message" => "Item removed from your wishlist."];

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
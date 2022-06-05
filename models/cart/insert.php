<?php
    header("Content-type: application/json");
    session_start();

    $response = new stdClass();
    if ( !isset($_SESSION["logged_user"]) ) {
        $response->authentication = false;
        echo json_encode($response);
        http_response_code(200);
    }
    else {
        if ( isset($_POST['productId']) && isset($_POST['quantity']) ) {
            $response->authentication = true;
            include "../../config/connection.php";
            include "functions.php";
            
            $userId = $_SESSION["logged_user"]->id;
            $productId = $_POST["productId"];
            $quantity = $_POST["quantity"];

            $doesElementExist = isProductInCart($userId, $productId);

            if ($doesElementExist == 1 || $doesElementExist == 2) {
                $response->message =  "This item is already in your cart or valid ID parameter has been changed.";
                echo json_encode($response);
                http_response_code(409);
            }
            else if ($doesElementExist == false) {
                try {
                    $conn->beginTransaction();
                    
                    $query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)";
        
                    $stsm = $conn->prepare($query);
                    $stsm->bindParam(":user_id", $userId);
                    $stsm->bindParam(":product_id", $productId);
                    $stsm->bindParam(":quantity", $quantity);
                    $stsm->execute();
        
                    $conn->commit();

                    // Returned info
                    $response->message = "Item added to your cart.";

                    $numberOfPr = countItems($userId);
                    $response->numberOfPr = $numberOfPr;

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

<?php
    header("Content-type: application/json");
    session_start();

    if ( !isset($_SESSION["logged_user"]) ) {
        $response = ["authentication" => false];
        echo json_encode($response);
        http_response_code(200);
    }
    else {
        $response = ["authentication" => true];
        include "../../config/connection.php";
        include "functions.php";
        
        $userId = $_SESSION["logged_user"]->id;

        try {
            $conn->beginTransaction();
            
            $query = "DELETE FROM cart WHERE user_id = :user_id";

            $stsm = $conn->prepare($query);
            $stsm->bindParam(":user_id", $userId);
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
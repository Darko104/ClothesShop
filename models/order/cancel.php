<?php
    header("Content-type: application/json");
    session_start();

    if(isset($_POST['invoiceId'])){
        include "../../config/connection.php";
        include "functions.php";

        $invoiceId = $_POST['invoiceId'];

        try {
            $conn->beginTransaction();

            $query = "UPDATE invoice SET status = 3 WHERE id = :id";
            $stsm = $conn->prepare($query);
            $stsm->bindParam(":id", $invoiceId);
            $stsm->execute();

            $conn->commit();
            http_response_code(204);
        }
        catch(PDOException $exception) {
            $conn->rollback();
            http_response_code(500);
        }
    }
    else {
        http_response_code(404);
    }
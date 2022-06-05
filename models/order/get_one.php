<?php
    header("Content-type: application/json");
    session_start();

    if( isset($_POST["id"]) ){
        include "../../config/connection.php";
        include "functions.php";

        $userId = $_SESSION["logged_user"]->id;
        $invoiceId = $_POST["id"];

        $stsmInvoice = $conn->prepare("SELECT *, inv.id AS invoiceId, invs.name AS statusName FROM invoice inv INNER JOIN invoice_status invs ON inv.status = invs.id WHERE inv.id = :invoiceId");
        $stsmInvoice->bindParam(":invoiceId", $invoiceId);

        $stsmProducts = $conn->prepare("SELECT *, p.name AS productName, i.name AS imageName, b.name AS brandName FROM `invoice_product` inv INNER JOIN product p ON inv.product_id = p.id INNER JOIN product_image pri ON p.id = pri.product_id INNER JOIN image i ON i.id = pri.image_id INNER JOIN product_price pp ON p.id = pp.product_id INNER JOIN brand b ON p.brand_id = b.id WHERE pri.main = 1 AND invoice_id = :invoiceId");
        $stsmProducts->bindParam(":invoiceId", $invoiceId);

        $invoiceSerialNumberPerUser = getOrderSerialNumberPerCustomer($userId, $invoiceId);
        try {
            $stsmInvoice->execute();
            $stsmProducts->execute();

            $invoice = $stsmInvoice->fetch();
            $productsPerInvoice = $stsmProducts->fetchAll();

            $invoice->{"products"} = $productsPerInvoice;
            $invoice->{"invoiceSerial"} = $invoiceSerialNumberPerUser;

            echo json_encode($invoice);
            http_response_code(200);
        }
        catch(PDOException $exception) {
            echo json_encode(['error', 'Database error: ' . $exception->getMessage()]);
            http_response_code(500);
        } 
    }
    else {
        http_response_code(404);
    }
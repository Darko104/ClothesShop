<?php

    function getLastOrderId() {
        return executeQuery("SELECT id FROM invoice ORDER BY id DESC", true);
    }
    function removeLastEntry() {
        $lastId = getLastOrderId();
        return executeQueryNoReturn("DELETE FROM invoice WHERE id = $lastId");
    }
    function getOrdersByUserId($userId) {
        return executeQuery("SELECT *, inv.id AS invoiceId, invs.name AS statusName, inv.created_at AS invoiceCreation FROM invoice inv INNER JOIN invoice_status invs ON inv.status = invs.id WHERE user_id = $userId ORDER BY inv.created_at ASC");
    }
    function getProductsByInvoiceId($invoiceId) {
        return executeQuery("SELECT *, p.name AS productName, i.name AS imageName FROM `invoice_product` inv INNER JOIN product p ON inv.product_id = p.id INNER JOIN product_image pri ON p.id = pri.product_id INNER JOIN image i ON i.id = pri.image_id INNER JOIN product_price pp ON p.id = pp.product_id WHERE pri.main = 1 AND invoice_id = $invoiceId");
    }
    function getOrderSerialNumberPerCustomer($userId, $invoiceId) {
        $allInvoicesPerUser = executeQuery("SELECT @s:=@s+1 serial_number, i.id FROM invoice i, (SELECT @s:= 0) AS s WHERE i.user_id = $userId");
        
        foreach ($allInvoicesPerUser as $invoice) {
            if ($invoice->id == $invoiceId) return $invoice->serial_number;
        }
    }
    function updateOrderStatus() {
        // If invoice is older than 2 days, shipment has been completed.
        return executeQueryNoReturn("UPDATE invoice SET status = 2 WHERE created_at < date_sub(now(), interval 3 day) AND status = 1;");
    }
    function updateUnitsSold($productId, $additionalQuantity) {
        echo $productId;
        echo $additionalQuantity;
        return executeQueryNoReturn("UPDATE product SET units_sold = units_sold + $additionalQuantity WHERE id = $productId");
    }
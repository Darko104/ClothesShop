<?php
    session_start();
    require_once "../../config/connection.php";
    require_once "../basic/functions.php";
    require_once "../cart/functions.php";
    require_once "functions.php";

    if(isset($_POST['finish-order'])){
        $firstName = $_POST["checkout-name"];
        $lastName = $_POST["checkout-surname"];
        $email = $_POST["checkout-email"];
        $company = $_POST["checkout-company"];
        $phone = $_POST["checkout-phone"];

        $regexFirstName = '/^[A-z]{1,80}$/';
        $regexLastName = '/^[A-z]{2,50}(\s[A-Z][a-z]{2,50})*$/';
        $regexEmail = '/^[a-z\d\_\.\-]+\@[a-z\d]+(\.[a-z]{2,4})+$/';
        $regexCompany = "/^$|(?!\s)(?!.*\s$)(?=.*[a-zA-Z0-9])[a-zA-Z0-9 '~?!]{2,}$/";
        $regexPhone = '/^(\+?[0-9]|\s){8,15}$/';

        $errors = [];

        checkRegexWriteMessage($firstName, $regexFirstName, "Name can only contain letters, between 1 and 50 in length. Example: Peter.", $errors, "checkout-name");
        checkRegexWriteMessage($lastName, $regexLastName, "Last name can only contain letters, between 2 and 50 for each last name. Example: Smith Jones.", $errors, "checkout-surname");
        checkRegexWriteMessage($email, $regexEmail, "Icorrect email form. Example: name.surname@email.com", $errors, "checkout-email");
        checkRegexWriteMessage($company, $regexCompany, "Company name can only contain letters, numbers and special characters ('~?!). Example: McDonald's.", $errors, "checkout-company");
        checkRegexWriteMessage($phone, $regexPhone, "Please enter a valid number. Examples: +1 300 333-786, 51685409253", $errors, "checkout-phone");

        // Shipping adress
        
        $city = $_POST["checkout-city"];
        $adress = $_POST["checkout-adress"];
        $zipPostalCode = $_POST["checkout-zip"];

        $regexAdress = '/^[A-z]{2,20}(\s[A-z]{2,20})*\s[0-9]{1,10}([A-z]{1,3})*$/';
        $regexCity = '/^(\s*[A-z]{1,50})+$/';
        $regexZipPostalCode = '/^[0-9]{5}$/';

        checkRegexWriteMessage($adress, $regexAdress, "Adress can only contain street name and number. Example: Zdravka Celara 16B.", $errors, "checkout-adress");
        checkRegexWriteMessage($city, $regexCity, "City name can only contain letters, between 1 and 50 for each word. Example: Mexico City.", $errors, "checkout-city");
        checkRegexWriteMessage($zipPostalCode, $regexZipPostalCode, "Zip/Postal Code can contain only 5 numbers. Example: 18228.", $errors, "checkout-zippostalcode");

        // $searchedInputFields = ["checkout-adress", "checkout-city", "checkout-zippostalcode"];
        // foreach ($errors as $error) {
        //     if (in_array($error[1], $searchedInputFields)) {
        //         $_SESSION["openShippingAdress"] = "style='display:block;'";
        //     }
        // }

        // Payment type
        if (!isset($_POST["payment-type"])) {
            $errors[] = ["Please, select payment method.", "checkout-payment"];
        }
        else {
            $paymentType = $_POST["payment-type"];
        }
        // Comments
        $deliveryComment = null;
        $orderComment = null;
        if ( isset($_POST["checkout-shipping-comment"])) $deliveryComment = $_POST["checkout-shipping-comment"];
        if ( isset($_POST["checkout-order-comment"]) ) $orderComment = $_POST["checkout-order-comment"];
        // Price
        $shippingPrice = 5;
        $price = $_POST["price"] + $shippingPrice;

        // Is user authenticated
        $userId = null;
        if (isset($_SESSION["logged_user"])) {
            $userId = $_SESSION["logged_user"]->id;
        }
        // Basic order status (1 is for order being processed)
        $status = 1;

        // Error check
        if (count($errors) > 0) {
            var_dump($errors);
            $_SESSION["errors"] = $errors;

            $url = $_POST["query"];
            header("Location: ".$url);
        }
        else {
            $didInititalInfoSucceed;
            // Add initial order info (without products and quantities).
            try {
                $conn->beginTransaction();
                $query = "INSERT INTO invoice (user_id, first_name, last_name, email, company, phone, street_adress, city, zip, delivery_comment, payment_method, order_comment, status, price) VALUES (:user_id, :first_name, :last_name, :email, :company, :phone, :street_adress, :city, :zip, :delivery_comment, :payment_method, :order_comment, :status, :price)";
                $stsm = $conn->prepare($query);
                $stsm->bindParam(":user_id", $userId);
                $stsm->bindParam(":first_name", $firstName);
                $stsm->bindParam(":last_name", $lastName);
                $stsm->bindParam(":email", $email);
                $stsm->bindParam(":company", $company);
                $stsm->bindParam(":phone", $phone);
                $stsm->bindParam(":street_adress", $adress);
                $stsm->bindParam(":city", $city);
                $stsm->bindParam(":zip", $zipPostalCode);
                $stsm->bindParam(":delivery_comment", $deliveryComment);
                $stsm->bindParam(":payment_method", $paymentType);
                $stsm->bindParam(":order_comment", $orderComment);
                $stsm->bindParam(":price", $price);
                $stsm->bindParam(":status", $status);
                $stsm->execute();

                $conn->commit();
                $didInititalInfoSucceed = true;
                echo "Invoice added";
                $_SESSION["successful_registration"] = "You have successfully placed your order.";
            }
            catch(PDOException $exception) {
                $conn->rollback();
                $didInititalInfoSucceed = false;
                http_response_code(500);
                echo "Error entering values in table 'invoice'.";
            }
            // Adding product information for every order.
            $productsAndQuantities = $_POST["product-quantity"];
            $didProductsPerInvoiceSucceed;
            if ($didInititalInfoSucceed) {
                try {
                    $orderId = getLastOrderId()->id;
    
                    $conn->beginTransaction();
                    foreach($productsAndQuantities as $pq) {
                        $pq = explode(",", $pq);
                        $query = "INSERT INTO invoice_product (invoice_id, product_id, quantity) VALUES (:invoice_id, :product_id, :quantity)";
                        $stsm = $conn->prepare($query);
                        $stsm->bindParam(":invoice_id", $orderId);
                        $stsm->bindParam(":product_id", $pq[0]);
                        $stsm->bindParam(":quantity", $pq[1]);
                        $stsm->execute();
    
                        echo "Order added";
                    }
                    $conn->commit();
                    $didProductsPerInvoiceSucceed = true;
                }
                catch(PDOException $exception) {
                    $conn->rollback();
                    $didProductsPerInvoiceSucceed = false;
                    removeLastEntry();
                    http_response_code(500);
                    echo "Error entering values in table 'invoice_product'.";
                }
            }
            if($didProductsPerInvoiceSucceed) {
                if (isset($_SESSION["logged_user"])) {
                    // Delete cart
                    deleteAllInCartPerUser($userId);
                }
                else {
                    unset($_COOKIE['cart']);
                    setcookie('cart', null, -1, '/');
                }
                // Update units sold
                foreach($productsAndQuantities as $pq) {
                    $pq = explode(",", $pq);
                    updateUnitsSold($pq[0], $pq[1]);
                }

                // Redirektovanje
                header("Location: ../../index.php?page=account&view=user-orders");
            }
        }
    }
    else {
        http_response_code(400);
    }
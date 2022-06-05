<?php
    require_once "../../config/connection.php";
    require_once "functions.php";
    require_once "../basic/functions.php";
    session_start();

    if(isset($_POST['finish-registration'])){
        $firstName = $_POST["register-name"];
        $lastName = $_POST["register-surname"];
        $city = $_POST["register-city"];
        $adress = $_POST["register-adress"];
        $phone = $_POST["register-phone"];
        $email = $_POST["register-email"];
        $password = $_POST["register-password"];
        $confirmPassword = $_POST["register-confirm-password"];

        $regexFirstName = '/^[A-z]{1,80}$/';
        $regexLastName = '/^[A-z]{2,50}(\s[A-Z][a-z]{2,50})*$/';
        $regexCity = '/^(\s*[A-z]{1,50})+$/';
        $regexAdress = '/^[A-z]{2,20}(\s[A-z]{2,20})*\s[0-9]{1,10}([A-z]{1,3})*$/';
        $regexPhone = '/^(\+?[0-9]|\s){8,15}$/';
        $regexEmail = '/^[a-z\d\_\.\-]+\@[a-z\d]+(\.[a-z]{2,4})+$/';
        $regexPassword = ['/^.{4,50}$/', '/[a-z]|[A-Z]/', '/[0-9]/'];

        $errors = [];

        checkRegexWriteMessage($firstName, $regexFirstName, "Name can only contain letters, between 1 and 50 in length. Example: Peter.", $errors, "register-name");
        checkRegexWriteMessage($lastName, $regexLastName, "Last name can only contain letters, between 2 and 50 for each last name. Example: Smith Jones.", $errors, "register-surname");
        checkRegexWriteMessage($city, $regexCity, "City name can only contain letters, between 1 and 50 for each word. Example: Mexico City.", $errors, "register-city");
        checkRegexWriteMessage($adress, $regexAdress, "Adress can only contain street name and number. Example: Zdravka Celara 16B.", $errors, "register-adress");
        checkRegexWriteMessage($phone, $regexPhone, "Please enter a valid number. Examples: +1 300 333-786, 51685409253", $errors, "register-phone");
        checkRegexWriteMessage($email, $regexEmail, "Icorrect email form. Example: name.surname@email.com", $errors, "register-email");
        checkRegexWriteMessage($password, $regexPassword, "Password must contain between 4 and 50 characters with at least one letter and one number.", $errors, "register-password");

        if ($password != $confirmPassword) {
            $errors[] = "Passwords do not match.";
        }

        if (count($errors) > 0) {
            var_dump($errors);
            $_SESSION["errors"] = $errors;
            header("Location: ../../index.php?page=sign_up");
        }
        else {
            $password = md5($password);
            $privilege = 2;

            $query = "INSERT INTO user (first_name, last_name, city, street_adress, phone, email, password, privilege) VALUES (:first_name, :last_name, :city, :street_adress, :phone, :email, :password, :privilege)";
            $stsm = $conn->prepare($query);
            $stsm->bindParam(":first_name", $firstName);
            $stsm->bindParam(":last_name", $lastName);
            $stsm->bindParam(":city", $city);
            $stsm->bindParam(":street_adress", $adress);
            $stsm->bindParam(":phone", $phone);
            $stsm->bindParam(":email", $email);
            $stsm->bindParam(":password", $password);
            $stsm->bindParam(":privilege", $privilege);
            
            $execute = $stsm->execute();

            if($execute) {
                $_SESSION["review_info"] = ["success-form", "You have registered, please log in!"];
                header("Location: ../../index.php?page=sign_in");
            }
            else {
                echo "Error entering values in database";
            }
        }
    }
    else {
        http_response_code(400);
    }

?>
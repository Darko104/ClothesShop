<?php
    session_start();
    require_once "../../config/connection.php";
    require_once "functions.php";
    require_once "../basic/functions.php";

    if(isset($_POST['finish-user-update'])){
        $firstName = $_POST["update-name"];
        $lastName = $_POST["update-surname"];
        $email = $_POST["update-email"];
        $phone = $_POST["update-phone"];
        $city = $_POST["update-city"];
        $adress = $_POST["update-adress"];

        $regexFirstName = '/^[A-z]{1,80}$/';
        $regexLastName = '/^[A-z]{2,50}(\s[A-Z][a-z]{2,50})*$/';
        $regexEmail = '/^[a-z\d\_\.\-]+\@[a-z\d]+(\.[a-z]{2,4})+$/';
        $regexPhone = '/^$|(\+?[0-9]|\s){8,15}$/';
        $regexCity = '/^$|(\s*[A-z]{1,50})+$/';
        $regexAdress = '/^$|[A-z]{2,20}(\s[A-z]{2,20})*\s[0-9]{1,10}([A-z]{1,3})*$/';

        $errors = [];
        $isThereAnEmptyValue = false;
        
        checkRegexWriteMessage($firstName, $regexFirstName, "Name can only contain letters, between 1 and 50 in length. Example: Peter.", $errors, "update-name");
        checkRegexWriteMessage($lastName, $regexLastName, "Last name can only contain letters, between 2 and 50 for each last name. Example: Smith Jones.", $errors, "update-surname");
        checkRegexWriteMessage($email, $regexEmail, "Icorrect email form. Example: name.surname@email.com", $errors, "update-email");
        checkRegexWriteMessage($phone, $regexPhone, "Please enter a valid number. Examples: +1 300 333-786, 51685409253", $errors, "update-phone", $isThereAnEmptyValue);
        checkRegexWriteMessage($city, $regexCity, "City name can only contain letters, between 1 and 50 for each word. Example: Mexico City.", $errors, "update-city", $isThereAnEmptyValue);
        checkRegexWriteMessage($adress, $regexAdress, "Adress can only contain street name and number. Example: Zdravka Celara 16B.", $errors, "update-adress", $isThereAnEmptyValue);

        if (count($errors) > 0) {
            var_dump($errors);
            $_SESSION["errors"] = $errors;
            $_SESSION["open_more_options"] = "style='display: block;'";
            $_SESSION["inverted_arrow"] = "style='transform: matrix(1, 0, 0, -1, 0, 0);'";
            header("Location: ../../account.php");
        }
        else {
            $formId = $_POST["id"];
            $userSessionId = $_SESSION["logged_user"]->id;
            $userRole = getUserRole($userSessionId, $conn);

            // Form ID and session ID must be the same so that the user doesn't change someone elses information.
            // Admins can change other peoples information, so it must ensured that currently logged user is a regular customer.
            if ($formId == $userSessionId && $userRole == "customer") {
                $query = "UPDATE user SET first_name = :first_name, last_name = :last_name, city = :city, street_adress = :street_adress, phone = :phone, email = :email WHERE user.id = :id";
                $stsm = $conn->prepare($query);
                $stsm->bindParam(":first_name", $firstName);
                $stsm->bindParam(":last_name", $lastName);
                $stsm->bindParam(":city", $city);
                $stsm->bindParam(":street_adress", $adress);
                $stsm->bindParam(":phone", $phone);
                $stsm->bindParam(":email", $email);
                $stsm->bindParam(":id", $userSessionId);

                $execute = $stsm->execute();

                // Empty string values to null values. This is needed if admin wants to search for null values, if they are not converted to null, empty string would not show.
                $conn->query("UPDATE user SET city = NULLIF(city, '')")->execute();
                $conn->query("UPDATE user SET street_adress = NULLIF(street_adress, '')")->execute();
                $conn->query("UPDATE user SET phone = NULLIF(phone, '')")->execute();

                if ($execute) {
                    if ($isThereAnEmptyValue == true) {
                        $_SESSION["update_warning"] = "Note! You have emptied some values.";
                    }
                    // New session with new user info need to be called so that showcased info on webpages is updated.
                    $query = "SELECT * FROM user WHERE id = :id";
                    $stsm = $conn->prepare($query);
                    $stsm->bindParam(":id", $userSessionId);
                    $stsm->execute();
                    $getUser = $stsm->fetch();
                    $_SESSION["logged_user"] = $getUser;

                    $_SESSION["successful_update"] = "You have successfully updated your profile.";
                }
                else {
                    $errors[] = ["Error entering values in database", "update-user-fail"];
                    $_SESSION["errors"] = $errors;
                }
                header("Location: ../../account.php");
            }
        }
    }
?>

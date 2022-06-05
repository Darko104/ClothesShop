<?php

    function getUserAttribute($attribute) {
        if(isset($_SESSION["logged_user"])) {
            return $_SESSION["logged_user"]->{$attribute};
        }
    }
    function getUserRole($id, $conn) {
        $query = "SELECT p.name FROM privilege p INNER JOIN user u ON p.id = u.privilege WHERE u.id = :id";
        $stsm = $conn->prepare($query);
        $stsm->bindParam(":id", $id);
        $stsm->execute();
        $user = $stsm->fetch();

        return $user->name;
    }
    function getUserPages($privilege) {
        return executeQuery("SELECT * FROM user_page up WHERE privilege_id = $privilege");
    }
    function getUserActivities() {
        $userId = $_SESSION["logged_user"]->id;
        $reviews = executeQuery("SELECT *, p.name AS productName, pr.created_at AS creation FROM user u INNER JOIN product_review pr ON u.id = pr.user_id INNER JOIN product p ON p.id = pr.product_id WHERE u.id = $userId");
        $orders = executeQuery("SELECT *, inv.id AS invoiceId, inv.created_at AS creation FROM user u INNER JOIN invoice inv ON u.id = inv.user_id WHERE inv.user_id = $userId");

        $both = array_merge($reviews, $orders);

        // var_dump($reviews);
        // echo "<br><br>";
        // var_dump($orders);

        usort($both, function($a, $b) {
            return strtotime($a->created_at) - strtotime($b->created_at);
        });

        return $both;
    }
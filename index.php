<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    require_once "config/connection.php";

    include "views/fixed/head.php";
?>
<body>
<?php
    if (!isset($_GET['page'])) {
        include "views/pages/home.php";
    }
    else {
        switch($_GET['page']) {
            case 'shop':
                include "views/pages/shop.php";
                break;
            case 'product':
                include "views/pages/product.php";
                break;
            case 'cart':
                include "views/pages/cart.php";
                break;
            case 'checkout':
                include "views/pages/checkout.php";
                break;
            case 'sign_in':
                include "views/pages/sign_in.php";
                break;
            case 'sign_up':
                include "views/pages/sign_up.php";
                break;
            case 'account':
                include "views/pages/account.php";
                break;
            case 'log_off':
                include "views/pages/log_off.php";
                break;
            case 'about':
                include "views/pages/about.php";
                break;
        }
    }

    include "views/fixed/scripts.php";
?>
</body>
</html>
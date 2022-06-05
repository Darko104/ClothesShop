<?php

require_once "config.php";

recordPageAccess();

try {
    $conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo $ex->getMessage();
}

function executeQuery($query, $one = null){
    global $conn;
    if ($one == null) {
        return $conn->query($query)->fetchAll();
    }
    else if ($one == true) {
        return $conn->query($query)->fetch();
    }
}
function executeQueryNoReturn($query) {
    global $conn;
    return $conn->query($query);
}
function recordPageAccess(){
    $open = fopen(LOG_FILE, "a");
    if (isset($_SESSION['logged_user'])) $user = $_SESSION['logged_user']->email;
    else $user = "/";

    if (isset($_GET['page'])) $page = $_GET['page'];
    else $page = "home";

    if (isset($_GET['view'])) $view = " (".$_GET['view'].")";
    else $view = "";

    if($open){
        fwrite($open, "$page$view\t{$_SERVER['REMOTE_ADDR']}\t"."$user\t".time()."\n");
        fclose($open);
    }
}
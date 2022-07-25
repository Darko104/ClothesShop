<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    require_once "config/connection.php";
    include "models/product/functions.php";
    include "models/cart/functions.php";

    $currentPage = "About Me";

    include "views/fixed/head.php";
?>
<body>
<header>
    <?php include 'views/fixed/navigation.php' ?>
</header>
<main id="about-main">
    <div id="about-author">
        <div id="author-empty-side">
            <div id="author-card">
                <div id="card-author-info">
                    <img id="author-picture" src="assets/images/author.jpg">
                    <h5 id="card-author-name">Darko Đukić</h5>
                    <hr class="card-border"></hr>
                    <p id="author-ocupation">Web developer</p>
                </div>
                <div id="author-card-social">
                    <a href="https://www.linkedin.com/in/darko-%C4%91uki%C4%87-568337246/" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="https://github.com/darko104" target="_blank"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </div>
        <div id="author-info">
            <div id="initial-author-info">
                <h1>About me<span id="author-header-colored">!</span></h1>
                <p id="author-basic-info">My name is Darko Đukić, i am a Web Developer from Pančevo, Serbia.</p>
                <div id="author-buttons">
                    <a href="http://darkodjwebdev.com/" target="_blank" class="author-button">My portfolio</a>
                </div>
            </div>
        </div>
    </div>
    <section class="full-page-cover">
        <?php include "views/fixed/aside_menu.php"; include "views/fixed/scripts.php"; ?>
    </section>
</main>
</body>
</html>
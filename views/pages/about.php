<?php
    include "models/product/functions.php";
    include "models/cart/functions.php";

    $currentPage = "About Me";
?>
    <header>
        <?php include 'views/fixed/navigation.php' ?>
    </header>
<main id="about-main">
    <div id="about-author">
        <div id="author-empty-side">
            <div id="author-card">
                <div id="card-author-info">
                    <img id="author-picture" src="assets/images/chameleon.jpg">
                    <h5 id="card-author-name">Darko Đukić</h5>
                    <hr class="card-border"></hr>
                    <p id="author-ocupation">Web developer</p>
                </div>
                <div id="author-card-social">
                    <i class="fab fa-linkedin"></i>
                    <i class="fab fa-github"></i>
                </div>
            </div>
        </div>
        <div id="author-info">
            <div id="initial-author-info">
                <h1>About me<span id="author-header-colored">!</span></h1>
                <p id="author-basic-info">My name is Darko Đukić, i am a Web Developer from Pančevo, Serbia.</p>
                <p id="author-more-info">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos sequi dolor iure perferendis! Vitae inventore aliquid ratione ipsa excepturi, voluptatibus aspernatur!<br><br> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Obcaecati laboriosam impedit dolorum hic pariatur cumque perferendis.</p>
            </div>
        </div>
    </div>
    <section class="full-page-cover">
        <?php include "views/partials/aside_menu.php"; ?>
    </section>
</main>
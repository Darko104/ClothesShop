<?php
    include "models/basic/functions.php";
    include "models/product/functions.php";
    include "models/cart/functions.php";
?>
<header>  
    <?php include 'views/fixed/navigation.php' ?>
</header>
<main>
    <section id="sign-in">
        <h1 class="section-center-title">Customer Login</h1>
        <section id="sign-in-types">
            <div id="sign-in-wrapper">
                <h3 class="sign-in-type-title">Registered customer</h3>
                <p class="sign-in-type-desc">If you have an account, sign in with your email address. If not <a href="index.php?page=sign_up">create it now</a>.</p>
                <form id="sign-in-form" action="models/user/sign_in.php" method="POST" onsubmit="return login.validate()">
                    <?php
                        writeErrorInFormField("sign-in-fail");
                    ?>
                    <?php if( isset($_SESSION["review_info"]) ): 
                    $elementId = $_SESSION["review_info"][0];
                    $elementText = $_SESSION["review_info"][1];
                    ?>
                    <div id="<?=$elementId?>" class="form-alert">
                        <p><?=$elementText?></p>
                    </div>
                    <?php endif; unset( $_SESSION["review_info"] ); ?>
                    <div class="form-field">
                        <label for="sign-in-email" class="form-field-title">Email <span class="required-field">*</span></label>
                        <input type="text" id="sign-in-email" name="sign-in-email" class="basic-input">
                        <p id="sign-in-email-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                        <?php
                            writeErrorInFormField("sign-in-email");
                        ?>
                    </div>
                    <div class="form-field">
                        <label for="sign-in-password" class="form-field-title">Password <span class="required-field">*</span></label>
                        <input type="password" id="sign-in-password" name="sign-in-password" class="basic-input">
                        <p id="sign-in-password-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                        <?php
                            writeErrorInFormField("sign-in-password");
                        ?>
                    </div>
                    <div id="form-sign-info">
                        <div class="radio-wrapper">
                            <input type="checkbox" id="show-password-login">
                            <label for="show-password-login" id="show-password-label">Show password</label>
                        </div>
                        <p id="form-warning-info">* Required Fields</p>
                    </div>
                    <button type="submit" id="finish-sign-in" name="finish-sign-in" class="signing-button">Sign in</button>
                    <?php unset($_SESSION["errors"]); ?>
                </form>
            </div>
            <div id="go-to-signup-wrapper">
                <h3 class="sign-in-type-title">New customer</h3>
                <p class="sign-in-type-desc">Creating an account has many benefits: check out faster, keep more than one address, track orders and more.</p>
                <button id="go-to-sign-up" class="signing-button" onclick="location.href = 'index.php?page=sign_up';">Create an account</button>
            </div>
        </section>
    </section>
    <section class="full-page-cover">
        <?php include "views/partials/aside_menu.php"; ?>
    </section>
</main>
<?php include "views/fixed/footer.php" ?>
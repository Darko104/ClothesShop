<?php
    include "models/basic/functions.php";
    include "models/product/functions.php";
    include "models/cart/functions.php";
?>
<header>
<?php include 'views/fixed/navigation.php' ?>
</header>
<main>
    <section id="register">
        <h1 class="section-center-title">Create New Customer Account</h1>
        <form action="models/user/register.php" method="POST" onsubmit="return register.validate()">
            <div id="register-forms">
                <div class="form-column">
                    <article class="form-wrapper">
                        <div class="form-wrapper-header">
                            <h5>Personal Information</h5>
                        </div>
                        <div class="form-wrapper-fields">
                            <div class="form-field">
                                <label for="register-name" class="form-field-title">First name <span class="required-field">*</span></label>
                                <input type="text" id="register-name" name="register-name" class="basic-input">
                                <p id="register-name-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                                <?php
                                    writeErrorInFormField("register-name");
                                ?>
                            </div>
                            <div class="form-field">
                                <label for="register-surname" class="form-field-title">Last name <span class="required-field">*</span></label>
                                <input type="text" id="register-surname" name="register-surname" class="basic-input">
                                <p id="register-surname-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                                <?php
                                    writeErrorInFormField("register-surname");
                                ?>
                            </div>
                            <div class="form-field">
                                <label for="register-city" class="form-field-title">City<span class="required-field">*</span></label>
                                <input type="text" id="register-city" name="register-city" class="basic-input">
                                <p id="register-city-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                                <?php
                                    writeErrorInFormField("register-city");
                                ?>
                            </div>
                            <div class="form-field">
                                <label for="register-adress" class="form-field-title">Street adress<span class="required-field">*</span></label>
                                <input type="text" id="register-adress" name="register-adress" class="basic-input">
                                <p id="register-adress-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                                <?php
                                    writeErrorInFormField("register-adress");
                                ?>
                            </div>
                            <div class="form-field">
                                <label for="register-phone" class="form-field-title">Phone<span class="required-field">*</span></label>
                                <input type="text" id="register-phone" name="register-phone" class="basic-input">
                                <p id="register-phone-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                                <?php
                                    writeErrorInFormField("register-phone");
                                ?>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="form-column">
                    <article class="form-wrapper">
                        <div class="form-wrapper-header">
                            <h5>Sign-in Information</h5>
                        </div>
                        <div class="form-wrapper-fields">
                            <div class="form-field">
                                <label for="register-email" class="form-field-title">Email <span class="required-field">*</span></label>
                                <input type="text" id="register-email" name="register-email" class="basic-input">
                                <p id="register-email-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                                <?php
                                    writeErrorInFormField("register-email");
                                ?>
                            </div>
                            <div class="form-field">
                                <label for="register-password" class="form-field-title">Password <span class="required-field">*</span></label>
                                <input type="password" id="register-password" name="register-password" class="basic-input">
                                <p id="register-password-info"><span>Password strength</span></p>
                            </div>
                            <div class="form-field">
                                <label for="register-confirm-password" class="form-field-title">Confirm password <span class="required-field">*</span></label>
                                <input type="password" id="register-confirm-password" name="register-confirm-password" class="basic-input">
                                <p id="register-confirm-password-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                            </div>
                            <div class="radio-wrapper">
                                <input type="checkbox" id="show-password-register">
                                <label for="show-password-register" id="show-password-label">Show password</label>
                            </div>
                        </div>
                    </article>
                    <button type="submit" name="finish-registration" id="finish-registration">Create an account</button>
                    <?php unset($_SESSION["errors"]); ?>
                </div>
            </div>
        </form>
    </section>
    <section class="full-page-cover">
        <?php include "views/partials/aside_menu.php"; ?>
    </section>
</main>
<?php include "views/fixed/footer.php" ?>
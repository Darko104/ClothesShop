<?php
    include "models/basic/functions.php";
    include "models/product/functions.php";
    include "models/cart/functions.php";
    include "models/user/functions.php";

    if ( !(isset($_GET["product-quantity"]) && isset($_GET["subtotal"])) ):
        header("Location: index.php?page=cart");
    else:
?>
<header>
<?php include 'views/fixed/navigation.php' ?>
</header>
<?php 
    if (isset($_SESSION["logged_user"])) {
        $user = $_SESSION["logged_user"];
    }
?>
<main>
    <section>
        <div id="checkout-title">
            <h1>Express checkout</h1>
            <p>Please enter your details below to complete your shopping</p>
        </div>
        <section id="checkout-cards">
        <form action="models/order/insert.php" method="post" id="checkout-form" onsubmit="return checkout.validate()">
            <!-- First column -->
            <section id="customer-basic-info" class="form-column">
                <article class="form-wrapper">
                    <div class="form-wrapper-header">
                        <h5>Basic information</h5>
                    </div>
                    <div>
                        <div class="form-field">
                            <label for="checkout-name" class="form-field-title">First Name <span class="required-field">*</span></label>
                            <input type="text" id="checkout-name" name="checkout-name" class="basic-input" value="<?=getUserAttribute("first_name");?>">
                            <p id="checkout-name-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                            <?php
                                writeErrorInFormField("checkout-name");
                            ?>
                        </div>
                        <div class="form-field">
                            <label for="checkout-surname" class="form-field-title">Last Name <span class="required-field">*</span></label>
                            <input type="text" id="checkout-surname" name="checkout-surname" class="basic-input" value="<?=getUserAttribute("last_name");?>">
                            <p id="checkout-surname-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                            <?php
                                writeErrorInFormField("checkout-surname");
                            ?>
                        </div>
                        <div class="form-field">
                            <label for="checkout-email" class="form-field-title">Email Adress<span class="required-field">*</span></label>
                            <input type="email" id="checkout-email" name="checkout-email" class="basic-input" value="<?=getUserAttribute("email");?>">
                            <p id="checkout-email-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                            <?php
                                writeErrorInFormField("checkout-email");
                            ?>
                        </div>
                        <div class="form-field">
                            <label for="checkout-company" class="form-field-title">Company</label>
                            <input type="text" id="checkout-company" name="checkout-company" class="basic-input">
                            <p id="checkout-company-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                            <?php
                                writeErrorInFormField("checkout-company");
                            ?>
                        </div>
                        <div class="form-field">
                            <label for="checkout-phone"class="form-field-title">Phone Number <span class="required-field">*</span></label>
                            <input type="number" id="checkout-phone" name="checkout-phone" class="basic-input" value="<?=getUserAttribute("phone");?>">
                            <p id="checkout-phone-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                            <?php
                                writeErrorInFormField("checkout-phone");
                            ?>
                        </div>
                    </div>
                </article>
            </section>
            <!-- Second column -->
            <section id="customer-shopping-methods" class="form-column">
                <article class="form-wrapper">
                    <div class="form-wrapper-header">
                        <h5>Shipping adress</h5>
                    </div>
                    <div>
                        <div class="form-field">
                            <label for="checkout-city" class="form-field-title">City <span class="required-field">*</span></label>
                            <input type="text" id="checkout-city" name="checkout-city" class="basic-input" value="<?=getUserAttribute("city");?>">
                            <p id="checkout-city-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                            <?php
                                writeErrorInFormField("checkout-city");
                            ?>
                        </div>
                        <div class="form-field">
                            <label for="checkout-adress" class="form-field-title">Street Adress <span class="required-field">*</span></label>
                            <input type="text" id="checkout-adress" name="checkout-adress" class="basic-input" value="<?=getUserAttribute("street_adress");?>">
                            <p id="checkout-adress-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                            <?php
                                writeErrorInFormField("checkout-adress");
                            ?>
                        </div>
                        <div class="form-field">
                            <label for="checkout-zip" class="form-field-title">Zip/Postal Code <span class="required-field">*</span></label>
                            <input type="text" id="checkout-zip"  name="checkout-zip" class="basic-input">
                            <p id="checkout-zip-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                            <?php
                                writeErrorInFormField("checkout-zippostalcode");
                            ?>
                        </div>
                        <div class="form-field">
                            <label for="checkout-shipping-comment" class="form-field-title">Delivery Comment:</label>
                            <input type="textarea" id="checkout-shipping-comment" name="checkout-shipping-comment" class="basic-input">
                        </div>
                    </div>
                </article>
                <article class="form-wrapper">
                    <div class="form-wrapper-header">
                        <h5>Payment method</h5>
                    </div>
                    <div>
                        <div class="radio-group-vertical">
                            <div class="radio-wrapper">
                                <input type="radio" name="payment-type" id="payment-type-credit" value="credit">
                                <label for="payment-type-credit">Credit card</label>
                            </div>
                            <div class="radio-wrapper">
                                <input type="radio" name="payment-type" id="payment-type-delivery" value="cash">
                                <label for="payment-type-delivery">Cash</label>
                            </div>
                        </div>
                        <p id="checkout-payment-info" class="form-error form-error-margin"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                        <?php
                            writeErrorInFormField("checkout-payment", "form-error-margin");
                        ?>
                    </div>
                </article>
            </section>
            <!-- Third column -->
            <section id="checkout-summary" class="form-column">
                <article class="form-wrapper">
                    <div class="form-wrapper-header">
                        <h5>Order Summary</h5>
                    </div>
                    <?php 
                        $productsIdQuantity = $_GET["product-quantity"];
                        $numberOfProducts = count($productsIdQuantity);

                        $pluralCheck = "";
                        $numberOfShownProducts = 2;
                        if ($numberOfProducts > 1) {
                            $pluralCheck = "s";
                        }
                        else $numberOfShownProducts = 1;
                    ?>
                    <div id="checkout-view-products">
                    <a href="index.php?page=cart" target="_blank">
                        <div id="checkout-products-show">
                            <p><span id="checkout-number-of-products"><?=$numberOfProducts?></span> item<?=$pluralCheck?> in cart</p>
                            <p id="back-to-cart">(click to view all)</p>
                        </div>
                        <div id="checkout-product-list">
                            <?php 
                                for ($i = 0; $i < $numberOfShownProducts; $i++):
                                    $product = explode(",", $productsIdQuantity[$i]);
                                    $product = getProductById($product[0]);
                            ?>
                            <div class="checkout-product">
                                <img src="assets/images/<?=$product->imageName?>" class="checkout-product-image">
                                <div class="checkout-product-info">
                                    <p class="checkout-product-name"><?=$product->productName?></p>
                                    <p class="checkout-product-price">$<?=$product->current_price?></p>
                                </div>
                            </div>
                            <?php endfor; ?>
                        </div>
                        <p id="more-in-cart"><i class="fa-solid fa-ellipsis"></i></p>
                    </a>
                    </div>
                    <div class="checkout-info">
                        <p>Cart subtotal</p>
                        <p>$<?=$_GET["subtotal"]?></p>
                    </div>
                    <div class="checkout-info">
                        <p>Shipping</p>
                        <p>$5.00</p>
                    </div>
                    <div class="checkout-info">
                        <p>Order total</p>
                        <p>$<?=$_GET["subtotal"] + 5?></p>
                    </div>
                    <div>
                        <div class="form-field">
                            <label for="checkout-order-comment" class="form-field-title">Order comment:</label>
                            <textarea id="checkout-order-comment" name="checkout-order-comment" placeholder="If you have any comment about your order, please, enter it here..." rows="4"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="query" value="<?=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']?>">
                    <input type="hidden" name="price" value="<?=$_GET["subtotal"]?>">
                    <?php 
                        foreach($productsIdQuantity as $idQuantity):
                    ?>
                        <input type="hidden" name="product-quantity[]" value="<?=$idQuantity?>">
                    <?php endforeach; ?>
                    <button type="submit" name="finish-order" id="finish-order">Place order</button>
                    <?php unset($_SESSION["errors"]); unset($_SESSION["openShippingAdress"]); ?>
                </article>
            </section>
        </form>
        </section>
    </section>
    <section class="full-page-cover">
        <?php include "views/partials/aside_menu.php"; ?>
    </section>
</main>
<?php include "views/fixed/footer.php" ?>
<?php endif; ?>
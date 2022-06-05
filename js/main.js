window.onload = function () {
    /* Index */
    $(".initial-carousel-arrow").click(function () {
        slider.nextSerial(this);
    })
    $(".header-featured-product").click(function () {
        slider.selectProduct(this);
    })
    $(".product-track-category").click(function () {
        productsSearch.toggleFeaturedCollection(this);
    })
    /* Navigation */
    $("#action-user").click(function (e) {
        e.stopPropagation();
        navigation.openUserMenu();
    });
    $(document).click(function () {
        navigation.closeUserMenu();
    })
    /* Navigation - extend */
    $("#link-shop").click(function () {
        navigation.openShopLinks();
    })
    /* Navigation - open sidebar (small devices) */
    $("#nav-bar-open").click(function () {
        fullScreenModal.openChildElement("#aside-menu", "initial");
    })
    $(".aside-link-title").click(function () {
        var arrow = $(this).find('i')[0];
        $(this).siblings(".aside-submenu").slideToggle();
        console.log( $(this).siblings(".aside-submenu") );
        $(arrow).css('transform', ($(arrow).css('transform') == 'none') ? 'rotate(180deg)' : 'none');
    })
    /* Modal */
    $(".close-modal").click(function () {
        fullScreenModal.closeModal();
    })
    /* Registration */
    $("#register-password").keyup(function() {
        register.livePasswordCheck();
    });
    $("#show-password-register").change(function () {
        generalLoginOptions.showPasswords(["#register-password", "#register-confirm-password"], $(this).prop('checked'));
    })
    /* Login */
    $("#show-password-login").change(function () {
        generalLoginOptions.showPasswords(["#sign-in-password"], $(this).prop('checked'));
    })
    /* User account - show more user update fields */
    $("#message-hidden-fields").click(function () {
        update.openMoreFields();
    })
    /* Shop */
    /* Shop - On change forms */
    $("#products-form").on("change", "input:checkbox", function () {
        $("#products-form").submit();
    })
    $("#product-search-icon").click(function () {
        $("#products-form").submit();
    })
    $('input[type=radio][name=pagination]').change(function() {
        $("#products-form").submit();
    })
    $("#product-amount").change(function () {
        $("#products-form").submit();
    })
    // Shop - Sorting
    $("#products-sort").change(function () {
        $("#products-form").submit();
    })
    $("#change-sort-type").click(function () {
        productsSearch.changeSortType();
        $("#products-form").submit();
    })
    // Shop - Product quick view
    $(".quick-view").click(function () {
        productsSearch.openQuickView($(this).data("id"));
    })
    $(".full-page-cover").click(function () {
        fullScreenModal.closeModal();
    })
    $("#specific-product-quick-view").on("click", ".close-modal", function () {
        fullScreenModal.closeModal();
    })
    /* Shop - open filter menus (for small devices) */
    $(".filter-products-header-parameter").click(function () {
        productsSearch.writeFilterValuesInModal(this);
    })
    // Select another product image
    $("#specific-product-quick-view").on("click", ".aside-image", function () {
        productsSearch.changeShowcasedImage(this);
    })
    $(".aside-image").click(function () {
        productsSearch.changeShowcasedImage(this);
    })
    // Add to wishlist
    $("#specific-product-quick-view").on("click", ".add-to-wishlist", function () {
        wishlist.add(this);
    })
    $(".add-to-wishlist").click(function () {
        wishlist.add(this);
    })
    $("#specific-product-quick-view").on("click", ".remove-from-wishlist", function () {
        wishlist.remove(this);
    })
    $(".remove-from-wishlist").click(function () {
        wishlist.remove(this);
    })
    // Add to cart
    $("#specific-product-quick-view").on("click", ".cart-custom-qty", function () {
        cart.add(this)
    })
    $(".cart-custom-qty").click(function () {
        cart.add(this)
    })
    // Add to cart - default value. If a user adds product to cart from products preview card, default quantity value will be assigned.
    $("#featured-products-track").on("click", ".cart-custom-qty", function () {
        cart.add(this, "default");
    })
    $(".product-card-action .cart-default-qty").click(function () {
        cart.add(this, "default")
    })
    // Cart - change quantity
    $("#specific-product-quick-view").on("click", ".change-quantity", function () {
        var productId = $(this).data("id");
        var direction = $(this).data("direction");
        cart.changeInputQuantity(direction, ".pq-input[data-id='"+productId+"']");
    })
    $(".change-quantity").click(function () {
        console.log(123)
        var id = $(this).data("id");
        var direction = $(this).data("direction");
        var canQuantityChange = cart.changeInputQuantity(direction, ".pq-input[data-id='"+ id +"']");
        // In "cart" page , user can change quantity for each product. Product id is needed for each specific quantity input that is requiring change, so that only one gets changed.
        var page = $(this).data("page");
        if (canQuantityChange && page == "cart") {
            var newQuantity = $(".pq-input[data-id='"+ id +"']").val();
            cart.changeCookieQuantity(id, newQuantity);
        }
        // In specific product page, knowing specific input id is not needed and neither is changing values inside cookie.
    })
    // Cart - remove item
    $(".remove-from-cart").click(function () {
        var id = $(this).data("id");
        cart.removeProduct(id);
    })
    $("#clear-cart").click(function () {
        cart.emptyCart();
    })
    // Cart - item in cart, redirect to cart page
    $('#specific-product-quick-view, #featured-products-track').on('mouseenter', ".in-cart", function() {
        cart.cartActionButtonText(this, "View cart")
    });
    $('#specific-product-quick-view, #featured-products-track').on('mouseleave', ".in-cart", function() {
        cart.cartActionButtonText(this, "Item in cart")
    });
    $("#specific-product-quick-view, #featured-products-track").on("click", ".in-cart", function () {
        window.location = "index.php?page=cart";
    })
    $(".in-cart").bind({
        'mouseenter': function(){cart.cartActionButtonText(this, "View cart")},
        'mouseleave': function(){cart.cartActionButtonText(this, "Item in cart")},
        'click': function () {window.location = "index.php?page=cart";}
    });
    // Checkout - open shipping methods
    // $("input[name='shipping-type']").change(function () {
    //     var type = $(this).val();
    //     checkout.openShippingMethod(type);
    // })
    // User account - view full order
    $(".view-order, .single-order-products").click(function () {
        order.viewFullOrder($(this).data("invoiceid"));
    })
    // User account - cancel order
    $("#view-order").on("click", "#cancel-order", function () {
        order.cancelOrder($(this).data("invoiceid"));
    })
    $(".cancel-order").click(function () {
        order.cancelOrder($(this).data("invoiceid"));
    })
    // Rate product - stars
    $(".send-rate-star").on("mouseenter", function () {
        var serial = $(this).data("serial");
        review.markStars(serial);
    })
    $(".send-rate-star").click(function () {
        var serial = $(this).data("serial");
        var inputElement = $("input[name='review-rating']");
        review.selectRating(serial, inputElement);
    })
    // Admin Panel
    $(".panel-delete-btn").click(function () {
        panel.removeProduct(this);
    })
    // Admin Panel - search products
    $("#panel-product-search").click(function () {
        panel.searchProducts();
    })
    // Admin Panel - New product - add image
    $("#product-images-preview-add").on("change", ".product-add-image", function () {
        panel.showPendingImage(this);
    })
    $(".product-add-image").change(function (e) {
        e.stopImmediatePropagation();
        panel.showPendingImage(this);
    })
    // Admin Panel - New product - remove image
    $("#product-images-preview-add").on("click", ".cancel-image", function () {
        panel.removePendingImage(this);
    });
    // Propagation
    $("#aside-menu, #nav-user-menu, #filter-products-menu, #view-order, #specific-product-quick-view").click(function (e) {
        e.stopPropagation();
    })
}
const form = (() => {
    const validateMultipleFields = (fieldsArray, formType, previousTests) => {
        var inputFields = generalLoginOptions.getFieldsForValidation(fieldsArray);

        var didAllPass = true;
        for (var input of inputFields) {
            var currentInputValue = $("#"+formType+"-"+input.field).val();
            var regexValues = input.regex;
            var inputErrorField = $("#"+formType+"-"+input.field + "-info");
            console.log(currentInputValue)

            var didSinglePass = true;
            for (var singleRegex of regexValues) {
                if(!singleRegex.test(currentInputValue)) {
                    didAllPass = false;
                    didSinglePass = false;
                    inputErrorField.css("display", "flex");
                    inputErrorField.children("span").text(input.errorMessage);
                }
            }
            if(didSinglePass) {
                $(input.field).css("border", "1px solid green");
                inputErrorField.css("display", "none");
            }
        }

        if (previousTests == false) {
            return false;
        }
        else return didAllPass;
    }

    return { validateMultipleFields }
})();
const generalLoginOptions = (() => {
    const inputFieldsAndRegexRules = 
    [{field: "name", regex: [/^[A-z]{1,80}$/], errorMessage: "Name can only contain letters, between 1 and 50 in length. Example: Peter."}, {field: "surname", regex: [/^[A-z]{2,50}(\s[A-Z][a-z]{2,50})*$/], errorMessage: "Last name can only contain letters, between 2 and 50 for each last name. Example: Smith Jones."}, /*{field:"#register-country", regex: [/^[0-9]{1,3}$/]},*/ {field: "city", regex: [/^(\s*[A-z]{1,50})+$/], errorMessage: "City name can only contain letters, between 1 and 50 for each word. Example: Mexico City."}, {field:"adress", regex: [/^[A-z]{2,20}(\s[A-z]{2,20})*\s[0-9]{1,10}([A-z]{1,3})*$/], errorMessage: "Adress can only contain street name and number. Example: Zdravka Celara 16B."}, {field: "company", regex: [/^$|(?!\s)(?!.*\s$)(?=.*[a-zA-Z0-9])[a-zA-Z0-9 '~?!]{2,}$/], errorMessage: "Company name can only contain letters, numbers and special characters ('~?!). Example: McDonald's."}, {field: "phone", regex: [/^(\+?[0-9]|\s){8,15}$/], errorMessage: "Please enter a valid number. Examples: +38160 00 0000, 51685409253"}, {field: "zip", regex: [/^[0-9]{5}$/], errorMessage: "Zip/Postal Code can contain only 5 numbers. Example: 18228."}, {field: "email", regex: [/^[a-z\d\_\.\-]+\@[a-z\d]+(\.[a-z]{2,4})+$/], errorMessage: "Icorrect email form. Example: name.surname@email.com"}, {field: "password", regex: [/^.{4,50}$/, /[a-z]|[A-Z]/, /[0-9]/], errorMessage: "Password must contain between 4 and 50 characters with at least one letter and one number."}, {field: "nickname", regex: [/^[\w]{2,50}$/], errorMessage: "Nickname can only contain letters, numbers and '_' character. Minimum length is 2 and maximum is 80."}, {field: "summary", regex: [/^[\w\s?!.,:"'@]{3,100}$/], errorMessage: "Review summary can only contain letters, numbers and certain special characters: ?!.,:\"'@. Minimum length is 3 and maximum 100."}, {field: "review", regex: [/^[\w\s?!.,:"'@]{3,200}$/], errorMessage: "Review can only contain letters, numbers and certain special characters: ?!.,:\"'@. Minimum length is 3 and maximum 200."}, {field: "rating", regex: [/^[12345]$/], errorMessage: "Plase, use rating system as intended."}];

    const showPasswords = (fieldsArray, isChecked) => {
        if (isChecked) {
            for (var passwordField of fieldsArray) {
                $(passwordField).attr("type", "text")
            }
        }
        else {
            for (var passwordField of fieldsArray) {
                $(passwordField).attr("type", "password")
            }
        }
    }
    const getFieldsForValidation = (wantedFields) => {
        var search;
        if(Array.isArray(wantedFields)) {
            search = [];
            for (var field of wantedFields) {
                var searchedField = inputFieldsAndRegexRules.find(i => i.field == field);
                if (searchedField != undefined) search.push(searchedField);
            }
        }
        else {
            search = inputFieldsAndRegexRules.find(i => i.field == wantedFields);
        }

        return search;
    }
    return {
        showPasswords, getFieldsForValidation
    }
})();
const navigation = (() => {
    var navUserMenuOpen =  $("#nav-user-menu");

    const openUserMenu = () => {
        if (navUserMenuOpen.css("display") == "none") {
            navUserMenuOpen.css("display", "flex");
        }
        else {
            navUserMenuOpen.css("display", "none");
        }
    }
    const closeUserMenu = () => {
        navUserMenuOpen.css("display", "none");
    }
    const openShopLinks = () => {
        $("#extended-navigation").slideToggle();
    }

    return {
        openUserMenu, closeUserMenu, openShopLinks
    }
})();
const fullScreenModal = (() => {
    const closeModal = () => {
        $(".full-page-cover").css("display", "none");
        $(".full-page-cover").children().css("display", "none");
    }
    const openChildElement = (elementName, displayType) => {
        $(".full-page-cover").css("display", "flex");
        $(".full-page-cover").children().css("display", "none");
        $(".full-page-cover " + elementName).css("display", displayType);
    }

    return { closeModal, openChildElement }
})();
const slider = (() => {
    var isArrowDisabled = false;
    var currentSerial = 0;
    const directionsAndClasses = [{direction: "backward", class: "backward-slider"}, {direction: "forward", class: "forward-slider"}, {direction: "upward", class: "upward-slider"}];

    const sliderFields = {
        name: $("#header-product-basic h2"),
        price: $("#header-product-price"),
        brand: $("#header-product-brand"),
        image: $("#header-carousel-image img"),
        buyButton: $("#slider-buy")
    }
    const nextSerial = (button) => {
        if (isArrowDisabled == false) {
            isArrowDisabled = true;

            var direction = $(button).data("direction");
            if (direction == "backward") {
                if (currentSerial == 0) currentSerial = 2;
                else currentSerial -= 1;
            }
            else if (direction == "forward") {
                if (currentSerial == 2) currentSerial = 0;
                else currentSerial += 1;
            }

            slider.addAnimation(direction);
        }
    }
    const selectProduct = (element) => {
        if (isArrowDisabled == false) {
            isArrowDisabled = true;

            var serial = $(element).data("serial");
            currentSerial = serial;
    
            slider.addAnimation("upward");
        }
    }
    const addAnimation = (direction) => {
        let animationClass = directionsAndClasses.find(e => e.direction === direction).class;
        $("#header-carousel-image, #header-featured-product-info").addClass(animationClass);
        setTimeout(() => {
            writeNewValuesInSlider();
        }, 500);
        setTimeout(function(){
            isArrowDisabled = false;
            $("#header-carousel-image, #header-featured-product-info").removeClass(animationClass);
        }, 1200);
    }
    const writeNewValuesInSlider = () => {
        var element =  $(".header-featured-product[data-serial='"+currentSerial+"']");
        $(sliderFields.name).text(element.data("name"));
        $(sliderFields.price).text("$ "+element.data("price"));
        $(sliderFields.brand).text(element.data("brand"));
        $(sliderFields.image).attr("src", "assets/images/"+element.data("image"));
        $(sliderFields.buyButton).attr("href", "index.php?page=product&productId="+element.data("productid"))
    }

    return { addAnimation, nextSerial, selectProduct }
})();
const register = (() => {
    const validate = () => {
        var didAllTestsPass = true;
        /* Check if regex values math user input. If they don't, display error message. */
        var registerInputFields = generalLoginOptions.getFieldsForValidation(["name", "surname", "city", "adress", "phone", "email", "password"]);

        for (var input of registerInputFields) {
            var currentInputValue = $("#register-"+input.field).val();
            var regexValues = input.regex;
            var inputErrorField = $("#register-"+input.field + "-info");

            for (var singleRegex of regexValues) {
                if(!singleRegex.test(currentInputValue)) {
                    didAllTestsPass = false;
                    inputErrorField.css("display", "flex");
                    inputErrorField.children("span").text(input.errorMessage);
                }
            }
            if(didAllTestsPass) {
                $(input.field).css("border", "1px solid green");
                inputErrorField.css("display", "none");
            }
        }
        /* Check if passwords match */
        var passwordFirstField = $("#register-password");
        var passwordSecondField = $("#register-confirm-password");
        var passwordCheckErrorField = $("#register-confirm-password-info");

        if (passwordFirstField.val() != passwordSecondField.val()) {
            var didAllTestsPass = false;
            passwordCheckErrorField.css("display", "flex");
            passwordCheckErrorField.children("span").text("Passwords do not match");
        }
        return didAllTestsPass;
    }
    const livePasswordCheck = () => {
        var passwordInput = generalLoginOptions.getFieldsForValidation("password");
        var passwordValue = $("#register-"+passwordInput.field).val();
        var passwordStrengthInfo = "";
        var backgroundColor;
        var textColor;

        var isRegexRight = true;
        for (var regex of passwordInput.regex) {
            if (!regex.test(passwordValue)) {
                isRegexRight = false;
                passwordStrengthInfo = passwordInput.errorMessage;
                textColor = "#cf454a";
                backgroundColor = "#ffeeee";
            }
        }
        if (isRegexRight) {
            if(passwordValue.length > 5 && passwordValue.length <= 10) {
                passwordStrengthInfo = "Weak password";
                textColor = "#6b6b6b";
                backgroundColor = "#f4f4f4";
            }
            else if (passwordValue.length > 10 && passwordValue.length <= 15) {
                passwordStrengthInfo = "Medium password";
                textColor = "rgb(64 62 1)";
                backgroundColor = "#ffff66";
            }
            else if (passwordValue.length > 15) {
                passwordStrengthInfo = "Strong password";
                textColor = "#005800";
                backgroundColor = "#84f27e";
            }
        }

        $("#register-password-info").css({"background-color": backgroundColor, "color": textColor}).text(passwordStrengthInfo);
    }
    return {
        validate, livePasswordCheck
    }
})();
const login = (() => {
    const validate = () => {
        var didAllTestsPass = true;
        var loginInputFields = generalLoginOptions.getFieldsForValidation(["email", "password"]);

        for (var input of loginInputFields) {
            var currentInputValue = $("#sign-in-"+input.field).val();
            var regexValues = input.regex;
            var inputErrorField = $("#sign-in-"+input.field + "-info");

            for (var singleRegex of regexValues) {
                if(!singleRegex.test(currentInputValue)) {
                    didAllTestsPass = false;
                    inputErrorField.css("display", "flex");
                    inputErrorField.children("span").text(input.errorMessage);
                }
            }
            if(didAllTestsPass) {
                inputErrorField.css("display", "none");
            }
        }

        return didAllTestsPass;
    }

    return {
        validate
    }
})();
const update = (() => {
    const validate = () => {
        var didAllTestsPass = true;
        var updateInputFields = generalLoginOptions.getFieldsForValidation(["name", "surname", "city", "adress", "phone", "email"]);

        for (var input of updateInputFields) {
            var currentInputValue = $("#update-"+input.field).val();
            var regexValues = input.regex;
            var inputErrorField = $("#update-"+input.field + "-info");

            for (var singleRegex of regexValues) {
                if(!singleRegex.test(currentInputValue)) {
                    didAllTestsPass = false;
                    inputErrorField.css("display", "flex");
                    inputErrorField.children("span").text(input.errorMessage);
                }
            }
            if(didAllTestsPass) {
                $(input.field).css("border", "1px solid green");
                inputErrorField.css("display", "none");
            }
        }
        return didAllTestsPass;
    }
    const openMoreFields = () => {
        $("#hidden-form-fields").toggle();
        var arrowForHiddenFields = $("#message-hidden-fields i");
        if (arrowForHiddenFields.css("transform") == "matrix(1, 0, 0, -1, 0, 0)") {
            $("#message-hidden-fields i").css("transform", "scaleY(1)");
        }
        else {
            $("#message-hidden-fields i").css("transform", "scaleY(-1)");
        }
    }

    return {
        validate, openMoreFields
    }
})();
const productsSearch = (() => {
    const toggleFeaturedCollection = (element) => {
        var collection = $(element).data("collection");
        $.ajax({
            url: "models/product/get_featured.php",
            method: "POST",
            data: {
                collection: collection
            },
            dataType: "json",
            success: function (response) {
                var products = response.products;
                var cartIds = response.productIdsInCart;
                html = "";

                for (var product of products) {
                    if (cartIds.includes(product.productId)) {
                        var mainButtonClasses = "in-cart";
                        var mainButtonText = "Item in cart";
                    }
                    else {
                        var mainButtonClasses = "cart-custom-qty";
                        var mainButtonText = "Add to cart";
                    }
                    html += `
                    <article class="product-card">
                        <img src="assets/images/${product.imageName}">
                        <div class="product-card-info">
                            <p class="product-card-name">
                                <a href="product.php?productId=${product.productId}">${product.productName}</a>
                            </p>
                            <p class="product-card-brand">${product.brandName}</p>
                            <p class="product-card-price">`
                            if (product.old_price != null) {
                                html += `<span class="current-price" style="color:#cc1414;">$${product.current_price}</span>
                                <span class="old-price">$${product.old_price}</span>`;
                            }
                            else {
                                html += `<span class="current-price">$${product.current_price}</span>`;
                            }
                            html +=
                            `</p>
                        </div>
                        <div class="product-card-action">
                            <button type="button" class="main-action-button ${mainButtonClasses} invisible-button" data-id="${product.productId}">${mainButtonText}</button>
                        </div>
                    </article>
                    `;
                }
                $("#featured-products-track").html(html);
                markFeaturedCollection(element);
            },
            error: function (error, status, statusText) {
                console.error('Error getting product:'+error.responseText);

                console.log(error.parseJSON);
                alert(error.parseJSON.error);
            }
        })
    }
    const markFeaturedCollection = (element) => {
        $(".product-track-category").removeClass("product-track-category-active");
        $(element).addClass("product-track-category-active");
    }
    const changeSortType = () => {
        var value = $("#sort-type").val();

        if (value == "asc") {
            $("#sort-type").val("desc");
            $("#change-sort-type").css("transform", "rotate(180deg)");
        }
        else {
            $("#sort-type").val("asc");
            $("#change-sort-type").css("transform", "rotate(0deg)");
        }
    }
    const openQuickView = (id) => {
        console.log(id)
        $.ajax({
            url: "models/product/get_one.php",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function (product) {
                console.log(product);

                if (product.inCart) {
                    var mainButtonClasses = "in-cart";
                    var mainButtonText = "Item in cart";
                }
                else {
                    var mainButtonClasses = "cart-custom-qty";
                    var mainButtonText = "Add to cart";
                }
                var ratingHTML = review.writeStars(product.rating);

                var html = `
                <div id="quick-view-images">
                    <div id="quick-view-all-images">`
                    for(var i = 0; i < product.images.length; i++) {
                        if (i == 0) {
                            html += `<img src="assets/images/${product.images[i].name}" class="aside-image aside-image-selected">`;
                        }
                        else {
                            html += `<img src="assets/images/${product.images[i].name}" class="aside-image">`;
                        }
                    }
                    html += `
                    </div>
                    <img src="assets/images/${product.images[0].name}" id="quick-view-wide-image" class="main-showcased-image">
                    <div id="quick-view-change-image">
                        <i class="fas fa-arrow-alt-circle-left quick-view-change-icon"></i>
                        <i class="fas fa-arrow-alt-circle-right quick-view-change-icon"></i>
                    </div>
                </div>
                <div id="specific-product-info">
                    <div id="specific-product-info-header">
                        <h3 class="specific-product-name">${product.productName}</h3>
                        <div class="quick-view-rating">`;
                            html += ratingHTML;
                html += `</div>
                        <p id="quick-view-price">$${product.current_price}</p>
                    </div>
                    <div id="specific-product-info-body">
                        <div class="product-attributes">
                            <p class="product-attribute"><span class="pa-key">Availability:</span> <span id="product-stock-info">In stock</span></p>
                            <p id="product-code" class="product-attribute"><span class="pa-key">PID:</span> <span>${product.productId}</span></p>
                        </div>
                        <p id="product-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque assumenda blanditiis consequatur eius non!</p>
                        <div id="product-finish-purchase">
                            <div class="product-quantity">
                                <input type="number" class="pq-input" data-id="${product.productId}" value="1" max="15">
                                <div class="product-quantity-change">
                                    <i class="fas fa-chevron-up change-quantity" data-id="${product.productId}" data-direction="up"></i>
                                    <i class="fas fa-chevron-down change-quantity" data-id="${product.productId}" data-direction="down"></i>
                                </div>
                            </div>
                            <button class="${mainButtonClasses}" data-id="${product.productId}">${mainButtonText}</button>
                        </div>`
                        if (product.isWishlist == 1) {
                            html += `<p id="specific-product-add-to-wishlist" class="remove-from-wishlist" data-id="${product.productId}" data-refresh="false"><i class="fa-solid fa-heart"></i><span>Remove from wishlist<span></p>`;
                        }
                        else {
                            html += `<p id="specific-product-add-to-wishlist" class="add-to-wishlist" data-id="${product.productId}" data-refresh="false"><i class="fa-solid fa-heart"></i><span>Add to wishlist</span></p>`;
                        }
                    html += `</div>
                    <div id="specific-product-info-footer">
                        <div class="product-attributes">
                            <p id="product-tags" class="product-attribute"><span class="pa-key">Categories:</span> <span>Sport, Shop, Newest</span></p>
                            <p id="product-brands" class="product-attribute"><span class="pa-key">Brand:</span> <span>${product.brandName}</span></p>
                        </div>
                    </div>
                </div>
                <div id="specific-product-quick-view-close" class="close-modal">X</div>
                `;
                fullScreenModal.openChildElement("#specific-product-quick-view", "grid");
                $("#specific-product-quick-view").html(html);
            },
            error: function (error, status, statusText) {
                console.error('Error getting product:'+error.responseText);

                console.log(error.parseJSON);
                alert(error.parseJSON.error);
            }
        })
    }
    const changeShowcasedImage = (clickedImage) => {
        var src = $(clickedImage).attr("src");
        console.log(src)
        $(".aside-image-selected").removeClass("aside-image-selected");
        $(clickedImage).addClass("aside-image-selected");

        $(".main-showcased-image").attr("src", src);
    }
    const writeFilterValuesInModal = (element) => {
        var type = $(element).data("type");

        $.ajax({
            url: "models/product/get_modal_values.php",
            method: "POST",
            data: {
                type: type
            },
            dataType: "json",
            success: function (values) {
                var html = "";

                // Already selected values by type
                var url = new URL(window.location.href);
                var selectedValues = url.searchParams.getAll(type+"[]");

                for (var value of values) {
                    var valueId = value[Object.keys(value)[0]];
                    
                    if ( selectedValues.includes(valueId) ) var selectedClass = "menu-filter-selected-parameter";
                    else var selectedClass = "";

                    html += `
                    <label for="${type}-${valueId}" class="menu-filter-single-parameter ${selectedClass}">
                    <p class="menu-parameter-name">${value[Object.keys(value)[1]]}&nbsp;<span class="menu-parameter-count">(${value[Object.keys(value)[2]]})</span></p>
                    <i class="fas fa-check"></i>
                    </label>
                    `;
                }
                $("#filter-products-menu-body").html(html);
                $("#filter-products-menu-header h3").text(type);
                fullScreenModal.openChildElement("#filter-products-menu", "initial");
            },
            error: function (error, status, statusText) {
                if (error.status == 409) {
                    var response = JSON.parse(error.responseText);
                    alert(response.message);
                }
                else if (error.status == 500) {
                    console.error('Error entering data:'+error.status);

                    console.log(error.parseJSON);
                    alert(error.parseJSON.error);
                }
            }
        })
    }

    return {
        toggleFeaturedCollection, changeSortType, openQuickView, changeShowcasedImage, writeFilterValuesInModal
    }
})();
const wishlist = (() => {
    const add = (element) => {
        var id = $(element).data("id");
        $.ajax({
            url: "models/wishlist/insert.php",
            method: "POST",
            data: {
                productId: id
            },
            dataType: "json",
            success: function (response) {
                alert(response.message);
                $(element).removeClass("add-to-wishlist");
                $(element).addClass("remove-from-wishlist");
                $(element).find("span").text("Remove from wishlist");
            },
            error: function (error, status, statusText) {
                if(error.status == 401){
                    window.location.href = "index.php?page=sign_in";
                }
                else if (error.status == 409) {
                    var response = JSON.parse(error.responseText);
                    alert(response.message);
                }
                else if (error.status == 500) {
                    console.error('Error entering data:'+error.status);

                    console.log(error.parseJSON);
                    alert(error.parseJSON.error);
                }
            }
        })
    }
    const remove = (element) => {
        var id = $(element).data("id");
        var refresh = $(element).data("refresh");
        console.log(id);
        $.ajax({
            url: "models/wishlist/delete.php",
            method: "POST",
            data: {
                productId: id
            },
            dataType: "json",
            success: function (response) {
                alert(response.message);
                $(element).removeClass("remove-from-wishlist");
                $(element).addClass("add-to-wishlist");
                $(element).find("span").text("Add to wishlist");

                if (refresh == true) {
                    location.reload();
                }
            },
            error: function (error, status, statusText) {
                if(error.status == 401){
                    window.location.href = "index.php?page=sign_in";
                }
                else if (error.status == 404) {
                    var response = JSON.parse(error.responseText);
                    alert(response.message);
                }
                else if (error.status == 500) {
                    console.error('Error entering data:'+error.status);

                    console.log(error.parseJSON);
                    alert(error.parseJSON.error);
                }

            }
        })
    }

    return { add, remove }
})();
const cart = (() => {
    const add = (element, quantityValue = "custom") => {
        var productId = $(element).data("id");
        if (quantityValue == "default") {
            var quantity = 1;
        }
        else if (quantityValue == "custom") {
            var quantity = parseInt($(".pq-input[data-id='"+productId+"']").val());
        }
        //var id = $(element).data("id");
        console.log(productId, quantity);

        $.ajax({
            url: "models/cart/insert.php",
            method: "POST",
            data: {
                productId: productId,
                quantity: quantity
            },
            dataType: "json",
            success: function (response) {
                console.log("Is authenticated " + response.authentication)
                if (response.authentication == false) {
                    cart.addWithoutAuthentication(productId, quantity);
                }
                else {
                    $("#products-in-cart span").text(response.numberOfPr);
                    
                    setTimeout(function () { alert(response.message); }, 100)
                }
                cart.disableCartInsertButton(element);
            },
            error: function (error, status, statusText) {
                if (error.status == 409) {
                    var response = JSON.parse(error.responseText);
                    alert(response.message);
                }
                else {
                    console.error('Error getting product:'+error.status);

                    console.log(error.parseJSON);
                    alert(error.parseJSON.error);
                }
            }
        })
    }
    const addWithoutAuthentication = (id, quantity) => {
        var cartCookie = cookie.getCookieValue("cart");
        if (cartCookie == null) { // If cart is empty
            console.log("nema");
            var newValues = [[id, quantity]];
            cookie.setCookie("cart", JSON.stringify(newValues), 7);
            alert("Item added.");
        }
        else { // If cart isn't empty
            console.log("ima");
            var currentCart = JSON.parse(cookie.getCookieValue("cart"));
            var existance = cart.checkIfProductInCookie(id, currentCart);

            if (existance) {
                alert("This item is already in your cart.")
            }
            else {
                currentCart.push([id, quantity]);
                cookie.setCookie("cart", JSON.stringify(currentCart), 7);
                alert("Item added to your cart.");
                console.log(cookie.getCookieValue("cart"));
            }
        }
        var numberOfPr = JSON.parse(cookie.getCookieValue("cart")).length;
        $("#products-in-cart span").text(numberOfPr);
    }
    const checkIfProductInCookie = (id, array) => {
        var existanceCheck = false;

        for (var smallerArray of array) {
            if (smallerArray[0] == id) {
                existanceCheck = true;
                break;
            }
        }
        return existanceCheck;
    }
    const disableCartInsertButton = (element) => {
        // var insertionButton = $(".product-card-action .main-action-button[data-id='"+productId+"']");
        // var insertionButtonCustom = $(".cart-custom-qty[data-id='"+productId+"']");

        $(element).removeClass("cart-default-qty");
        $(element).removeClass("cart-custom-qty");
        $(element).addClass("in-cart");
        $(element).text("Item in cart");
        $(element).bind({
            'mouseenter': function(){cart.cartActionButtonText(this, "View cart")},
            'mouseleave': function(){cart.cartActionButtonText(this, "Item in cart")},
        })
        $(element).off("click");
        $(element).click(function () {
            window.location = "index.php?page=cart";
        })
    }
    const changeInputQuantity = (type, input) => {
        var currentAmount = parseInt($(input).val());
        var validateChange = true;
        if (type == "up") {
            if (currentAmount == 15) {
                alert("Maximum amount is 15");
                validateChange = false;
            }
            else {
                $(input).val(currentAmount + 1);
            }
        }
        else if (type == "down") {
            if (currentAmount == 1) {
                alert("Minimum amount is 1");
                validateChange = false;
            }
            else {
                $(input).val(currentAmount - 1);
            }
        }
        return validateChange;
    }
    const changeCookieQuantity = (productId, newQuantity) => {
        console.log(productId);
        $.ajax({
            url: "models/cart/update.php",
            method: "POST",
            data: {
                productId: productId,
                quantity: newQuantity
            },
            dataType: "json",
            success: function (response) {
                if (response.authentication == false) {
                    cart.changeQuantityNoAuthentication(response.productid, response.quantity);
                }
                cart.newSubtotalPerProduct(productId, newQuantity);
                cart.changeFormValues(productId, newQuantity);
                cart.newSubtotalInTotal();
            },
            error: function (error, status, statusText) {
                if (error.status == 409) {
                    var response = JSON.parse(error.responseText);
                    alert(response.message);
                }
                else {
                    console.error('Error updating cart:'+error.status);

                    console.log(error.parseJSON);
                    alert(error.parseJSON.error);
                }
            }
        })
    }
    const changeQuantityNoAuthentication = (productId, newQuantity) => {
        var cartCookie = JSON.parse(cookie.getCookieValue("cart"));
        var index = cartCookie.findIndex(el => el[0] == productId);
        cartCookie[index][1] = parseInt(newQuantity);
        cookie.setCookie("cart", JSON.stringify(cartCookie), 7);
    }
    const newSubtotalPerProduct = (id, quantity) => {
        var element = $(".product-subtotal-price[data-id=" + id + "]");
        var price = element.data("productprice");
        price = price * quantity;
        element.text("$" + price);
        element.data("subtotalprice", price);
        console.log( element.data("subtotalprice") )
    }
    const newSubtotalInTotal = () => {
        var allSubtotalElements = $(".product-subtotal-price");
        var subtotalOfAll = 0;

        for (var el of allSubtotalElements) {
            var price = parseInt($(el).data("subtotalprice"));
            console.log(price)
            subtotalOfAll += price;
        }
        $("#summary-subtotal").text("$"+subtotalOfAll);
        var subTotalShipping = subtotalOfAll + 5;
        $("#summary-total-price").text("$"+subTotalShipping);
        $("#form-subtotal").val(subtotalOfAll);
    }
    const changeFormValues = (productId, newQuantity) => {
        var existingInputs = $("input[name='product-quantity[]']");
        for (var input of existingInputs) {
            var id = parseInt(input.value.split(",")[0]);
            if (id == productId) {
                $(input).val(id+","+newQuantity);
                break;
            }
        }
    }
    const removeProduct = (productId) => {
        $.ajax({
            url: "models/cart/delete_one.php",
            method: "POST",
            data: {
                productId: productId,
            },
            dataType: "json",
            success: function (response) {
                if (response.authentication == false) {
                    cart.removeProductNoAuthentication(response.productid);
                }
                else window.location.reload();
            },
            error: function (error, status, statusText) {
                if (error.status == 409) {
                    var response = JSON.parse(error.responseText);
                    alert(response.message);
                }
                else {
                    console.error('Error deleting cart item:'+error.status);

                    console.log(error.parseJSON);
                    alert(error.parseJSON.error);
                }
            }
        })
    }
    const removeProductNoAuthentication = (id) => {
        var cartCookie = JSON.parse(cookie.getCookieValue("cart"));
        var index = cartCookie.findIndex(el => el[0] == id);
        cartCookie.splice(index, 1);
        cookie.setCookie("cart", JSON.stringify(cartCookie), 7);
        window.location.reload();
    }
    const emptyCart = () => {
        $.ajax({
            url: "models/cart/delete_all.php",
            method: "POST",
            dataType: "json",
            success: function (response) {
                if (response.authentication == false) {
                    cookie.eraseCookie("cart");
                    //cookie.setCookie("cart", "[[]]", 7);
                }
                window.location.reload();
            },
            error: function (error, status, statusText) {
                if (error.status == 409) {
                    var response = JSON.parse(error.responseText);
                    alert(response.message);
                }
                else {
                    console.error('Error deleting cart item:'+error.status);

                    console.log(error.parseJSON);
                    alert(error.parseJSON.error);
                }
            }
        })
    }
    const cartActionButtonText = (element, text) => {
        $(element).stop(true).animate({'opacity': 0}, 200, function (e) {
            $(this).text(text);
        }).animate({'opacity': 1}, 200)
    }
    return { add, addWithoutAuthentication, checkIfProductInCookie, disableCartInsertButton, changeInputQuantity, changeCookieQuantity, changeQuantityNoAuthentication, newSubtotalPerProduct, newSubtotalInTotal, changeFormValues, removeProduct, removeProductNoAuthentication, emptyCart, cartActionButtonText }
})();
const checkout = (() => {
    const validate = () => {
        var didAllTestsPass = true;
        didAllTestsPass = form.validateMultipleFields(["email", "name", "surname", "company", "phone", "city", "adress", "zip"], "checkout", didAllTestsPass);

        // Shipping
        // var shippingTypeErrorField = $("#checkout-shipping-info");
        // if (!$("input[name='shipping-type']").is(':checked')) {
        //     var didAllTestsPass = false;
        //     shippingTypeErrorField.css("display", "flex");
        //     shippingTypeErrorField.children("span").text("Please, select shipping type.");
        // }
        // else {
        //     shippingTypeErrorField.css("display", "none");
        //     var selectedShippingType = $("input[name='shipping-type']:checked").val();
        //     if (selectedShippingType == "home") {

        //         didAllTestsPass = form.validateMultipleFields(["adress", "city", "zip"], "checkout", didAllTestsPass)
        //     }
        //     else if (selectedShippingType == "store") {

        //     }
        // }

        // Payment
        var paymentMethodErrorField = $("#checkout-payment-info");
        if (!$("input[name='payment-type']").is(':checked')) {
            var didAllTestsPass = false;
            paymentMethodErrorField.css("display", "flex");
            paymentMethodErrorField.children("span").text("Please, select payment method.");
        }
        else paymentMethodErrorField.css("display", "none");

        return didAllTestsPass;
    }
    // const openShippingMethod = (type) => {
    //     switch(type) {
    //         case "home":
    //             $("#adress-delivery-extension").slideDown("fast");
    //             $("#shop-delivery-extension").css("display", "none");
    //         break;
    //         case "store":
    //             $("#adress-delivery-extension").css("display", "none");
    //             $("#shop-delivery-extension").slideDown("fast");
    //         break;
    //     }
    // }

    return { validate }
})();
const order = (() => {
    const viewFullOrder = (invoiceId) => {
        console.log(invoiceId)
        $.ajax({
            url: "models/order/get_one.php",
            method: "POST",
            data: {
                id: invoiceId
            },
            dataType: "json",
            success: function (invoice) {
                console.log(invoice);
                var products = invoice.products;
                var numberOfProducts = products.length;

                var deliveryComment = getTextareaStyleAndText(invoice.delivery_comment);
                var orderComment = getTextareaStyleAndText(invoice.order_comment);

                var status = "("+invoice.statusName+")";
                var cancelAction = `<button id="cancel-order" data-invoiceid="${invoice.invoiceId}">Cancel</button>`;
                if (invoice.status != 1) {
                    cancelAction = "";
                }

                var html = `
                <div id="order-info">
                    <div class="view-order-section-header">
                        <p>Order #${invoice.invoiceSerial} <span id='view-order-status'>${status}</span></p>
                        <p>${numberOfProducts} items</p>
                    </div>
                    <div id="order-products-table">
                        <div id="opt-header">
                            <div class="opt-header-field"><p>Product details</p></div>
                            <div class="opt-header-field"><p>Price</p></div>
                            <div class="opt-header-field"><p>Quantity</p></div>
                            <div class="opt-header-field"><p>Total</p></div>
                        </div>
                        <div id="opt-products">`;
                        for(var product of products) {
                            var totalPricePerProduct = parseInt(product.current_price) * product.quantity;
                            html += `
                            <div class="opt-row">
                                <div class="opt-row-product">
                                    <img src="assets/images/${product.imageName}" class="opt-image">
                                    <div class="opt-row-product-info">
                                        <p class="opt-name">${product.productName}</p>
                                        <p class="opt-brand">${product.brandName}</p>
                                    </div>
                                </div>
                                <div class="opt-row-price"><p>$${product.current_price}</p></div>
                                <div class="opt-row-quantity">
                                    <div class="product-quantity view-only-quantity">
                                        <input type="number" value="${product.quantity}" readonly>
                                    </div>
                                </div>
                                <div class="opt-row-total"><p>$${totalPricePerProduct}</p></div>
                            </div>
                            `;
                        }   
                    html += `
                        </div>
                    </div>
                </div>
                <aside id="order-credientals">
                    <div class="view-order-section-header">
                        <p>Order credientals</p>
                    </div>
                    <div id="order-credientals-view">
                        <div class="view-crediental-field">
                            <label for="view-order-email">Email <span class="required-field">*</span></label>
                            <input type="email" id="view-order-email" value="${invoice.email}" readonly>
                        </div>
                        <div class="view-crediental-field">
                            <label for="view-order-name">First name <span class="required-field">*</span></label>
                            <input type="text" id="view-order-name" value="${invoice.first_name}" readonly>
                        </div>
                        <div class="view-crediental-field">
                            <label for="view-order-surname">Last name <span class="required-field">*</span></label>
                            <input type="text" id="view-order-surname" value="${invoice.last_name}" readonly>
                        </div>
                        <div class="view-crediental-field">
                            <label for="view-order-company">Company</label>
                            <input type="text" id="view-order-company" value="${invoice.company}" readonly>
                        </div>
                        <div class="view-crediental-field">
                            <label for="view-order-phone">Phone <span class="required-field">*</span></label>
                            <input type="text" id="view-order-phone" value="${invoice.phone}" readonly>
                        </div>
                        <div class="view-crediental-field">
                            <label for="view-order-phone">Street adress <span class="required-field">*</span></label>
                            <input type="text" id="view-order-phone" value="${invoice.street_adress}" readonly>
                        </div>
                        <div class="view-crediental-field">
                            <label for="view-order-phone">City</label>
                            <input type="text" id="view-order-phone" value="${invoice.city}" readonly>
                        </div>
                        <div class="view-crediental-field">
                            <label for="view-order-phone">Zip/Postal Code <span class="required-field">*</span></label>
                            <input type="text" id="view-order-phone" value="${invoice.zip}" readonly>
                        </div>
                        <div class="view-crediental-field">
                            <label for="view-order-shipping-comment">Delivery Comment&nbsp;:</label>
                            <textarea id="view-order-shipping-comment" rows="4" ${deliveryComment[0]} readonly>${deliveryComment[1]}</textarea>
                        </div>
                        <div class="radio-buttons-field order-view-radio-buttons-field">
                            <p class="radio-title">Payment method:<span class="required-field">*</span></p>
                            <div class="radio-group">
                                <div class="radio-wrapper">
                                    <input type="radio" name="payment-type" id="payment-type-credit" value="credit">
                                    <label for="payment-type-credit">Credit Card</label>
                                </div>
                                <div class="radio-wrapper">
                                    <input type="radio" name="payment-type" id="payment-type-delivery" value="cash">
                                    <label for="payment-type-delivery">Cash on delivery</label>
                                </div>
                            </div>
                        </div>
                        <div class="view-crediental-field">
                            <label for="view-order-shipping-comment">Order Comment&nbsp;:</label>
                            <textarea id="view-order-shipping-comment" placeholder="Your additional comment about this order..." rows="4" ${orderComment[0]}readonly>${orderComment[1]}</textarea>
                        </div>
                    </div>
                    <div id="order-credientals-action">${cancelAction}</div>
                </aside>
                `;
                $(".full-page-cover").css("display", "flex");
                $("#view-order").css("display", "grid");
                $("#view-order").html(html);

                writeSelectedRadioValue($("input[name='view-shipping-method']"), invoice.shipping_type);
                writeSelectedRadioValue($("input[name='payment-type']"), invoice.payment_method);
            },
            error: function (error, status, statusText) {
                console.error('Error getting single order:'+error);

                alert("Error getting single order information.");
            }
        })
    }
    const writeSelectedRadioValue = (radioElements, value) => {
        $(radioElements).filter(function(){return this.value==value}).attr("checked", true);
        $(radioElements).filter(function(){return this.value!=value}).attr("disabled", true);
    }
    const getTextareaStyleAndText = (textarea) => {
        var commentStyle = "";
        var commentText = textarea;
        if (textarea == "") {
            commentStyle = "style='font-style: italic;'";
            commentText = "No comment sent.";
        }
        return [commentStyle, commentText];
    }
    const cancelOrder = (invoiceId) => {
        $.ajax({
            url: "models/order/cancel.php",
            method: "POST",
            data: {
                invoiceId: invoiceId
            },
            dataType: "json",
            success: function () {
                $(".single-order-status[data-invoiceid='"+invoiceId+"']").text("Canceled");
                $(".single-order-status[data-invoiceid='"+invoiceId+"']").css("color", "#d22b2b");
                $(".cancel-order[data-invoiceid='"+invoiceId+"']").remove();
                $("#cancel-update-order[data-invoiceid='"+invoiceId+"']").remove();
                $("#view-order-status").text("(Canceled)");
            },
            error: function (error, status, statusText) {
                console.error('Error canceling order:'+error.responseText);

                alert("Error canceling order.");
            }
        })
    }

    return { viewFullOrder, writeSelectedRadioValue, getTextareaStyleAndText, cancelOrder }
})();
const review = (() => {
    const validate = () => {
        var didAllTestsPass = true;
        didAllTestsPass = form.validateMultipleFields(["nickname", "summary", "review", "rating"], "review", didAllTestsPass);

        return didAllTestsPass;
    }
    const markStars = (serial) => {
        review.clearStars();
        review.fillStars(serial);
    }
    const selectRating = (serial, input) => {
        review.clearStars();
        review.fillStars(serial);
        $(".send-rate-star").off('mouseenter');
        $(input).val(serial);
    }
    const clearStars = () => {
        var starElements = $(".send-rate-star");
        starElements.removeClass("fa-solid");
        starElements.addClass("far");
    }
    const fillStars = (serial) => {
        var filledStars = $(".send-rate-star").filter(function () {
            return $(this).data("serial") <= serial;
        })
        $(filledStars).removeClass("far");
        $(filledStars).addClass("fa-solid");
    }
    const writeStars = (rating) => {
        if (rating == 0) {
            return "Product not rated"
        }
        else {
            var html = "";
            for(var i = 0; i < rating; i++) {
                html += "<i class='fa-solid fa-star rating-star'></i>";
            }
            for(var i = 0; i < 5 - rating; i++) {
                html += "<i class='far fa-star rating-star'></i>";
            }
            return html;
        }
    }

    return { validate, markStars, selectRating, clearStars, fillStars, writeStars }
})();
const experience = (() => {
    const validate = () => {
        var didAllTestsPass = true;
        didAllTestsPass = form.validateMultipleFields(["nickname", "summary", "review"], "experience", didAllTestsPass);

        return didAllTestsPass;
    }
    return { validate }
})();
const panel = (() => {
    var currentImageCounter = 1;
    
    const searchProducts = () => {
        var formValues = $("#panel-products-options").serialize();
        console.log(formValues);
        $.ajax({
            type: "GET",
            url: "models/product/filter_sort.php",
            data: formValues,
            dataType: "json",
            success: function (products) {
                writeProductsInTable(products);
            },
            error: function (error, status, statusText) {
                if(error.status == 401){
                    window.location.href = "index.php";
                }
                else if (error.status == 404) {
                    var response = JSON.parse(error.responseText);
                    alert(response.message);
                }
                else if (error.status == 500) {
                    console.error('Error entering data:'+error.status);

                    console.log(error.parseJSON);
                    alert(error.parseJSON.error);
                }
                else {
                    console.error('Error entering data:'+error.status);
                }
            }

        })
    }
    const writeProductsInTable = (products) => {
        var html = `<tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Brand</th>
            <th>Units sold</th>
            <th>View</th>
            <th>Delete</th>
        </tr>`;

        for (var pr of products) {
            html += `<tr>
                <td>${pr.productId}</td>
                <td>${pr.productName}</td>
                <td>${pr.productPrice}</td>
                <td class="page-name">${pr.brandName}</td>
                <td>${pr.units_sold}</td>
                <td><button class="panel-btn panel-view-btn"><a href="index.php?page=product&productId=${pr.productId}">View</a></button></td>
                <td><button class="panel-btn panel-delete-btn" data-id="${pr.productId}"><a>Delete</a></button></td>
            </tr>
            `;
        }

        $("#panel-table-products").html(html);
    }
    const showPendingImage = (input) => {
        const reader = new FileReader();
        reader.addEventListener('load', () => {
            var uploaded_image = reader.result;

            var html = `
                <div class="image-preview-wrapper" data-serial="${currentImageCounter}">
                    <div class="image-preview" style="background-image: url(${uploaded_image})" data-serial="${currentImageCounter}"></div>
                    <div class="cancel-image" data-serial="${currentImageCounter}">X</div>
                </div>
            `;
            $("#image-previews").append(html);
            addNewImageInput();
        });
        reader.readAsDataURL(input.files[0]);
    }
    const addNewImageInput = () => {
        currentImageCounter++;
        $("#add-new-image").remove();
        html = `<input type="file" id="add-image${currentImageCounter}" class="product-add-image" name="images[]" data-serial="${currentImageCounter}">
        <label id="add-new-image" for="add-image${currentImageCounter}">+</label>
`;
        $("#product-images-preview-add").append(html);
    }
    const removePendingImage = (element) => {
        var serial = $(element).data('serial');
        $(`.image-preview-wrapper[data-serial='${serial}']`).remove();
        $(`input[data-serial='${serial}']`).remove();
    }
    const validateAddingProduct = () => {
        removeLastImageInput();

        return true;
    }
    const removeLastImageInput = () => {
        $(".product-add-image").last().remove();
    }
    const removeProduct = (element) => {
        var id = $(element).data("id");
        $.ajax({
            url: "models/product/delete.php",
            method: "POST",
            data: {
                productId: id
            },
            dataType: "json",
            success: function (products) {
                writeProductsInTable(products);
            },
            error: function (error, status, statusText) {
                if(error.status == 401){
                    window.location.href = "index.php";
                }
                else if (error.status == 404) {
                    var response = JSON.parse(error.responseText);
                    alert(response.message);
                }
                else if (error.status == 500) {
                    console.error('Error entering data:'+error.status);

                    console.log(error.parseJSON);
                    alert(error.parseJSON.error);
                }
            }
        })
    }

    return { searchProducts, showPendingImage, removePendingImage, removeProduct, validateAddingProduct }
})();  
const cookie = (() => {
    const setCookie = (name,value,days) => {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }
    const getCookieValue = (name) => {
        var nameEQ = name + "=";
        var allCookies = document.cookie.split(';');

        for(var i=0; i < allCookies.length; i++) {
            var c = allCookies[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }
    const eraseCookie = (name) => {
        document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }

    return { setCookie, getCookieValue, eraseCookie }
})();
const urlOptions = (() => {
    const changeGetMethods = (searchedKey, value) => {
        var url = window.location.href;
        var splitURL = url.split("?");

        // If get parameters are not set, than URL is additioned with them.
        if (splitURL[1] == undefined) {
            return url + "?" + searchedKey + "=" + value;
        }
        else {
            var doesParameterExist = splitURL[1].includes(searchedKey);
            if (doesParameterExist == false) return url + "&" + searchedKey + "=" + value;
            else {
                var newParameters = "";
                var existingParameters = splitURL[1].split("&");

                // Every GET parameter gets looped through. If searchedKey from function parameter is same as GET parameter key that is being looped through, new value is assigned. If not, old value is rewritten.
                for (var i = 0; i < existingParameters.length; i++) {
                    var key = existingParameters[i].split("=")[0];
                    if (key == searchedKey) {
                        newParameters += searchedKey+"="+value;
                    }
                    else {
                        newParameters += existingParameters[i];
                    }
                    if (i == existingParameters.length - 1) newParameters += "";
                    else newParameters += "&";
                }
                return splitURL[0] + "?" + newParameters;
            }
        }
    }

    return {
        changeGetMethods
    }
})();
console.log( cookie.getCookieValue("cart") )
<section id="user-profile">
    <div id="user-profile-card">
        <div id="user-summary">
            <div id="user-summary-info">
                <p id="summary-name-surname"><span id="summary-name"><?= getUserAttribute("first_name") ?></span> <span id="summary-surname"><?= getUserAttribute("last_name") ?></span></p>
                <?php 
                    // Reformat date
                    $date = getUserAttribute("created_at");
                    $date = strtotime($date);
                    $date = date("jS M Y", $date);
                ?>
                <p id="user-registration-date">Registered: <span><?=$date?></span></p>
            </div>
        </div>
        <div id="user-info">
            <p class="user-info-header">Contact details</p>
            
            <div id="update-general-info-box">
                <?php if(isset($_SESSION["update_warning"])): ?>
                <p id="update-warning" class="form-error account-form-error">
                    <?= $_SESSION["update_warning"] ?>
                </p>
                <?php endif; ?>
                <?php if(isset($_SESSION["successful_update"])): ?>
                <p id="update-success" class="form-error account-form-error">
                    <?= $_SESSION["successful_update"] ?>
                </p>
                <?php endif; ?>
                <?php
                    writeErrorInFormField("update-user-fail", "account-form-error");
                ?>
            </div>
            <form action="models/user/update.php" method="POST" onsubmit="return update.validate()">
                <input type="hidden" name="id" value="<?=$_SESSION["logged_user"]->id?>">
                <div class="mini-form-field">
                    <label for="update-name">Name<span class="required-field">*</span></label>
                    <input type="text" id="update-name" name="update-name" placeholder="Enter your name" value="<?= getUserAttribute("first_name") ?>">
                    <p id="update-name-info" class="form-error account-form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Name can only contain letters, between 1 and 50 in length. Example: Peter.</span></p>
                    <?php
                        writeErrorInFormField("update-name", "account-form-error");
                    ?>
                </div>
                <div class="mini-form-field">
                    <label for="update-surname">Last name<span class="required-field">*</span></label>
                    <input type="text" id="update-surname" name="update-surname" placeholder="Enter your surname" value="<?= getUserAttribute("last_name") ?>">
                    <p id="update-surname-info" class="form-error account-form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Name can only contain letters, between 1 and 50 in length. Example: Peter.</span></p>
                    <?php
                        writeErrorInFormField("update-surname", "account-form-error");
                    ?>
                </div>
                <div class="mini-form-field">
                    <label for="update-email">Email<span class="required-field">*</span></label>
                    <input type="text" id="update-email" name="update-email" placeholder="Enter your email" value="<?= getUserAttribute("email") ?>">
                    <i class="far fa-envelope mini-form-input-icon"></i>
                    <p id="update-email-info" class="form-error account-form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Name can only contain letters, between 1 and 50 in length. Example: Peter.</span></p>
                    <?php
                        writeErrorInFormField("update-email", "account-form-error");
                    ?>
                </div>
                <div class="mini-form-field">
                    <label for="update-phone">Phone number</label>
                    <input type="text" id="update-phone" name="update-phone" placeholder="Enter your number" value="<?= getUserAttribute("phone") ?>">
                    <i class="fas fa-phone mini-form-input-icon"></i>
                    <p id="update-phone-info" class="form-error account-form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Name can only contain letters, between 1 and 50 in length. Example: Peter.</span></p>
                    <?php
                        writeErrorInFormField("update-phone", "account-form-error");
                    ?>
                </div>
                <div id="account-card-more-fields" class="more-form-fields">
                    <div id="message-hidden-fields">
                        <p>View more information</p>
                        <i class="fas fa-chevron-down" <?php if(isset($_SESSION["inverted_arrow"])) echo $_SESSION["inverted_arrow"] ?>></i>
                    </div>
                    <div id="hidden-form-fields"  <?php if(isset($_SESSION["open_more_options"])) echo $_SESSION["open_more_options"] ?>>
                        <div class="mini-form-field">
                            <label for="update-city">City</label>
                            <input type="text" id="update-city" name="update-city" placeholder="Enter your city" value="<?= getUserAttribute("city", "account-form-error") ?>">
                            <i class="far fa-building mini-form-input-icon"></i>
                            <p id="update-city-info" class="form-error account-form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Name can only contain letters, between 1 and 50 in length. Example: Peter.</span></p>
                            <?php
                                writeErrorInFormField("update-city", "account-form-error");
                            ?>
                        </div>
                        <div class="mini-form-field">
                            <label for="update-adress">Street adress</label>
                            <input type="text" id="update-adress" name="update-adress" placeholder="Enter your adress" value="<?= getUserAttribute("street_adress") ?>">
                            <i class="fas fa-map-marker-alt mini-form-input-icon"></i>
                            <p id="update-adress-info" class="form-error account-form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Name can only contain letters, between 1 and 50 in length. Example: Peter.</span></p>
                            <?php
                                writeErrorInFormField("update-adress", "account-form-error");
                            ?>
                        </div>
                    </div>
                </div>
                <button type="submit" id="finish-user-update" name="finish-user-update">Update</button>
                <?php unset($_SESSION["open_more_options"]); unset($_SESSION["inverted_arrow"]); unset($_SESSION["update_warning"]);
                unset($_SESSION["successful_update"]); ?>
            </form>
        </div>
    </div>
    <div class="white-box">
        <div class="white-box-header">
            <p>Activity</p>
        </div>
        <div id="all-activity" class="white-box-content">
            <?php 
                $activities = getUserActivities();

                foreach($activities as $activity):
                    if(property_exists($activity, 'payment_method')) {
                        $icon = "fas fa-truck-loading";
                        $title = "You have made new order";

                        $text = "You have purchased ";
                        $products = getProductsByInvoiceId($activity->invoiceId);

                        for($i = 0; $i < count($products); $i++) {
                            if ($i == count($products) - 1) {
                                $text .= "'".$products[$i]->productName."'".".";
                            }
                            else {
                                $text .= "'".$products[$i]->productName."'".", ";
                            }
                        }
                    }
                    else if (property_exists($activity, 'review')) {
                        $icon = "far fa-comments";
                        $title = "Review on ".$activity->productName;
                        $text = "'".$activity->review."'";
                    }
                    $timestamp = strtotime($activity->creation);
                    $hourSeconds = date("H:s", $timestamp);
                    $date = date("jS M 'y", $timestamp);
            ?>
            <div class="recorded-activity">
                <div class="activity-date">
                    <p class="activity-time"><?=$hourSeconds?></p>
                    <p class="activity-date"><?=$date?></p>
                </div>
                <div class="activity-icon">
                    <i class="<?=$icon?>"></i>
                    <div class="activity-icon-line"></div>
                </div>
                <div class="activity-info">
                    <p class="activity-info-title"><?=$title?></p>
                    <p class="activity-specific-info"><?=$text?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
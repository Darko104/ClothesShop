<section id="user-rate-service">
    <div id="rate-service-wrapper" class="white-box">
        <div class="white-box-header">
            <p>Rate service</p>
        </div>
        <div class="white-box-content">
            <form action="models/experience/insert.php" method="post" id="panel-form">
                <div class="panel-form-field">
                    <label for="experience-nickname" class="panel-form-label">Nickname</label>
                    <input type="text" id="experience-nickname" name="experience-nickname" placeholder="Ex: Pera">
                    <p id="experience-nickname-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                    <?php
                        writeErrorInFormField("experience-nickname");
                    ?>
                </div>
                <div class="panel-form-field">
                    <label for="experience-summary" class="panel-form-label">Review title</label>
                    <input type="text" id="experience-summary" name="experience-summary" placeholder="Ex: Job done successfully">
                    <p id="experience-summary-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                    <?php
                        writeErrorInFormField("experience-title");
                    ?>
                </div>
                <div class="panel-form-field">
                    <label for="experience-review" class="panel-form-label">Write review</label>
                    <input type="text" id="experience-review" name="experience-review" placeholder="Write your experience">
                    <p id="experience-review-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                    <?php
                        writeErrorInFormField("experience-review");
                    ?>
                </div>
                <button type="submit" id="panel-form-submit" name="submit-experience">Publish review</button>   
            </form>
            <?php if( isset($_SESSION["review_info"]) ): 
                $elementId = $_SESSION["review_info"][0];
                $elementText = $_SESSION["review_info"][1];
            ?>
            <div id="<?=$elementId?>" class="form-alert">
                <p><?=$elementText?></p>
            </div>
            <?php endif; unset( $_SESSION["review_info"] ); ?>
        </div>
    </div>
</section>
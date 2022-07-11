<section id="add-product">
    <div id="add-product-box" class="white-box">
        <div class="white-box-header">
            <p>Add a new product</p>
        </div>
        <div class="white-box-content">
            <form action="models/product/insert.php" method="POST" id="panel-form" enctype='multipart/form-data' onsubmit="return panel.validateAddingProduct()">
                <div class="panel-form-field">
                    <label for="add-name" class="panel-form-label">Name</label>
                    <input type="text" id="add-name" name="add-name" placeholder="Ex: Air Max">
                    <p id="add-name-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                    <?php
                        writeErrorInFormField("add-name");
                    ?>
                </div>
                <div class="panel-form-field">
                    <label for="add-category" class="panel-form-label">Category</label>
                    <select id="add-category" name="add-category" class="panel-select">
                        <?php 
                            foreach($categories as $category):
                        ?>
                        <option value="<?=$category->categoryId?>"><?=$category->categoryName?></option>
                        <?php endforeach; ?>
                    </select>
                    <p id="add-category-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                    <?php
                        writeErrorInFormField("add-category");
                    ?>
                </div>
                <div class="panel-form-field">
                    <label for="add-collection" class="panel-form-label">Collection</label>
                    <select id="add-collection" name="add-collection" class="panel-select">
                        <?php 
                            foreach($collections as $collection):
                        ?>
                        <option value="<?=$collection->collectionId?>"><?=$collection->collectionName?></option>
                        <?php endforeach; ?>
                    </select>
                    <p id="add-collection-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                    <?php
                        writeErrorInFormField("add-collection");
                    ?>
                </div>
                <div class="panel-form-field">
                    <label for="add-price" class="panel-form-label">Price</label>
                    <input type="number" id="add-price" name="add-price" placeholder="Ex: 45">
                    <p id="add-price-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                    <?php
                        writeErrorInFormField("add-price");
                    ?>
                </div>
                <div class="panel-form-field">
                    <label for="add-brand" class="panel-form-label">Brand</label>
                    <select id="add-brand" name="add-brand" class="panel-select">
                        <?php 
                            foreach($brands as $brand):
                        ?>
                        <option value="<?=$brand->brandId?>"><?=$brand->brandName?></option>
                        <?php endforeach; ?>
                    </select>
                    <p id="add-brand-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                    <?php
                        writeErrorInFormField("add-brand");
                    ?>
                </div>
                <div class="panel-form-field">
                    <p class="panel-form-label">Add images</p>
                    <div id="product-images-preview-add">
                        <div id="image-previews">
                        </div>
                        <label id="add-new-image" for="add-image1">+</label>
                        <input type="file" id="add-image1" class="product-add-image" name="images[]" data-serial="1">
                    </div>
                    <?php
                        writeErrorInFormField("add-images-info");
                    ?>
                </div>
                <button type="submit" id="panel-form-submit" name="submit-product">Add product</button>
                <?php unset($_SESSION["errors"]); ?>
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
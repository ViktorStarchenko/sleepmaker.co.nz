<?php
/*
 * Template Name: Product Registration
 * Template Post Type: page
 */
?>
<?php get_header(); ?>

    <div class="container">
        <div class="inner-page inner-page--reverse">
            <div class="inner-page__side">
                <?php
                    echo template_part('sideBar', []);
                ?>
            </div>
            <div class="inner-page__base">
                <h1 class="inner-page__title"><?= get_the_title() ?></h1>
                <div class="content">
                    <?= get_the_content() ?>
                </div>
                <div class="contacts-form">

                    <div class="form-scale">
                        <?= do_shortcode('[gravityform id="2" title="false" description="false" ajax="true"]'); ?>
                    </div>

                    <?php /*
                    <form class="form-scale" action="/">
                        <div class="input-row">
                            <div class="input-item w50">
                                <input type="text" name="" placeholder="Full Name">
                            </div>
                            <div class="input-item w50">
                                <input type="tel" name="" placeholder="Contact Number">
                            </div>
                            <div class="input-item w100">
                                <input type="email" name="" placeholder="Email Address*" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-row__label">
                                <p>Region/Retailer/store/Range</p>
                            </div>
                            <div class="input-item w50 input-item--select">
                                <select name="">
                                    <option value="" selected hidden>Region</option>
                                    <option value="Region 1">Region 1</option>
                                    <option value="Region 2">Region 2</option>
                                    <option value="Region 3">Region 3</option>
                                    <option value="Region 4">Region 4</option>
                                </select>
                            </div>
                            <div class="input-item w50 input-item--select">
                                <select name="">
                                    <option value="" selected style="display: none">Retailer</option>
                                    <option value="Retailer 1">Retailer 1</option>
                                    <option value="Retailer 2">Retailer 2</option>
                                    <option value="Retailer 3">Retailer 3</option>
                                    <option value="Retailer 4">Retailer 4</option>
                                </select>
                            </div>
                            <div class="input-item w50 input-item--select">
                                <select name="">
                                    <option value="" selected style="display: none">Store</option>
                                    <option value="Store 1">Store 1</option>
                                    <option value="Store 2">Store 2</option>
                                    <option value="Store 3">Store 3</option>
                                    <option value="Store 4">Store 4</option>
                                </select>
                            </div>
                            <div class="input-item w50 input-item--select">
                                <select name="">
                                    <option value="" selected style="display: none">Range</option>
                                    <option value="Range 1">Range 1</option>
                                    <option value="Range 2">Range 2</option>
                                    <option value="Range 3">Range 3</option>
                                    <option value="Range 4">Range 4</option>
                                </select>
                            </div>
                            <div class="input-row__label"><a href="#">I cant find the right product information</a></div>
                        </div>
                        <div class="input-row">
                            <div class="input-row__label">
                                <p>Upload Reciept. We accept: JPG, PNG, GIF, PDF</p>
                            </div>
                            <div class="input-check">
                                <input type="file" name="" accept=".png, .jpg, .jpeg, .pdf, .gif">
                            </div>
                            <div class="input-item w100">
                                <input type="text" name="" placeholder="Reciept Number*" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-row__label">
                                <p>Communication Preferences</p>
                            </div>
                            <div class="input-check w100">
                                <input id="Communication" type="checkbox" name="">
                                <label for="Communication">Yes, I’m happy to receive any upcoming Sleepyhead promotions, special offers, competitions or handy tips on all things sleep. View our Privacy Policy.</label>
                            </div>
                        </div>
                        <button class="button button--accent" type="submit">Submit</button>
                    </form>
 */ ?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();
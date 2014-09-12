<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

$garbiniPath = \Yii::$app->getAssetManager()->publish(\yincart\Yincart::$container->garbiniAsset->sourcePath);
?>
<footer id="footer">
    <div class="container">
        <hr>
        <div class="row">

            <div class="col-sm-2">
                <aside class="widget widget_nav_menu">
                    <h3 class="widget-title">Garbini</h3>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Log In / Sign Up</a></li>
                        <li><a href="#">Checkout</a></li>
                        <li><a href="#">My Wishlist</a></li>
                        <li><a href="#">My Cart</a></li>
                        <li><a href="#">What’s New</a></li>
                    </ul>
                </aside>
            </div>

            <div class="col-sm-2">
                <aside class="widget widget_nav_menu">
                    <h3 class="widget-title">Shop</h3>
                    <ul>
                        <li><a href="#">Cloting</a></li>
                        <li><a href="#">Feeding Bottles</a></li>
                        <li><a href="#">Diaper</a></li>
                        <li><a href="#">Infant Clothes</a></li>
                        <li><a href="#">Educational Baby Toys</a></li>
                        <li><a href="#">Strollers &amp; Pams</a></li>
                        <li><a href="#">Creams &amp; Ointments</a></li>
                    </ul>
                </aside>
            </div>

            <div class="col-sm-2">
                <aside class="widget widget_nav_menu">
                    <h3 class="widget-title">Info</h3>
                    <ul>
                        <li><a href="#">Company</a></li>
                        <li><a href="#">Franchisee</a></li>
                        <li><a href="#">Partners</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </aside>
            </div>

            <div class="col-sm-3">

                <aside class="widget widget_newsletter">
                    <h3 class="widget-title">Newsletter</h3>

                    <form action="#" id="newsletter">
                        <label for="newsletter-email">Get Our Newsletter</label>

                        <div class="input-group">
                            <input type="text" name="newsletter-email" id="newsletter-email" placeholder="Email"
                                   class="form-control input-lg">
          <span class="input-group-btn">
            <button class="btn btn-default btn-lg" type="button"><i class="fa fa-envelope"></i></button>
          </span>
                        </div>
                    </form>
                </aside>

                <aside class="widget widget_social_profiles">
                    <h3 class="widget-title">Lets Get Connected</h3>
                    <ul class="social-profiles">
                        <li>
                            <a href="#" title="Facebook">
            <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
            </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="Google+">
            <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
            </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="Twitter">
            <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
            </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="Pinterest">
            <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-pinterest fa-stack-1x fa-inverse"></i>
            </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="LinkedIn">
            <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
            </span>
                            </a>
                        </li>
                    </ul>
                </aside>

            </div>

            <div class="col-sm-3">

                <aside class="widget widget_text">
                    <h3 class="widget-title">We Accept</h3>
                    <img src="<?= $garbiniPath[1] ?>/img/images/payments.png" alt="">
                </aside>

                <aside class="widget widget_text">
                    <h3 class="widget-title">Free Shipping</h3>

                    <p class="free-shipping"><i class="fa fa-plane fa-3x"></i> <span>On orders over $50</span></p>
                </aside>

            </div>

        </div>

    </div>

    <div id="copyright">
        <div class="container">&copy; Copyright Garbini 2014 | All Rights Reserved | Designed by <a
                href="http://themeforest.net/user/jthemes">jThemes</a></div>
    </div>

</footer>
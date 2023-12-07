<?php include "app/sts/Views/_includes/_header.php"; ?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="<?= URL ?>home">Home</a>
                            <a href="<?= URL ?>loja">Loja</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="" method="POST" class="form_checkout">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Primeiro Nome<span>*</span></p>
                                        <input type="text" name="first_name" id="first_name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Ultimo Nome<span>*</span></p>
                                        <input type="text" name="last_name" id="last_name">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>CEP<span>*</span></p>
                                <input type="text" name="cep" class="cep">
                                <button type="button" class="site-btn send_cep">BUSCAR CEP</button>
                            </div><br>
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="checkout__input">
                                        <p>Rua<span>*</span></p>
                                        <input type="text" placeholder="Rua" class="checkout__input__add" name="address">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="checkout__input">
                                        <p>Numero<span>*</span></p>
                                        <input type="text" name="number_address" id="number_address">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <input type="text" placeholder="Complemento">
                            </div>
                            <div class="checkout__input">
                                <p>Bairro<span>*</span></p>
                                <input type="text" name="bairro">
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="checkout__input">
                                        <p>Estado<span>*</span></p>
                                        <input type="text" name="state">
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="checkout__input">
                                        <p>Cidade<span>*</span></p>
                                        <input type="text" name="city">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Celular<span>*</span></p>
                                        <input type="text" name="phone" class="phone">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text"
                                placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Seu Pedito</h4>
                                <div class="checkout__order__products">Produto <span>Total</span></div>
                                <ul class="checkout__total__products">
                                    <?php foreach($products as $product): ?>
                                        <li><?= $product['qnt_product'] ?>. <?= $product['name'] ?> <span><?= $product['total_price'] ?></span></li>
                                    <?php endForeach ?>
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Subtotal <span class="subtotal" ><?= $total_price_cart ?></span></li>
                                    <li>Total <span class="total_price_cart" ><?= (isset($cart['final_price_cart'])) ? 'R$' . $cart['final_price_cart'] : $total_price_cart ?></span></li>
                                    <li>Cupom Ativo <span class="coupon_active" > <?= ($cart['coupon_active']) ? $cart['coupon_active'] : 'Nenhum' ?></span></li>
                                </ul>
                                <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua.</p>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="checkbox" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <?php include "app/sts/Views/_includes/_footer.php"; ?>


    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="<?= URL ?>app/sts/assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?= URL ?>app/sts/assets/js/bootstrap.min.js"></script>
    <script src="<?= URL ?>app/sts/assets/js/jquery.nice-select.min.js"></script>
    <script src="<?= URL ?>app/sts/assets/js/jquery.nicescroll.min.js"></script>
    <script src="<?= URL ?>app/sts/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="<?= URL ?>app/sts/assets/js/jquery.countdown.min.js"></script>
    <script src="<?= URL ?>app/sts/assets/js/jquery.slicknav.js"></script>
    <script src="<?= URL ?>app/sts/assets/js/mixitup.min.js"></script>
    <script src="<?= URL ?>app/sts/assets/js/owl.carousel.min.js"></script>
    <script src="<?= URL ?>app/sts/assets/js/main.js"></script>
    <script src="<?= URL ?>app/sts/assets/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="<?= URL ?>app/sts/assets/js/plugins/validate/localization/messages_pt_BR.min.js"></script>
    <script src="<?= URL ?>app/sts/assets/js/jquery.maskedinput.pack.js"></script>
    <script src="<?= URL ?>app/sts/assets/js/pages/checkout/checkout.js"></script>
</body>

</html>
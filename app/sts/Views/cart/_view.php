<?php include "app/sts/Views/_includes/_header.php"; ?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Carrinho de Compras</h4>
                        <div class="breadcrumb__links">
                            <a href="<?= URL ?>home">Home</a>
                            <a href="<?= URL ?>loja">Shop</a>
                            <span>Carrinho de Compras</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->


    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Tamanho</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($products as $product): ?>
                                    <tr>
                                        <input type="hidden" name="id_product" value="<?= $product['id_product'] ?>">
                                        <input type="hidden" name="price_product" value="<?= $product['price'] ?>">
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <img src="<?= URL ?>app/sts/assets/img/products/<?= $product['image'] ?>" alt="" style="width: 100px;">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6><?= $product['name'] ?></h6>
                                                <h5><?= $product['price'] ?></h5>
                                            </div>
                                        </td>
                                        <td class="quantity__item">
                                            <div class="quantity">
                                                <div class="pro-qty-2">
                                                    <input type="text" value="<?= $product['qnt_product'] ?>">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="quantity__item">
                                            <div class="quantity">
                                                <div class="pro-qty-2">
                                                    <input type="text" value="<?= $product['size'] ?>">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart__price"><?= $product['total_price'] ?></td>
                                        <td class="cart__close"><a href="javascript:;" class="cart_close"><i class="fa fa-close"></i></a></td>
                                    </tr>
                                <?php endForeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="<?= HOME_URI ?>loja">Continue Comprando</a>
                            </div>
                        </div>
<!--                         <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div> -->
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Cupom de Desconto</h6>
                        <h4 style="display: none;" class="cupom_msg"></h4>
                        <form action="#">
                            <input type="text" placeholder="Código" class="coupon">
                            <a href="javascript:;" class="add_coupon"><button>Aplicar</button></a>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Total do Carrinho</h6>
                        <ul>
                            <li>Subtotal <span class="subtotal" ><?= $total_price_cart ?></span></li>
                            <li>Total <span class="total_price_cart" ><?= (isset($cart['final_price_cart'])) ? 'R$' . $cart['final_price_cart'] : $total_price_cart ?></span></li>
                            <li>Cupom Ativo <span class="coupon_active" > <?= ($cart['coupon_active']) ? $cart['coupon_active'] : 'Nenhum' ?><?= ($cart['coupon_active']) ? '<a href="javascript:;" class="remove_coupon"><i class="fa fa-close"></i></a>' : '' ?></span></li>
                        </ul>
                        <a href="<?= HOME_URI ?>checkout" class="primary-btn">Continuar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

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
    <script src="<?= URL ?>app/sts/assets/js/pages/cart/cart.js"></script>
</body>

</html>
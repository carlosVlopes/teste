<?php include "app/sts/Views/_includes/_header.php"; ?>
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <?php foreach($main_banners as $banner): ?>
                <div class="hero__items set-bg" data-setbg="<?= URL ?>app/sts/assets/img/main_banners/<?=$banner['banner']?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-5 col-lg-7 col-md-8">
                                <div class="hero__text">
                                    <h2><?=$banner['title']?></h2>
                                    <p><?=$banner['description']?></p>
                                    <a href="" class="primary-btn">Compre Agora<span class="arrow_right"></span></a>
                                    <div class="hero__social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-pinterest"></i></a>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endForeach?>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <section class="banner spad">
        <div class="container">
            <div class="row">
                <?php foreach($main_itens as $item): ?>

                    <?php

                        $conf_item_position = $conf_item_card = '';

                        if($item['orderby'] == 1){
                            $conf_item_card = "col-lg-7 offset-lg-4";
                        }
                        if($item['orderby'] == 2){
                            $conf_item_card = "col-lg-5";

                            $conf_item_position = 'banner__item--middle';

                        }

                        if($item['orderby'] == 3){
                            $conf_item_card = "col-lg-7";

                            $conf_item_position = 'banner__item--last';


                        }

                     ?>

                    <div class="<?=$conf_item_card?>">
                        <div class="banner__item <?=$conf_item_position?>">
                            <div class="banner__item__pic">
                                <img src="<?= URL ?>app/sts/assets/img/main_items/<?=$item['image']?>" alt="">
                            </div>
                            <div class="banner__item__text">
                                <h2><?=$item['title']?></h2>
                                <a href="<?= URL ?>loja?categoria=<?=$item['link_redirect']?>">Compre Agora</a>
                            </div>
                        </div>
                    </div>
                <?php endForeach ?>
                <!-- <div class="col-lg-7 offset-lg-4">
                    <div class="banner__item">
                        <div class="banner__item__pic">
                            <img src="<?= URL ?>app/sts/assets/img/banner/banner-1.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Clothing Collections 2030</h2>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="banner__item banner__item--middle">
                        <div class="banner__item__pic">
                            <img src="<?= URL ?>app/sts/assets/img/banner/banner-2.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Accessories</h2>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="banner__item banner__item--last">
                        <div class="banner__item__pic">
                            <img src="<?= URL ?>app/sts/assets/img/banner/banner-3.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Shoes Spring 2030</h2>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li class="active" data-filter=".best-seller">Mais vendidos</li>
                        <li data-filter=".new-arrivals">Novos Itens</li>
                    </ul>
                </div>
            </div>
            <div class="row product__filter">
                <?php foreach($new_products as $product): ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="<?= URL ?>app/sts/assets/img/products/<?= $product['image'] ?>">
                                <?php if($product['status']): ?>
                                    <span class="label"><?= $product['status'] ?></span>
                                <?php endIf ?>
                                <ul class="product__hover">
                                    <input type="hidden" class="id_product" value="<?= $product['id_product'] ?>">
                                    <?php if(in_array($product['id_product'],$this->config_cart_likes['id_products_likes'])): ?>
                                        <li><a href="javascript:;"><img src="<?= URL ?>app/sts/assets/img/icon/heart_red.png" alt="Favoritar" class="remove-likes"></a></li>
                                    <?php else: ?>
                                        <li><a href="javascript:;"><img src="<?= URL ?>app/sts/assets/img/icon/heart.png" alt="Favoritar" class="add-likes"></a></li>
                                    <?php endIf ?>
                                    <li><a href="produto/<?= $product['id_product'] ?>"><img src="<?= URL ?>app/sts/assets/img/icon/search.png" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <input type="hidden" class="id_product" value="<?= $product['id_product'] ?>">
                                <h6><?= $product['name'] ?></h6>
                                <a href="javascript:;" class="add-cart">+ Adicionar ao Carrinho</a>
                                <h5 class="price_product"><?= $product['price'] ?></h5>
                                <div class="product__color__select">
                                    <label for="pc-1">
                                        <input type="radio" id="pc-1">
                                    </label>
                                    <label class="active black" for="pc-2">
                                        <input type="radio" id="pc-2">
                                    </label>
                                    <label class="grey" for="pc-3">
                                        <input type="radio" id="pc-3">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endForeach ?>
                <?php foreach($best_seller_products as $product):  ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix best-seller">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="<?= URL ?>app/sts/assets/img/products/<?= $product['image'] ?>">
                                <?php if($product['status']): ?>
                                    <span class="label"><?= $product['status'] ?></span>
                                <?php endIf ?>
                                <ul class="product__hover">
                                    <input type="hidden" class="id_product" value="<?= $product['id_product'] ?>">
                                    <?php if(in_array($product['id_product'],$this->config_cart_likes['id_products_likes'])): ?>
                                        <li><a href="javascript:;"><img src="<?= URL ?>app/sts/assets/img/icon/heart_red.png" alt="Favoritar" class="remove-likes"></a></li>
                                    <?php else: ?>
                                        <li><a href="javascript:;"><img src="<?= URL ?>app/sts/assets/img/icon/heart.png" alt="Favoritar" class="add-likes"></a></li>
                                    <?php endIf ?>
                                    <li><a href="produto/<?= $product['id_product'] ?>"><img src="<?= URL ?>app/sts/assets/img/icon/search.png" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <input type="hidden" class="id_product" value="<?= $product['id_product'] ?>">
                                <h6><?= $product['name'] ?></h6>
                                <a href="javascript:;" class="add-cart">+ Adicionar ao Carrinho</a>
                                <h5 class="price_product"><?= $product['price'] ?></h5>
                                <div class="product__color__select">
                                    <label for="pc-1">
                                        <input type="radio" id="pc-1">
                                    </label>
                                    <label class="active black" for="pc-2">
                                        <input type="radio" id="pc-2">
                                    </label>
                                    <label class="grey" for="pc-3">
                                        <input type="radio" id="pc-3">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endForeach ?>
            </div>
        </div>
    </section>

    <!-- Categories Section Begin -->
    <section class="categories spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories__text">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                        <img src="<?= URL ?>app/sts/assets/img/products/<?=$main_promotion['image']?>" alt="">
                        <div class="hot__deal__sticker">
                            <span>Promoção</span>
                            <h5><?=$main_promotion['price']?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <input type="hidden" class="date_expiry" value="<?=$main_promotion['date_expiry']?>">
                        <h2><?=$main_promotion['title']?></h2>
                        <div class="categories__deal__countdown__timer" id="countdown">
                            <div class="cd-item">
                                <span>3</span>
                                <p>Days</p>
                            </div>
                            <div class="cd-item">
                                <span>1</span>
                                <p>Hours</p>
                            </div>
                            <div class="cd-item">
                                <span>50</span>
                                <p>Minutes</p>
                            </div>
                            <div class="cd-item">
                                <span>18</span>
                                <p>Seconds</p>
                            </div>
                        </div>
                        <a href="produto/<?= $main_promotion['id_product'] ?>" class="primary-btn">Compre Agora</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Instagram Section Begin -->
    <section class="instagram spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instagram__pic">
                        <?php foreach($galery_instagram as $picture):  ?>
                            <div class="instagram__pic__item set-bg" data-setbg="<?= URL ?>app/sts/assets/img/instagram/<?= $picture['image'] ?>"></div>
                        <?php endForeach ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="instagram__text">
                        <h2>Instagram</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                        <h3>#Male_Fashion</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest spad">

    </section>
    <!-- Latest Blog Section End -->

    <!-- Footer Section Begin -->
    <?php include "app/sts/Views/_includes/_footer.php"; ?>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Pesquisar.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <div id="myDialog"><div id="myDialogText"></div></div>

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
    <script src="<?= URL ?>app/sts/assets/js/pages/home/home.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lojinha Top</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?= URL ?>app/sts/assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?= URL ?>app/sts/assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?= URL ?>app/sts/assets/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?= URL ?>app/sts/assets/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="<?= URL ?>app/sts/assets/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="<?= URL ?>app/sts/assets/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?= URL ?>app/sts/assets/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?= URL ?>app/sts/assets/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="#">Entrar</a>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="<?= URL ?>app/sts/assets/img/icon/search.png" alt=""></a>
            <a href="#"><img src="<?= URL ?>app/sts/assets/img/icon/heart.png" alt=""></a>
            <a href="#"><img src="<?= URL ?>app/sts/assets/img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <a href="#">Entrar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="<?= HOME_URI ?>"><img src="<?= URL ?>app/sts/assets/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="<?= HOME_URI ?>">Home</a></li>
                            <!-- listagem de produtos shop.html-->
                            <li><a href="<?= HOME_URI ?>loja">Loja</a></li>
                            <!-- about.html -->
                            <li><a href="<?= HOME_URI ?>sobre">Sobre nós</a></li>
                            <!-- depois tirar esse pages -->
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <!-- detalhando o produto -->
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <!-- carrinho -->
                                    <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                    <!-- comprando -->
                                    <li><a href="./checkout.html">Check Out</a></li>
                                </ul>
                            </li>
                            <li><a href="<?= HOME_URI ?>contato">Contato</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="<?= URL ?>app/sts/assets/img/icon/search.png" alt=""></a>
                        <a href="#"><img src="<?= URL ?>app/sts/assets/img/icon/heart.png" alt=""></a>
                        <a href="#"><img src="<?= URL ?>app/sts/assets/img/icon/cart.png" alt=""> <span>0</span></a>
                        <div class="price">$0.00</div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->
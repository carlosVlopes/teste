<?php include "app/sts/Views/_includes/_header.php"; ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Itens Curtidos</h4>
                        <div class="breadcrumb__links">
                            <a href="<?= URL ?>home">Home</a>
                            <span>Itens Curtidos</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
<!--                 <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="loja" method="POST">
                                <input type="text" placeholder="Pesquisar..." name="name">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-12">
                    <div class="shop__sidebar__search">
                        <form action="loja" method="POST">
                            <input type="text" placeholder="Pesquisar..." name="name">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <?php if($title_filter): ?>
                                        <p>Filtrando por: <?= $title_filter ?></p>
                                    <?php endIf ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Classificar por preço:</p>
                                    <select class="filter_price">
                                        <option value="menor_maior">Baixo para alto</option>
                                        <option value="maior_menor">Alto para baixo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($error):?>
                        <div class="row">
                            <h2 style="margin-bottom: 10px;" >Nenhum produto encontrado!</h2>
                            <a href="<?= $this->page ?>" class="primary-btn">Atualizar</a>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach($products as $product):  ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="<?= URL ?>app/sts/assets/img/products/<?= $product['image'] ?>">
                                        <?php if($product['status'] && $product['status'] != 'Normal'): ?>
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
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product__pagination">
                                    <a class="active" href="#">1</a>
                                    <a href="#">2</a>
                                    <a href="#">3</a>
                                    <span>...</span>
                                    <a href="#">21</a>
                                </div>
                            </div>
                        </div>
                    <?php endIf ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

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
    <script src="<?= URL ?>app/sts/assets/js/pages/home/home.js"></script>

</body>

</html>
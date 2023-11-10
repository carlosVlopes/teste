<?php include "app/sts/Views/_includes/_header.php"; ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Loja</h4>
                        <div class="breadcrumb__links">
                            <a href="<?= URL ?>home">Home</a>
                            <span>Loja</span>
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
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="loja" method="POST">
                                <input type="text" placeholder="Pesquisar..." name="name">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categorias</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <li><a href="?categoria=Masculino" <?= ($title_filter == "Masculino") ? "style='color: #111111;'" : ''?>>Masculino (<?= $this->configs['amount_categories']["qnt_masc"] ?>)</a></li>
                                                    <li><a href="?categoria=Feminino" <?= ($title_filter == "Feminino") ? "style='color: #111111;'" : ''?>>Feminino (<?= $this->configs['amount_categories']['qnt_fm'] ?>)</a></li>
                                                    <!-- listagem de gategorias -->
                                                    <?php foreach($this->configs['categories'] as $category): ?>
                                                        <li><a href="?categoria=<?=$category['name']?>" <?= ($title_filter == $category['name']) ? "style='color: #111111;'" : ''?>><?=$category['name']?> (<?= $this->configs['amount_categories'][$category['name']] ?>)</a></li>
                                                    <?php endForeach ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseTwo">Marcas</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__brand">
                                                <ul>
                                                    <?php foreach($this->configs['brands'] as $brand): ?>
                                                        <li><a href="?marca=<?=$brand['name']?>" <?= ($title_filter == $brand['name']) ? "style='color: #111111;'" : ''?>><?=$brand['name']?></a></li>
                                                    <?php endForeach ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFour">Tamanhos</a>
                                    </div>
                                    <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__size">
                                                <label for="xs">xs
                                                    <input type="radio" id="xs">
                                                </label>
                                                <label for="sm">s
                                                    <input type="radio" id="sm">
                                                </label>
                                                <label for="md">m
                                                    <input type="radio" id="md">
                                                </label>
                                                <label for="xl">xl
                                                    <input type="radio" id="xl">
                                                </label>
                                                <label for="2xl">2xl
                                                    <input type="radio" id="2xl">
                                                </label>
                                                <label for="xxl">xxl
                                                    <input type="radio" id="xxl">
                                                </label>
                                                <label for="3xl">3xl
                                                    <input type="radio" id="3xl">
                                                </label>
                                                <label for="4xl">4xl
                                                    <input type="radio" id="4xl">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFive">Cores</a>
                                    </div>
                                    <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__color">
                                                <label class="c-1" for="sp-1">
                                                    <input type="radio" id="sp-1">
                                                </label>
                                                <label class="c-2" for="sp-2">
                                                    <input type="radio" id="sp-2">
                                                </label>
                                                <label class="c-3" for="sp-3">
                                                    <input type="radio" id="sp-3">
                                                </label>
                                                <label class="c-4" for="sp-4">
                                                    <input type="radio" id="sp-4">
                                                </label>
                                                <label class="c-5" for="sp-5">
                                                    <input type="radio" id="sp-5">
                                                </label>
                                                <label class="c-6" for="sp-6">
                                                    <input type="radio" id="sp-6">
                                                </label>
                                                <label class="c-7" for="sp-7">
                                                    <input type="radio" id="sp-7">
                                                </label>
                                                <label class="c-8" for="sp-8">
                                                    <input type="radio" id="sp-8">
                                                </label>
                                                <label class="c-9" for="sp-9">
                                                    <input type="radio" id="sp-9">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
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
                            <h2 style="margin-bottom: 10px;" >Nenhum produto encontrado para essa pesquisa!</h2>
                            <a href="<?= $this->page ?>" class="primary-btn">Atualizar</a>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach($products as $product):  ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="<?= URL ?>app/sts/assets/img/products/<?= $product['image'] ?>">
                                            <?php if($product['status'] && $product['status'] != "Normal"): ?>
                                                <span class="label"><?= $product['status'] ?></span>
                                            <?php endIf ?>
                                            <ul class="product__hover">
                                                <li><a href="#"><img src="<?= URL ?>app/sts/assets/img/icon/heart.png" alt="Favoritar"></a></li>
                                                <li><a href="produto/<?= $product['id_product'] ?>"><img src="<?= URL ?>app/sts/assets/img/icon/search.png" alt=""></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><?= $product['name'] ?></h6>
                                            <a href="#" class="add-cart">+ Adicionar ao Carrinho</a>
                                            <h5><?= $product['price'] ?></h5>
                                            <div class="product__color__select">
                                                <label for="pc-4">
                                                    <input type="radio" id="pc-4">
                                                </label>
                                                <label class="active black" for="pc-5">
                                                    <input type="radio" id="pc-5">
                                                </label>
                                                <label class="grey" for="pc-6">
                                                    <input type="radio" id="pc-6">
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
    <!-- <script src="<?= URL ?>app/sts/assets/js/pages/loja/loja.js"></script> -->
</body>

</html>
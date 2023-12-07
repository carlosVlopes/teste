<?php include "app/sts/Views/_includes/_header.php"; ?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Sobre Nós</h4>
                        <div class="breadcrumb__links">
                            <a href="<?= $this->pageReturn?>">Home</a>
                            <span>Sobre Nós</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about__pic">
                        <img src="<?= URL ?>app/sts/assets/img/about/about-us.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4><?= $data['texts']['title_1'] ?></h4>
                        <p><?= $data['texts']['description_1'] ?></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4><?= $data['texts']['title_2'] ?></h4>
                        <p><?= $data['texts']['description_2'] ?></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4><?= $data['texts']['title_3'] ?></h4>
                        <p><?= $data['texts']['description_3'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="testimonial__text">
                        <span class="icon_quotations"></span>
                        <p>“<?= $data['texts']['phrase'] ?>”
                        </p>
                        <div class="testimonial__author">
                            <div class="testimonial__author__pic">
                                <img src="<?= URL ?>app/sts/assets/img/about/testimonial-author.jpg" alt="">
                            </div>
                            <div class="testimonial__author__text">
                                <h5>Augusta Schultz</h5>
                                <p>Fashion Design</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="testimonial__pic set-bg" data-setbg="<?= URL ?>app/sts/assets/img/about/testimonial-pic.jpg"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->

    <!-- Counter Section Begin -->
    <section class="counter spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num"><?= $data['texts']['amount_1'] ?></h2>
                        </div>
                        <span><?= $data['texts']['title_amount_1'] ?></span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num"><?= $data['texts']['amount_2'] ?></h2>
                        </div>
                        <span><?= $data['texts']['title_amount_2'] ?></span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num"><?= $data['texts']['amount_3'] ?></h2>
                        </div>
                        <span><?= $data['texts']['title_amount_3'] ?></span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num"><?= $data['texts']['amount_4'] ?></h2>
                        </div>
                        <span><?= $data['texts']['title_amount_4'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Counter Section End -->

    <!-- Team Section Begin -->
    <section class="team spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Nosso time</span>
                        <h2>Conheça nosso time</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach($data['team'] as $person): ?>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="team__item">
                            <img src="<?= URL ?>app/sts/assets/img/about/<?= $person['image'] ?>" alt="">
                            <h4><?= $person['name'] ?></h4>
                            <span><?= $person['function'] ?></span>
                        </div>
                    </div>
                <?php endForeach; ?>
            </div>
        </div>
    </section>
    <!-- Team Section End -->

    <!-- Client Section Begin -->
    <section class="clients spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Empresas Parceiras</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach($data['companies'] as $company): ?>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                        <a href="#" class="client__item"><img src="<?= URL ?>app/sts/assets/img/companies/client-1.png" alt=""></a>
                    </div>
                <?php endForeach; ?>
            </div>
        </div>
    </section>
    <!-- Client Section End -->

    <!-- Footer Section Begin -->
    <?php include "app/sts/Views/_includes/_footer.php"; ?>
    <!-- Footer Section End -->

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
</body>

</html>
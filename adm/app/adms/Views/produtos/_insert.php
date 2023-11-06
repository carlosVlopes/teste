<?php include 'app/adms/Views/_includes/head.php';?>
<?php include 'app/adms/Views/_includes/navbar.php';?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <?php if($success): ?>
                                <div class="ibox-title">
                                    <h5>Produto cadastrado com sucesso!</h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="<?=$this->pageReturn?>" class="btn btn-success btn-m"><i class="fa fa-refresh"></i>  Atualizar</a>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="ibox-title">
                                    <h5>Cadastrar Produto</h5>
                                    <div class="ibox-tools">
                                        <a href="<?=$this->pageReturn ?>" class="btn btn-primary btn-m"><i class="fa fa-arrow-left"></i> Voltar</a>
                                    </div>
                                </div>
                                <?php
                                    if(isset($_SESSION['msg'])){
                                        echo $_SESSION['msg'];
                                        unset($_SESSION['msg']);
                                    }
                                ?>
                                <div class="ibox-content">
                                    <span class="col-lg-7" id="msg"></span>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form role="form" method="POST" action="" class="form-adm" enctype="multipart/form-data">
                                                <div class="form-group col-lg-10">
                                                    <label>Nome</label>
                                                    <input type="text" class="form-control" name="name" id="name">
                                                </div>
                                                <div class="form-group col-lg-2">
                                                    <label>Categoria</label>
                                                    <select class="select2_demo_1 form-control" name="id_category">
                                                        <?php foreach($categories as $category): ?>
                                                            <option value="<?=$category['id_category']?>"><?= $category['name'] ?></option>
                                                        <?php endForeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-11">
                                                    <label>Preço</label>
                                                    <input type="text" name="price" id="price" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-1">
                                                    <label>Ordem</label>
                                                    <input type="number" name="orderby" id="orderby" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label>Descrição</label>
                                                    <textarea name="description" id="description" class="form-control"></textarea>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <span>Imagem: 300x300</span>
                                                    <input type="file" name="image" class="form-control">
                                                    <span class="help-block m-b-none">Coloque a imagem só se voçe quiser mudar a image</span>
                                                </div>
                                                <div>
                                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Cadastrar</strong></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endIf?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script src="<?= URLADM ?>app/adms/assets/js/plugins/validate/jquery.validate.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/plugins/validate/localization/messages_pt_BR.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/plugins/select2/select2.full.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/pages/products/products.js"></script>
    </body>
</html>

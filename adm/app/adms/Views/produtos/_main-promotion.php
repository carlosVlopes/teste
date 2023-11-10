<?php include 'app/adms/Views/_includes/head.php';?>
<?php include 'app/adms/Views/_includes/navbar.php';?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <?php if($other_product): ?>
                                <div class="ibox-title">
                                    <h5>Já existe outro produto como promoção principal, deseja substituir esse produto?</h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="<?=$this->pageReturn?>" class="btn btn-success btn-m"><i class="fa fa-arrow-left"></i>  Voltar</a>
                                            <a href="<?=$this->pagePromotion?>/<?=$id?>?substituir=true" class="btn btn-primary btn-m"><i class="fa fa-"></i>  Substituir</a>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php if($success): ?>
                                    <div class="ibox-title">
                                        <h5>Promoção principal adicionada com sucesso!</h5>
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
                                        <h5>Cadastrar Produto como promoção principal</h5>
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
                                                    <input type="hidden" name="id_product" value="<?=$id?>">
                                                    <div class="form-group col-lg-6">
                                                        <label>Preço da Promoção</label>
                                                        <input type="number" name="price" id="price" class="form-control" value="<?= (isset($data['price'])) ? $data['price'] : '' ?>">
                                                    </div>
                                                    <div class="form-group" id="data_1">
                                                        <label class="font-noraml">Data de expiração</label>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="date_expiry" value="<?= (isset($data['date_expiry'])) ? implode("/",array_reverse(explode("-",$data['date_expiry']))) : '' ?>">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Salvar</strong></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endIf?>
                            <?php endIf?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script src="<?= URLADM ?>app/adms/assets/js/plugins/validate/jquery.validate.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/plugins/validate/localization/messages_pt_BR.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/plugins/select2/select2.full.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/pages/main_promotion/main_promotion.js"></script>
    </body>
</html>

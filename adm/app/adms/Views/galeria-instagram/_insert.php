<?php include 'app/adms/Views/_includes/head.php';?>
<?php include 'app/adms/Views/_includes/navbar.php';?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Cadastrar Imagens</h5>
                                <div class="ibox-tools">
                                    <a href="<?=$this->pageReturn?>" class="btn btn-primary btn-m"><i class="fa fa-arrow-left"></i> Voltar</a>
                                </div>
                            </div>
                            <?php
                                if(isset($_SESSION['msg'])){
                                    echo $_SESSION['msg'];
                                    unset($_SESSION['msg']);
                                }
                            ?>
                            <div class="ibox-content">
                                <h4>Upload de imagens:</h4>
                                <form action="upload.php" class="dropzone" id="meuPrimeiroDropzone">
                                    <div class="fallback">
                                        <input name="fileToUpload" type="file" multiple />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/pages/galeria-instagram/galeria-instagram.js"></script>
    </body>
</html>

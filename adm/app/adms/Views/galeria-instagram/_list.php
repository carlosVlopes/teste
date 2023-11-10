<?php include 'app/adms/Views/_includes/head.php';?>
<?php include 'app/adms/Views/_includes/navbar.php';?>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
				    <div class="col-lg-12">
				        <div class="ibox float-e-margins">
				        	<?php if(!$error): ?>
					            <div class="ibox-title">
					                <h5>Listagem de Imagens</h5>
					                <div class="ibox-tools">
										<a href="<?= $this->pageAdd?>" class="btn btn-primary btn-m">Cadastrar</a>
					                </div>
					            </div>
								<div class="ibox-content notification" style="display: none;">
		                            <div class="alert alert-success" id="msg">
		                            </div>
		                        </div>
					            <div class="ibox-content">
					            	<div class="table-responsive">
						                <table class="table table-bordered table-hover dataTables-example">
						                    <thead>
							                    <tr>
							                    	<th style="width: 200px;">Imagem</th>
							                        <th style="width: 100px;">Ordem</th>
					                            	<th class="list-head-content" style="width: 80px;">Ações</th>

							                    </tr>
						                    </thead>
						                    <tbody>
				    							<?php foreach ($data as $key => $picture): ?>

				    								<?php $image = ($picture['image']) ? 'app/sts/assets/img/instagram/' . $picture['image'] : ''?>

								                    <tr class="gradeX">
								                        <td style="width:600px;"><img src="<?= ($image) ? URL . $image : ''?>" style="width:200px;"></td>
								                        <td class="orderby">
	                                                        <span><?=$picture['orderby']?></span>
	                                                        <input type="number" min="1" value="<?=$picture['orderby']?>" name="orderby-picture" style="display:none;" class="form-control">
								                        </td>
								                        <td>
								                        	<form action="galeria-instagram/edit" method="POST" name="form_edit_<?= $key?>">
								                        		<input type="hidden" name="picture_id" value="<?= $picture['id_picture'] ?>">
																<a href="javascript:;" class="edit-picture btn btn-warning btn-m" title="Editar"><i class="fa fa-pencil"></i></a>
																<a href="javascript:;" class="btn btn-primary btn-m save-picture" title="Salvar" style="display:none">
	                                                                <i class="fa fa-floppy-o"></i>
	                                                            </a>
																<a href="javascript:;" class="btn btn-danger btn-m delete" onclick="return confirm('Deseja excluir esse registro?')" title="Excluir"><i class="fa fa-trash-o"></i></a>
								                        	</form>
								                        </td>
								                    </tr>
												<?php endforeach?>
						                    </tbody>
						                </table>
						            </div>
						        </div>
						    <?php else: ?>
						    	<div class="ibox-title">
					                <h5>Nenhuma imagem encontrada</h5>
					            </div>
					            <div class="ibox-content">
	                                <div class="row">
	                                	<a href="<?= $this->pageAdd?>" class="btn btn-primary btn-m"><i class="fa fa-plus"></i> Cadastrar</a>
	                                	<a href="<?=$this->pageReturn?>" class="btn btn-success btn-m"><i class="fa fa-refresh"></i>  Atualizar</a>
	                                </div>
	                            </div>
						    <?php endIf?>
				    	</div>
					</div>
				</div>
			</div>
        </div>
    </div>
        <script src="<?= URLADM ?>app/adms/assets/js/pages/galeria-instagram/galeria-instagram-actions.js"></script>

    </body>
</html>

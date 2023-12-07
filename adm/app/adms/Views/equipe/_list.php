<?php include 'app/adms/Views/_includes/head.php';?>
<?php include 'app/adms/Views/_includes/navbar.php';?>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
				    <div class="col-lg-12">
				        <div class="ibox float-e-margins">
				        	<?php if(!$error): ?>
					            <div class="ibox-title">
					                <h5>Listagem da equipe</h5>
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
							                    	<th style="width: 100px;">Imagem</th>
							                        <th>Nome</th>
							                        <th style="width: 150px;">Função</th>
							                        <th style="width: 150px;">Ordem</th>
													<?php if(isset($this->sessionPermi['u_delete']) === false && isset($this->sessionPermi['u_edit']) === false && isset($this->sessionPermi['u_add']) === false && isset($this->sessionPermi['u_view']) === false) :?>
						                            	<th class="list-head-content" style="width: 200px;">Sem permiçoes</th>
						                            <?php else: ?>
						                            	<th class="list-head-content" style="width: 140px;">Ações</th>
						                            <?php endif?>
							                    </tr>
						                    </thead>
						                    <tbody>
				    							<?php foreach ($data as $item): ?>

				    								<?php
				    									$image = ($item['image']) ? 'app/sts/assets/img/about/' . $item['image'] : '';

				    								?>

								                    <tr class="gradeX">
								                        <td><img src="<?= ($image) ? URL . $image : ''?>" style="width:120px;"></td>
								                        <td><?=$item['name']?></td>
								                        <td><?=$item['function']?></td>
								                        <td>
															<input type="hidden" name="person_id" value="<?= $item['id_person'] ?>">
	                                                        <span class="text-order"><?=$item['orderby']?></span>
	                                                        <input type="number" min="1" value="<?=$item['orderby']?>" name="orderby" style="display:none; width:80%;" class="form-control">
	                                                        <a href="javascript:;" class="edit-order pull-right btn btn-success btn-m btn-outline" style="font-size:13px;"><i class="fa fa-pencil"></i></a>
	                                                        <a href="javascript:;" class="save-order pull-right btn btn-warning btn-m btn-outline" style="font-size:13px; display:none;"><i class="fa fa-floppy-o"></i></a>
								                        </td>
								                        <td>
								                        	<input type="hidden" name="item_id" value="<?= $item['id_person'] ?>">
															<a href="<?= $this->pageEdit . '/' . $item['id_person']?>" class="btn btn-warning btn-m" title="Editar"><i class="fa fa-pencil"></i></a>
															<a href="<?= $this->pageDelete . '/' . $item['id_person']?>" class="btn btn-danger btn-m" onclick="return confirm('Deseja excluir esse registro?')" title="Excluir"><i class="fa fa-trash-o"></i></a>
								                        </td>
								                    </tr>
												<?php endforeach?>
						                    </tbody>
						                </table>
						            </div>
						        </div>
						    <?php else: ?>
						    	<div class="ibox-title">
					                <h5>Nenhum item encontrado</h5>
					            </div>
					            <div class="ibox-content">
	                                <div class="row">
	                                	<a href="<?=$this->pageAdd?>" class="btn btn-primary btn-m"><i class="fa fa-plus"></i> Cadastrar</a>
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

    <script src="<?= URLADM ?>app/adms/assets/js/pages/equipe/equipe-actions.js"></script>

    </body>
</html>

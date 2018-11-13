	<!--Secao cadastro-->
	<section id="cadastro">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="text-center">
							<h2 class="text-uppercase">Editar Veículo</h2>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8 text-center">
						<?php if($error): ?>
                            <hr>
                          	<div class="alert alert-danger" role="alert"><?=$error?></div>
                        <?php endif; ?>
                          	<hr>
							
							<form method="POST" action="<?=base_url('adm/editar-veiculo')?>">

								<label for="Veiculo"><h4><strong>Descrição do veículo</strong></h4></label>
								<input type="text" class="form-control" name="veiculo" id="veiculo" required="" value="<?=$dataRegister['veiculo']?>" placeholder="Insira a descrição do Veículo"> 
								</br>
								<label for="Veiculo"><h4><strong>Placa do veículo</strong></h4></label>
								<input type="text" class="form-control" name="placa" id="placa" required="" value="<?=$dataRegister['placa']?>" placeholder="Insira a placa do Veículo. Ex.: GSA-8888"> 
								</br>
								<a href="<?=base_url('adm/veiculo');?>" class="btn btn-lg" style="background-color: #72141f; color:#fff !important">Cancelar</a>
								<button class="btn btn-lg" style="background-color: #72141f; color:#fff !important">Editar</button>
							</form>

						</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>	
		</div>								
	</section>
	<!-- devs-->
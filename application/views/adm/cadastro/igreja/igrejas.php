    <section class="bg-white">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <h2 class="text-center"><i class="fa fa-car " style="color: #560d16 !important"></i> Veículos</h2>
                          
                            <?php if ($this->input->get('cod') == 1): ?>
                           	<div class="alert alert-success text-center" role="alert">Veículo editado com sucesso</div>
							<hr>
							<?php elseif ($this->input->get('cod') == 2): ?>
                           	<div class="alert alert-success text-center" role="alert">Veículo Removida com sucesso</div>
							<hr>
							<?php endif; ?>
							<form action="<?=base_url('adm/veiculos')?>" method="post">
								<div class="row">
									<div class=" col-md-2 text-left">
										<a href="<?=base_url('profile#menu')?>" class="btn" style="background-color: #72141f; color:#fff !important"><i class="fa fa-chevron-left"></i> Voltar</a>
									</div>
									<div class="col-md-8">
										<input type="text" class="form-control" alt="lista-veiculos" placeholder="Para buscar a veiculo digite aqui o nome da cidade. Ex.. Jacui" name="cidade" value="<?=$dataForm?>" autofocus>
									</div>
									<div class=" col-md-2 text-right">
										<a href="<?=base_url('adm/cadastro-veiculo')?>" class="btn" style="background-color: #72141f; color:#fff !important">Novo Veículo <i class="fa fa-plus"></i></a>
									</div>
								</div>
								<br>
								<div class="row text-center">
									<button class="btn btn-lg" style="background-color: #72141f; color:#fff !important">Pesquisar</button>
								</div>
							</form>
							<br>
							<table class="table table-responsive table-hover text-center">
							<thead>
								<tr>
									<th><h4 class="text-center"><strong>Modelo do Veículo</strong></h4></th>
									<th><h4 class="text-center"><strong>Placa</strong></h4></th>
									<th><h4 class="text-center"><strong>Opções</strong></h4></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if ($veiculos):
								foreach ($veiculos as $veiculo): 
									?>
									<tr>
										<td><?=$veiculo->ds_veiculo;?></td>
										<td><?=$veiculo->nome_cidade;?></td>
										<td>
										<a href="<?=base_url('adm/editar-veiculo?id='.$veiculo->id_veiculo)?>"><i class="fa fa-edit fa-2x" title="Editar Veículo"></i></a> 
										| 
										<a onclick="return confirm('Deseja realmente excluir essa veiculo?');" 
										href="<?=base_url('adm/remover-veiculo?id='.$veiculo->id_veiculo)?>"><i class="fa fa-remove fa-2x" title="Remover Veículo"></i></a></td>
									</tr>
								<?php endforeach;
								else:
								?>
									<tr>
										<td></td>
										<td><h4>Nenhum Veículo encontrado!</h4></td>
										<td></td>
									</tr>
								<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!--Secao cadastro-->
<br>
	<section id="cadastro">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="text-center">
							<h2 class="text-uppercase">Solicitações</h2>
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
                        <?php elseif ($success): ?>
                            <hr>
                           	<div class="alert alert-success" role="alert"><?=$success?></div>
                        <?php endif; ?>
                          	<hr>
                            
                            <form></form>
							
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>	
		</div>
		 <br><br><br>
	</section>
	<!-- devs-->
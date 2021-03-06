<!DOCTYPE html>
<html>
<title><?=$title ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Shortcut -->
<link rel="shortcut icon" type="image/x-png" href="<?=base_url('assets/img/icon-48x48.png')?>">

<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}a{text-decoration: none;}

  body {
        /* background-color:  #a81f2f; */
        
        background-image: url("assets/img/mountain2.jpg");
        background-size: cover;
        background-attachment: fixed;
        background-repeat: no-repeat;
        
    }

</style>

<body class="" >
<!-- style="background-color: #a81f2f; color:#fff !important"> -->

<!-- Navbar 
Cores: #a81f2f #560d16 #72141f--> 
<div class="w3-top" >
 <div class="w3-bar w3-left-align w3-large" style="background-color: #72141f; color:#fff !important">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large" style="background-color: #560d16; color:#fff !important" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large" style="background-color: #560d16; color:#fff !important"><i class="fa fa-ambulance w3-margin-right"></i>Paciente Móvel</a>
  <div class="w3-dropdown-hover w3-right">
    <a href="#" class="w3-button w3-hide-small w3-padding" title="My Account"><img src="<?=base_url('assets/img/users/'.$user->img_perfil)?>" class="w3-circle" style="max-height:35px;max-width:35px" alt="Avatar"></a>
    <div class="w3-dropdown-content w3-card-4 w3-bar-block w3-right" style="right:0">
      <a href="<?=base_url('profile-editar')?>" class="w3-bar-item w3-button">Meu Perfil</a>
      <a href="<?=base_url('logout')?>" class="w3-bar-item w3-button">Sair</a>
    </div>
  </div>
  <?php if ($permissao == 1) { ?>
  <div class="w3-dropdown-hover w3-hide-small">
    <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i>
      <span class="w3-badge w3-right w3-small w3-white"><?=$notificacoes ? sizeof($notificacoes) : ""?></span>
    </button>
    <div class="w3-dropdown-content w3-card w3-bar-block">
        <?php
            if ($notificacoes) {
                foreach ($notificacoes as $notificacao): ?>
                    <a href="adm/solicitacoes" class="w3-bar-item w3-button">
                        <?=$notificacao->nome?> está com uma solicitação pendente
                    </a>
                <?php endforeach;
            } else { ?>
                <div class="w3-bar-item">Não há nenhuma solicitações pendentes</div>
        <?php } ?>
    </div>
  </div>
  <?php } ?>
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-hide w3-hide-large w3-hide-medium w3-large" style="background-color: #560d16; color:#fff !important">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center"><?=$nome_user;?></h4>
         <p class="w3-center"><img src="<?=base_url('assets/img/users/'.$user->img_perfil)?>" class="w3-image" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-user-o fa-fw w3-margin-right w3-text-theme" style="color: #72141f !important"></i> <?=$user->ds_tipo_usuario?></p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme" style="color: #72141f !important"></i> <?=$user->nome_cidade?></p>
         <p><a href="<?=base_url('profile-editar')?>" class="w3-btn w3-block w3-round" style="background-color: #72141f; color:#fff !important">Editar Perfil</button></a>
         <p><a href="<?=base_url('alterar-senha')?>" class="w3-btn w3-block w3-round" style="background-color: #72141f; color:#fff !important">Alterar Senha</button></a> 
        </div>
      </div>
      <br>
      <?php if ($permissao == 1): ?>
      <div class="w3-margin-bottom">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h6 class="w3-opacity w3-center"><i class="fa fa-th"></i> Menu</h6>
              <hr>
              <div class="w3-row-padding w3-margin-bottom">
                <ul class="w3-ul">
                  <a class="w3-bar" href="<?php echo base_url('adm/solicitacoes')?>">
                    <li class="w3-cell-row w3-padding-12 w3-border-bottom ">
                      <div class="w3-cell w3-cell-middle">
                        Solicitações
                      </div>
                      <div class="w3-cell w3-cell-middle w3-margin-right w3-right">
                        <i class="fa fa-chevron-right"></i>
                      </div>
                    </li>
                  </a>
                  <a class="w3-bar" href="<?php echo base_url('adm/cadastro-pre-solicitacao')?>">
                    <li class="w3-cell-row w3-padding-12 w3-border-bottom ">
                      <div class="w3-cell w3-cell-middle">
                        Nova Solicitação
                      </div>
                      <div class="w3-cell w3-cell-middle w3-margin-right w3-right" >
                        <i class="fa fa-chevron-right"></i>
                      </div>
                    </li>
                  </a>
                  <a class="w3-bar" href="<?php echo base_url('adm/usuarios')?>">
                    <li class="w3-cell-row w3-padding-12 w3-border-bottom ">
                      <div class="w3-cell w3-cell-middle">
                        Usuários
                      </div>
                      <div class="w3-cell w3-cell-middle w3-margin-right w3-right">
                        <i class="fa fa-chevron-right"></i>
                      </div>
                    </li>
                  </a>
                  <a class="w3-bar" href="<?php echo base_url('adm/veiculo')?>">
                    <li class="w3-cell-row w3-padding-12 w3-border-bottom ">
                      <div class="w3-cell w3-cell-middle">
                        Veículos
                      </div>
                      <div class="w3-cell w3-cell-middle w3-margin-right w3-right">
                        <i class="fa fa-chevron-right"></i>
                      </div>
                    </li>
                  </a>
                  
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php else: ?>
        <div class="w3-margin-bottom">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h6 class="w3-opacity w3-center"><i class="fa fa-th"></i> Menu</h6>
              <hr>
              <div class="w3-row-padding w3-margin-bottom">
                <ul class="w3-ul">
                  <a class="w3-bar" href="<?php echo base_url('adm/cadastro-pre-solicitacao')?>">
                    <li class="w3-cell-row w3-padding-12 w3-border-bottom ">
                      <div class="w3-cell w3-cell-middle">
                        Nova Solicitação
                      </div>
                      <div class="w3-cell w3-cell-middle w3-margin-right w3-right" >
                        <i class="fa fa-chevron-right"></i>
                      </div>
                    </li>
                  </a>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
    <!-- End Left Column -->
    </div>
    <!-- Middle Column -->
    <div class="w3-col m7">
    <?php if ($permissao == 1): ?>
    <div class="w3-margin-top w3-hide-large"></div>
      <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h4 class="w3-opacity w3-center">Acesso Rápido</h4>
              <hr>
              <div class="w3-row-padding w3-margin-bottom w3-center">
                <div class="w3-third">
                  <h6>Solicitações</h6>
                  <a href="<?=base_url('adm/solicitacoes')?>">
                  <div class="w3-container w3-padding-16 w3-center w3-round" style="background-color: #72141f; color:#fff !important">
                    <i class="fa fa-list-alt w3-xlarge"></i>
                    <div class="w3-clear"></div>
                  </div>
                  </a>
                </div>
                <div class="w3-third">
                  <a href="<?php echo base_url('adm/cadastro-pre-solicitacao')?>">
                    <h6>Nova Solicitação</h6>
                    <div class="w3-container w3-text-white w3-padding-16 w3-center w3-round" style="background-color: #72141f; color:#fff !important">
                      <i class="fa fa-share w3-xlarge"></i>
                      <div class="w3-clear"></div>
                    </div>
                  </a>
                </div>
                <div class="w3-third">
                  <a href="<?=base_url('adm/usuarios')?>">
                    <h6>Usuários</h6>
                    <div class="w3-container w3-text-white w3-padding-16 w3-center w3-round" style="background-color: #72141f; color:#fff !important">
                      <i class="fa fa-users w3-xlarge"></i>
                      <div class="w3-clear"></div>
                    </div>
                  </a>
                </div>
              
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php else: ?>
        <div class="w3-margin-top w3-hide-large"></div>
      <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h4 class="w3-opacity w3-center">Acesso Rápido</h4>
              <hr>
              <div class="w3-row-padding w3-margin-bottom w3-center">
                <div class="w3-half">
                  <h6>Solicitações</h6>
                  <a href="#solicitacoes">
                  <div class="w3-container w3-padding-16 w3-center w3-round" style="background-color: #72141f; color:#fff !important">
                    <i class="fa fa-list-alt w3-xlarge"></i>
                    <div class="w3-clear"></div>
                  </div>
                  </a>
                </div>
                <div class="w3-half">
                  <a href="<?php echo base_url('adm/cadastro-pre-solicitacao')?>">
                    <h6>Nova Solicitação</h6>
                    <div class="w3-container w3-text-white w3-padding-16 w3-center w3-round" style="background-color: #72141f; color:#fff !important">
                      <i class="fa fa-share w3-xlarge"></i>
                      <div class="w3-clear"></div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php endif; ?>

      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-white w3-round w3-padding"><br>
            <h4 class="w3-opacity w3-center">Fila de Espera - Todos Usuários</h4>
            <hr>
            <?php if ($pendentes): ?>
            <table class="w3-table w3-striped w3-white">
              <thead class="" style="background-color: #72141f; color:#fff !important">
                <th class="" style="width: 20%">Solicitante</th>
                <th style="width: 30%">Tipo</th>
                <th class="" style="width: 15%">Data Viagem</th>
              </thead>
              <tbody style="min-height: 40vh">
                <?php foreach ($pendentes as $pendente): ?>
                <tr>
                  <td style="vertical-align: middle;"><?=$pendente->nome?></td>
                  <td style="vertical-align: middle;"><?=$pendente->tipo_solicitacao?></td>
                  <td style="vertical-align: middle;"><?=$pendente->data_viagem?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <?php else: ?>
              <div class="w3-padding-16 w3-center">
                <p class="w3-opacity">Não há nenhuma solicitação pendente :)</p>
              </div>
            <?php endif; ?>
            <br>
          </div>
        </div>
      </div>

      
      <div id="solicitacoes" class="w3-container w3-card w3-white w3-round w3-margin w3-padding"><br>
        <h4 class="w3-opacity w3-center">Minhas Solicitações</h4>
        <hr>
          <?php if ($solicitacoes): ?>
              <table class="w3-table w3-bordered w3-white w3-margin-bottom">
                  <thead class="" style="background-color: #72141f; color:#fff !important">
                  <th>Tipo</th>
                  <th>Status</th>
                  <th style="text-align: center;">Visualizar</th>
                  </thead>
                  <tbody style="min-height: 40vh">
                  <?php 
                  $qtd = 1;
                  foreach ($solicitacoes as $solicitacao): ?>
                      <tr>
                          <td style="vertical-align: middle;"><?=$solicitacao->tipo_solicitacao?></td>
                          <td style="vertical-align: middle;"><?=$solicitacao->status == 0 ? "Pendente" : ($solicitacao->status == 1 ? "Aprovado" : "Reprovado") ?></td>
                          <td style="vertical-align: middle;text-align: center;">
                            <button class="w3-button w3-round" onclick="verMais(<?=$qtd?>)"><i class="fa fa-plus"></i></button>
                          </td>
                      </tr>
                      <tr id="form<?=$qtd?>" style="display: none">
                        <td colspan="4">
                          <table class="w3-table w3-striped w3-white w3-border">
                            <tr>
                                <td class="w3-border" style="width: 30%">Solicitante</td>
                                <td class="w3-border"><?=$solicitacao->solicitante;?></td>
                            </tr>
                            <tr>
                                <td class="w3-border">Solicitação</td>
                                <td class="w3-border"><?=$solicitacao->nome_solicitacao;?></td>
                            </tr>
                            <tr>
                                <td class="w3-border">Descrição</td>
                                <td class="w3-border"><?=$solicitacao->descricao;?></td>
                            </tr>
                            <tr>
                                <td class="w3-border">Origem</td>
                                <td class="w3-border"><?=$solicitacao->origem;?></td>
                            </tr>
                            <tr>
                                <td class="w3-border">Destino</td>
                                <td class="w3-border"><?=$solicitacao->destino;?></td>
                            </tr>
                            <tr>
                                <td class="w3-border">Acompanhantes</td>
                                <td class="w3-border"><?=$solicitacao->acompanhantes;?></td>
                            </tr>
                            <tr>
                                <td class="w3-border">Horario Saída</td>
                                <td class="w3-border"><?=$solicitacao->horario_saida;?></td>
                            </tr>
                            <tr>
                                <td class="w3-border">Motorista</td>
                                <td class="w3-border"><?=$solicitacao->motorista;?></td>
                            </tr>
                            <tr>
                                <td class="w3-border">Veículo</td>
                                <td class="w3-border"><?=$solicitacao->ds_veiculo;?></td>
                            </tr>
                            <tr>
                                <td class="w3-border">Autorizador</td>
                                <td class="w3-border"><?=$solicitacao->autorizador;?></td>
                            </tr>
                            <tr>
                                <td class="w3-border">Data Autorização</td>
                                <td class="w3-border"><?=$solicitacao->data_autorizacao;?></td>
                            </tr>
                            <tr>
                                <td class="w3-border">Observação</td>
                                <td class="w3-border"><?=$solicitacao->observacao;?></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                  <?php 
                  $qtd++;
                  endforeach; ?>
                  </tbody>
              </table>
          <?php else: ?>
              <div class="w3-padding-16 w3-center">
                  <p class="w3-opacity">Nenhuma solicitação cadastrada :)</p>
              </div>
          <?php endif; ?>
        <?php if ($permissao == 1): ?>
          <a href="<?php echo base_url('adm/solicitacoes') ?>"><h6 class="w3-center w3-padding-16 w3-margin-right w3-text-theme">Todas as solicitações
        <?php endif ?>
        </h6></a>
      </div>


      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      
      <div class="w3-card w3-round w3-white w3-center w3-padding w3-padding-16">
        <h6 class="w3-opacity">Últimas Solicitações</h6>
        <hr>
        <div style="height: 70vh; overflow-y: auto;">
          <?php foreach ($noticias as $noticia): ?>
          <div class="w3-cell-row w3-border-bottom w3-padding-16">
            <div class="w3-cell" style="width: 20%">
              <img src="<?php echo base_url('assets/img/users/'.$noticia->img_perfil) ?>" class="w3-image w3-circle" style="width: 30px;height: 30px;">
            </div>
            <div class="w3-cell w3-small w3-cell-middle" style="width: 80%">
              <b><?php echo $noticia->nome?></b> realizou uma nova solicitação de <?php echo $noticia->tipo_solicitacao;  ?><br>
            </div>
          </div>
          <?php endforeach ?>
        </div>
      </div>
      <br>
      
      <!--
      <div class="w3-card w3-round w3-white w3-padding-32 w3-center">
        <p><i class="fa fa-bug w3-xxlarge"></i></p>
      </div>
      -->
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<footer class="w3-container w3-padding-16 w3-center" style="background-color: #560d16; color:#fff !important">
  <h5>"Seu transporte médico em alguns cliques"</h5>
</footer>

<footer class="w3-container w3-padding-16 w3-center" style="background-color:  #72141f; color:#fff !important">
  <p>Paciente Móvel 2018</p>
</footer>
 
<script>


function verMais(qtd) {
  console.log(qtd);
    var form = document.getElementById("form" + qtd);

    if (form.getAttribute("style") === "display: none") {
        form.setAttribute("style","");
    } else {
        form.setAttribute("style","display: none");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html> 

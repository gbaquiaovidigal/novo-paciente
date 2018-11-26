        <br>
        <section id="cadastroProduto">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12"> 
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <h2 class="text-center">Editar Usuarios</h2>
                            </div>
                            <div class="col-md-3 text-right">
                                <a href="<?=base_url('adm/usuarios')?>"><button class="btn btn-xl" id="">Usuários</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center">
                        <?php
                            if($error){
                          ?>
                            <hr>
                          <div class="alert alert-danger" role="alert"><?=$error?></div>
                          <?php
                            }
                            if($success){
                          ?>
                            <hr>
                           <div class="alert alert-success" role="alert"><?=$success?></div>
                          <?php
                            }
                          ?>
                            <hr>
                            <br><br>
                            <form method="POST" action="<?=base_url('adm/editar-usuario')?>">
                                <!-- Nome -->
                                <input type="text" id="nome" class="form-control" name="nome" placeholder="NOME" required="" value="<?=$dataRegister['nome']?>" />
                                <br>
                                <!-- Tipo de usuario -->
                                <select type="select" class="form-control" name="id_tipo_usuario" id="tipo_user" required="">
                                  <?php  foreach ($tipo_user as $tipos): ?>
                                  <option value="<?=$tipos->id_tipo_usuario?>" <?=$tipos->id_tipo_usuario == $dataRegister['id_tipo_usuario'] ? "selected" : "" ?> >
                                    <?=$tipos->ds_tipo_usuario?>  
                                  </option>
                                <?php endforeach ?>
                                
                                </select>
                                <br>
                                <!-- Id_user -->
                                <input type="hidden" name="id_user" value="<?=$dataRegister['id_user']?>">
                                <div class="col-lg-12 text-center">
                                    <br>
                                    <a href="<?=base_url('adm/usuarios')?>" class="btn btn-xl">Voltar</a>
                                    <input type="submit" class="btn btn-xl" value="Editar" />
                                </div>
                            </form>      
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br><br>
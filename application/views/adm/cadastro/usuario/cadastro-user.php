        <section id="cadastroProduto" class="bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12"> 
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <h2 class="text-center" style="color: #560d16 !important">Cadastro de Usuários</h2>
                            </div>
                            <div class="col-md-3 text-right">
                                <a href="<?=base_url('adm/usuarios')?>"><button class="btn btn-xl" style="background-color: #72141f; color:#fff !important" id="">Usuários</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 text-center">
                        <?php
                            if($error){
                          ?>
                            <hr class="light">
                          <div class="alert alert-danger" role="alert"><?=$error?></div>
                          <?php
                            }
                            if($success){
                          ?>
                            <hr class="light">
                           <div class="alert alert-success" role="alert"><?=$success?></div>
                          <?php
                            }
                          ?>
                            <hr class="light">

                            <form method="POST" action="<?=base_url('adm/cadastro-usuario')?>">
                                <!--Nome do usuario-->
                                <input type="text" id="nome" class="form-control" name="nome" placeholder="Nome" required="" value="<?=$dataRegister['nome']?>" />
                                <br>
                                
                                <!--User-->
                                <input type="text" id="user" class="form-control" name="user" required="" placeholder="Usuário" value="<?=$dataRegister['user']?>" />
                                <br>

                                <!--Cidades -->
                                <select type="select" class="form-control selectpicker" data-size="3" name="cidade" id="cidade" required="" data-live-search="true" title="Selecione a cidade" data-style="background-color: #72141f; color:#fff !important">
                                <?php  foreach ($cidades as $cidade): ?>
                                  <option value="<?=$cidade->id_cidade?>"
                                     <?php /*Voltando a informaçao para o usuarios*/
                                        if ($dataRegister['cidade'] == $cidade->id_cidade) {echo "selected";}  
                                        ?> 
                                    >
                                    <?=$cidade->nome_cidade?>    
                                    </option>
                                <?php endforeach ?>
                                </select>
                                <br><br>

                                <!--Tipo de usuario-->
                                <select type="select" class="form-control selectpicker" name="tipo_user" id="tipo_user" required="" title="Tipo de Usuário" data-style="background-color: #72141f; color:#fff !important">
                                <?php  foreach ($tipo_user as $tipos): ?>
                                  <option value="<?=$tipos->id_tipo_usuario?>" 
                                    <?php /*Voltando a informaçao para o usuarios*/
                                        if ($dataRegister['tipo_user'] == $tipos->id_tipo_usuario) {echo "selected";}  
                                        ?> 
                                        >
                                        <?=$tipos->ds_tipo_usuario?>
                                    </option>
                                <?php endforeach ?>
                                </select>
                                <br><br>

                                <!--Senha-->
                                <input type="password" id="senha" class="form-control" name="senha" required="" placeholder="Senha" value="<?=$dataRegister['senha']?>" />
                                <br>
                                <a class="btn btn-xl" style="background-color: #72141f; color:#fff !important" href="<?=base_url('adm/usuarios')?>">Voltar</a>
                                <input type="submit" class="btn btn-xl" style="background-color: #72141f; color:#fff !important" value="Inserir" />
                                </div>
                            </form>      
                        </div>
                    </div>
                </div>
            </div>
        </section>
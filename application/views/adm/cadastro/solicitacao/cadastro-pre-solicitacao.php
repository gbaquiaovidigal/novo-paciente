<!--Secao cadastro-->
<section id="cadastro">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="text-center">
                        <h2 class="text-uppercase">Nova Solicitação</h2>
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
                        <form method="POST" action="<?=base_url('adm/cadastro-veiculo')?>">
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Veiculo"><strong>Nome Solicitação</strong></label>
                                    <input type="text" class="form-control" name="nome" id="nome" value="<?=$dataRegister['nome']?>" placeholder="Insira o nome da Solicitação" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Veiculo"><strong>Tipo Solicitação</strong></label>
                                    <select class="form-control">
                                        <option value="0">Pendentes</option>
                                        <option value="1">Aprovados</option>
                                        <option value="2">Reprovados</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for=""><strong>Descrição</strong></label>
                                    <textarea class="form-control" placeholder="Descrição da solicitação"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for=""><strong>Origem</strong></label>
                                    <select class="form-control selectpicker" data-size="3" id="origem" name="origem" data-style="" data-live-search="true" title="Selecione a cidade de Origem" required>
                                        <?php foreach ($cidades as $origen): ?>
                                        <option value="<?=$origen->id_cidade?>"><?=$origen->nome_cidade?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for=""><strong>Destino</strong></label>
                                    <select class="form-control selectpicker" data-size="3" id="destino" name="destino" data-style="" data-live-search="true" title="Selecione a cidade de Destino" required>
                                        <?php foreach ($cidades as $origen): ?>
                                            <option value="<?=$origen->id_cidade?>"><?=$origen->nome_cidade?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for=""><strong>Acompanhantes</strong></label>
                                    <input class="form-control" type="number" value="0">
                                </div>
                                <div class="col-md-6">
                                    <label for=""><strong>Data Viagem</strong></label>
                                    <input class="form-control" type="date">
                                </div>
                            </div>
                            <br>
                            <a href="<?=base_url('adm/veiculo');?>" class="btn btn-lg" style="background-color: #72141f; color:#fff !important">Cancelar</a>
                            <button class="btn btn-lg" style="background-color: #72141f; color:#fff !important">Solicitar</button>

                        </form>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- devs-->
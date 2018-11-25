<section class="bg-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h2 class="text-center"><i class="fa fa-list" style="color: #560d16 !important"></i> Solicitações</h2>
                        <br>
                        <?php if ($this->input->get('cod') == 1): ?>
                            <div class="alert alert-success text-center" role="alert">Solicatação editado com sucesso</div>
                            <hr>
                        <?php elseif ($this->input->get('cod') == 2): ?>
                            <div class="alert alert-success text-center" role="alert">Veículo Removido com sucesso</div>
                            <hr>
                        <?php endif; ?>
                        <form action="<?=base_url('adm/veiculos')?>" method="post">
                            <div class="row">
                                <div class=" col-md-2 text-left">
                                    <label>&nbsp;</label>
                                    <a href="<?=base_url('profile#menu')?>" class="btn btn-block" style="background-color: #72141f; color:#fff !important"><i class="fa fa-chevron-left"></i> Voltar</a>
                                </div>
                                <div class="col-md-6">
                                    <label>Solicitante</label>
                                    <input type="text" class="form-control" alt="lista-veiculos" placeholder="Informe o solicitante" name="veiculo" value="<?=$dataForm?>" autofocus>
                                </div>
                                <div class="col-md-4">
                                    <label>Status</label>
                                    <select class="form-control">
                                        <option value="0">Pendentes</option>
                                        <option value="1">Aprovados</option>
                                        <option value="2">Reprovados</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row text-center">
                                <button class="btn btn-lg" style="background-color: #72141f; color:#fff !important">Pesquisar</button>
                            </div>
                        </form>
                        <br>
                        <table class="table table-responsive text-center">
                            <thead>
                            <tr>
                                <th class="text-center"><strong>Nome</strong></th>
                                <th class="text-center"><strong>Tipo</strong></th>
                                <th class="text-center"><strong>Data Viagem</strong></th>
                                <th class="text-center"><strong>Solicitante</strong></th>
                                <th class="text-center"><strong>Visualizar</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($solicitacoes):
                                foreach ($solicitacoes as $solicitacao):
                                    ?>
                                    <tr>
                                        <td><?=$solicitacao->nome_solicitacao;?></td>
                                        <td><?=$solicitacao->tipo_solicitacao;?></td>
                                        <td><?=$solicitacao->data_viagem;?></td>
                                        <td><?=$solicitacao->solicitante;?></td>
                                        <td><button class="btn btn-default"><i class="fa fa-plus" title="Visualizar Mais"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Descrição</td>
                                                    <td><?=$solicitacao->descricao;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Origem</td>
                                                    <td><?=$solicitacao->origem;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Destino</td>
                                                    <td><?=$solicitacao->destino;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Acompanhantes</td>
                                                    <td><?=$solicitacao->acompanhantes;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Horario Saída</td>
                                                    <td><?=$solicitacao->horario_saida;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Motorista</td>
                                                    <td><?=$solicitacao->motorista;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Veículo</td>
                                                    <td><?=$solicitacao->ds_veiculo;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Autorizador</td>
                                                    <td><?=$solicitacao->autorizador;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Data Autorização</td>
                                                    <td><?=$solicitacao->data_autorizacao;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Status</td>
                                                    <td><?=$solicitacao->status == 0 ? "Pendente" : ($solicitacao->status == 1 ? "Aprovado" : "Não Aprovado")?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <button class="btn" style="background-color: #72141f; color:#fff !important">Reprovar</button>
                                            <button class="btn" style="background-color: #72141f; color:#fff !important">Aprovar</button>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            else:
                                ?>
                                <tr>
                                    <td></td>
                                    <td><h4>Nenhum Veículo encontrado!</h4></td>
                                    <td></td>
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
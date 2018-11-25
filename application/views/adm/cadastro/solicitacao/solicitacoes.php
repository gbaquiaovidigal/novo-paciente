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
                            <div class="alert alert-success text-center" role="alert">Solicatação enviada com sucesso</div>
                            <hr>
                        <?php elseif ($this->input->get('cod') == 2): ?>
                            <div class="alert alert-success text-center" role="alert">Veículo Removido com sucesso</div>
                            <hr>
                        <?php endif; ?>
                        <form action="<?=base_url('adm/solicitacoes')?>" method="post">
                            <div class="row">
                                <div class=" col-md-2 text-left">
                                    <label>&nbsp;</label>
                                    <a href="<?=base_url('profile#menu')?>" class="btn btn-block" style="background-color: #72141f; color:#fff !important"><i class="fa fa-chevron-left"></i> Voltar</a>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-6 text-center">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="3" <?=$dataForm == 3 ? "selected" : ""?>>Todos</option>
                                        <option value="0" <?=$dataForm == 0 ? "selected" : ""?>>Pendentes</option>
                                        <option value="1" <?=$dataForm == 1 ? "selected" : ""?>>Aprovados</option>
                                        <option value="2" <?=$dataForm == 2 ? "selected" : ""?>>Reprovados</option>
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
                                <th class="text-center"><strong>Status</strong></th>
                                <th class="text-center"><strong>Visualizar</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($solicitacoes):
                                $qtd = 1;
                                foreach ($solicitacoes as $solicitacao): ?>
                                    <tr>
                                        <td><?=$solicitacao->nome_solicitacao;?></td>
                                        <td><?=$solicitacao->tipo_solicitacao;?></td>
                                        <td><?=$solicitacao->data_viagem;?></td>
                                        <td><?=$solicitacao->status == 0 ? "Pendente": ($solicitacao->status == 1 ? "Aprovado" : "Reprovado");?></td>
                                        <td><button class="btn btn-default" onclick="verMais(<?=$qtd;?>)" ><i class="fa fa-plus" title="Visualizar Mais"></i></button></td>
                                    </tr>
                                    <form action="<?=base_url('adm/solicitacoes/aprovar')?>" method="post"">
                                            <input type="hidden" name="id_solicitacao" value="<?=$solicitacao->id_solicitacao;?>">
                                        <tr id="form<?=$qtd?>" style="display: none">
                                            <td colspan="5">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td>Solicitante</td>
                                                        <td><?=$solicitacao->solicitante;?></td>
                                                    </tr>
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
                                                        <td><input class="form-control" type="time" name="horario_saida" value="<?=$solicitacao->horario_saida;?>"data></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Motorista</td>
                                                        <td>
                                                            <select class="form-control" name="motorista" required>
                                                                <option value="0">Nenhum selecionado</option>
                                                            <?php foreach ($motoristas as $motorista):?>
                                                                <option value="<?=$motorista->id_usuario?>" <?=$motorista->id_usuario == $solicitacao->id_motorista ? "selected" : ""?>>
                                                                    <?=$motorista->nome?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Veículo</td>
                                                        <td>
                                                            <select class="form-control" name="veiculo" required>
                                                                <option value="0">Nenhum selecionado</option>
                                                                <?php foreach ($veiculos as $veiculo):?>
                                                                    <option value="<?=$veiculo->id_veiculo?>" <?=$veiculo->id_veiculo == $solicitacao->id_veiculo ? "selected" : ""?>><?=$veiculo->ds_veiculo?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </td>
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
                                                        <td>
                                                            <select class="form-control" name="status" required>
                                                                <option value="0" <?=$solicitacao->status == 0 ? "selected" : ""?>>Pendente</option>
                                                                <option value="1" <?=$solicitacao->status == 1 ? "selected" : ""?>>Aprovado</option>
                                                                <option value="2" <?=$solicitacao->status == 2 ? "selected" : ""?>>Reprovado</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Observação</td>
                                                        <td><textarea class="form-control" name="observacao" id="observacao" placeholder="Informe o motivo de reprovação ou aprovação (Opcional)" rows="4"><?=$solicitacao->observacao?></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5">
                                                            <br>
                                                            <button class="btn" type="submit" style="background-color: #72141f; color:#fff !important">Cancelar</button>
                                                            <button class="btn" type="submit" style="background-color: #72141f; color:#fff !important">Enviar</button>
                                                            <br><br><br><br>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </form>
                                <?php $qtd++;
                                endforeach;
                            else:
                                ?>
                                <tr>
                                    <td colspan="5">
                                        <br><br><br>
                                        Nenhuma Solicitacao foi encontrada!
                                    </td>
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

<script>
    function verMais(qtd) {
        var form = document.getElementById("form" + qtd);

        console.log(form);

        if (form.getAttribute("style") === "display: none") {
            form.setAttribute("style","");
        } else {
            form.setAttribute("style","display: none");
        }
    }
</script>
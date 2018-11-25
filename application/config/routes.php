<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'User/Login';

$route['resultado'] = 'Exibicao/Pesquisa';
$route['contato'] = 'Exibicao/Contato';
$route['assinatura'] = 'Exibicao/News';
$route['cancelar-assinatura'] = 'Exibicao/Cancelar';
$route['profile'] = 'Exibicao/Profile';

# rotas da area administrativa
#Usuario
$route['login'] = 'User/Login';
$route['logout'] = 'User/Logout';
$route['alterar-senha'] = 'User/UpdatePassw';
$route['profile-editar'] = 'User/EditarMyUser';
$route['profile/recortar'] = 'User/Recortar';
$route['profile/visualizacao'] = 'User/Visualizacao';

$route['adm/usuarios'] = 'User/ListarUser';
$route['adm/cadastro-usuario'] = 'User/Register';
$route['adm/editar-usuario'] = 'User/EditarUser';
$route['adm/remover-usuario'] = 'User/RemoverUser';

#Solicitacao
$route['adm/solicitacoes'] = 'Solicitacao/Listar';
$route['adm/cadastro-pre-solicitacao'] = 'Solicitacao/RegisterPreSolicitacao';
$route['adm/solicitacoes/aprovar'] = 'Solicitacao/AprovarSolicitacao';

$route['adm/listas'] = 'Lista/Listar';
$route['adm/cadastro-lista'] = 'Lista/Register';
$route['adm/cadastro-pre-lista'] = 'Lista/RegisterPreLista';
$route['adm/gerar-lista'] = 'Lista/GerarLista';
$route['adm/editar-lista'] = 'Lista/Editar';
$route['adm/remover-lista'] = 'Lista/Remover'; //Pensar em uma maneira de implementar

$route['adm/regioes'] = 'Regiao/Listar';
$route['adm/cadastro-regiao'] = 'Regiao/Register';
$route['adm/editar-regiao'] = 'Regiao/Editar';
$route['adm/remover-regiao'] = 'Regiao/Remover';

$route['adm/cidades'] = 'Cidade/Listar';
$route['adm/cadastro-cidade'] = 'Cidade/Register';
$route['adm/editar-cidade'] = 'Cidade/Editar';
$route['adm/remover-cidade'] = 'Cidade/Remover';

$route['adm/veiculo'] = 'Veiculo/Listar';
$route['adm/cadastro-veiculo'] = 'Veiculo/Register';
$route['adm/editar-veiculo'] = 'Veiculo/Editar';
$route['adm/remover-veiculo'] = 'Veiculo/Remover';

$route['adm/presbiteros'] = 'Presbitero/Listar';
$route['adm/cadastro-presbitero'] = 'Presbitero/Register';
$route['adm/editar-presbitero'] = 'Presbitero/Editar';
$route['adm/remover-presbitero'] = 'Presbitero/Remover';

$route['adm/lista-inserir'] = 'ListaCulto/Register';
$route['adm/lista-editar-servicos'] = 'ListaCulto/Editar';
$route['adm/lista-remover-servicos'] = 'ListaCulto/Remover';

#rotas api
$route['adm/lc/buscar-veiculo'] = 'Api/ListarVeiculo';
$route['adm/lc/buscar-cidade'] = 'Api/ListarCidade';
$route['adm/lc/buscar-anciao'] = 'Api/ListarAnciao';
$route['adm/lc/buscar-encarregado'] = 'Api/ListarEncarregado';
$route['adm/lc/inserir-presbitero'] = 'Api/CadastroPresbitero';
$route['adm/lc/inserir-veiculo'] = 'Api/CadastroVeiculo';
$route['adm/lc/inserir-cidade'] = 'Api/CadastroCidade';
$route['adm/lc/inserir-arquivo'] = 'Api/InserirPDF';

#API do aplicatico appListaCCB
$route['app/regioes'] = 'ApiApp/ListarRegioes';
$route['app/lista'] = 'ApiApp/Lista';
$route['app/estados'] = 'ApiApp/ListarEstados';
$route['app/cidades'] = 'ApiApp/ListarCidades';
$route['app/lista-cidade'] = 'ApiApp/ListasPerCidade';
$route['app/lista-culto'] = 'ApiApp/ListasPerCulto';
$route['app/culto-detalhes'] = 'ApiApp/CultoDetalhe';
$route['app/lista-id'] = 'ApiApp/ListarPerId';
$route['app/email'] = 'ApiApp/EnviarEmail';
$route['app/assinar'] = 'ApiApp/AssinarEmail';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

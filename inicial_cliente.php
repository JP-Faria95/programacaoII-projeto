<?php
session_start();
$nome    = $_SESSION['nome'] ?? 'Usuário teste';
$usuario = $_SESSION['usuario'] ?? 'user_teste';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/2-bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/3-DataTables/datatables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script src="../../4-js/notify.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="/2-bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="estilos.css">
    <title>Página Inicial Cliente</title>
</head>

<style>
    .notifyjs-container span[data-notify-text] {
        font-size: 18px!important;
    }
    .notifyjs-corner{
        bottom: 0px!important;
        display: flex!important;
        flex-direction: column-reverse!important;
        position: fixed!important;
        right: 0px!important;
    }
</style>

<body class="pagina_inicial fonte_estilo">
    <div class="pagina_inicial_container_menu">
        <select class="selectpicker" title="CATEGORIAS" placeholder="CATEGORIAS" id="select_categorias"></select>
        <i class="glyphicon glyphicon-search icone_categoria icone_categoria_buscar" title="Buscar" id="btn_busca_categorias"></i>
        <div class="icone_separador"></div>
        <select class="selectpicker" title="PRODUTOS" placeholder="PRODUTOS" id="select_produtos"></select>
        <i class="glyphicon glyphicon-plus icone_categoria" title="Adicionar Produto" id="btn_add_produto" style="color:green;"></i>
        <i class="glyphicon glyphicon-shopping-cart icone_categoria icone_categoria_usuarios" title="Ver Usuários" id="btn_usuario_produto"></i>
        <!-- <i class="glyphicon glyphicon-user icone_usuario" style="left: 1280px!important;"></i> -->
        <div id="usuario_infos" class="pagina_inicial_usuario_infos">
            <label id="label_usuario_infos"></label>
        </div>
        <i class="glyphicon glyphicon glyphicon-off icone_categoria icone_usuario_sair" id="btn_sair_usuario"></i>
    </div>

    <!-- TABELA DAS CATEGORIAS -->
    <table class="table datatable_lupa" id="tabela_categorias"></table>

     <!-- TABELA DOS PRODUTOS DE UMA CATEGORIA -->
    <table class="table datatable_lupa" id="tabela_categorias_produtos"></table>

    <!-- MODAL DE CRIAR VINCULO DO USUÁRIO COM O PRODUTO -->
    <div class="modal fade" tabindex="-1" id="modal_produto">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="div_produto">
                        <div class="div_add_categoria">
                            <div class="div_produto_linhas">
                                <label style="margin-bottom:20px;">Produto: </label>
                                <input type="text" id="input_produto" maxlength="100">
                                <label style="margin-bottom:20px;">Estoque: </label>
                                <input type="text" id="input_produto_estoque" maxlength="6">
                                <label style="margin-left:22px!important;">Valor: </label>
                                <input type="text" id="input_produto_valor" maxlength="13" placeholder="R$ 0,00">
                                <div class="switch-label">
                                    <span style="margin-left:22px;">Ativo: </span>
                                    <label class="switch">
                                        <input type="checkbox" checked id="switch_produto_ativo">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div> 
                            <label>Categoria: </label>
                            <select class="selectpicker" title="Selecione" placeholder="Selecione" id="select_categorias2"></select>
                        </div>
                        <div class="div_add_categoria" style="border:0px!important;text-align:center!important;">
                            <label style="margin-top:20px;">Quantidade do produto: </label>
                            <input type="text" class="input_quantidade_produto" id="input_quantidade_produto" maxlength="6">
                        </div>
                    </div>
                    <div class="div_cadastro_finalizado" id="div_produto_sucesso">
                        <label id="label_produto_sucesso"></label>
                    </div>
                </div>
                <div class="modal-footer modal_footer_add_carrinho">
                    <button class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-sm" id="btn_produto"></button>
                    <button class="btn btn-sm btn-primary" id="btn_altera_quantidade"></button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DE VISUALIZAR O CARRINHO DO USUÁRIO -->
    <div class="modal fade" tabindex="-1" id="modal_carrinho_usuario">
        <div class="modal-dialog" style="width:1400px!important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title modal_title_usuarios">Meus Produtos</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table-bordered" id="tabela_carrinho_usuario"></table>
                    <div id="div_carrinho_finalizar_compra" style="display:flex;justify-content:center;">
                        <h4 id="h4_valor_total"></h4>
                    </div>
                    <div class="div_cadastro_finalizado" id="div_compra_finalizada">
                        <label id="label_compra_finalizada"></label>
                    </div>
                </div>
                <div class="modal-footer" style="display:flex;justify-content:center;">
                    <button class="btn btn-default" id="btn_voltar_compra" style="margin-right:20px">Voltar ao Carrinho</button>
                    <button class="btn btn-primary" id="btn_finalizar_compra">Finalizar Compra</button>
                    <button class="btn btn-primary" id="btn_finalizar_compra2">Finalizar Compra</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PARA EDITAR A QUANTIDADE DE PRODUTOS DO VINCULO OU EXCLUIR O VINCULO -->
    <div class="modal fade" tabindex="-1" id="modal_edita_vinculo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" style="margin-top:-10px!important" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div id="div_exclui_vinculo">
                        <div style="color:red;margin-top:20px;">
                            <label style="font-size:20px;">Deseja Excluir o Produto do seu Carrinho?</label>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm" style="margin-left:400px;margin-top:10px;" id="btn_excluir_vinculo">Excluir</button>
                    </div>
                    <div id="div_edita_quantidade_vinculo">
                        <div style="font-size:20px;margin-top:30px;">
                            <label>Nova quantidade: </label>
                            <input type="text" class="input_quantidade_produto" id="input_nova_quantidade" maxlength="6">
                        </div>
                        <button type="button" class="btn btn-primary btn-sm" style="margin-left:260px;margin-top:20px;" id="btn_edita_quantidade">Salvar</button>
                    </div>
                    <div id="div_sucesso_vinculo" style="text-align:center;">
                        <label id="label_sucesso_vinculo" style="font-size:25px;"></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script src="funcoes.js"></script>
<script>
    var nome    = "<?php echo $nome; ?>";
    var usuario = "<?php echo $usuario; ?>";
</script>
<script>
    $(document).ready(function(){
        var flag = true;

        $(document).on('click',function(e){
            $('#select_produtos').parent().find('.dropdown-toggle').removeClass('borda_cadastro_danger');
            /*if(!$(e.target).closest('#select_categorias,#btn_busca_categorias,#select_produtos,#tabela_categorias,#tabela_categorias_produtos,.bootstrap-select').length){
                $('#tabela_categorias_produtos').closest('.dataTables_wrapper').hide();
                $('#tabela_categorias').closest('.dataTables_wrapper').hide();
            }*/
        });
        $('#label_usuario_infos').html(usuario);
        $('#input_produto_valor').maskMoney({
            prefix: 'R$ ',
            allowNegative: false,
            thousands: '.',
            decimal: ',',
            affixesStay: true
        });

        // Desloga da conta
        $('#btn_sair_usuario').off('click').on('click',function(){
            conta_deslogar('index.php');
        });

        // Preenche o selectpicker das CATEGORIAS
        carrega_selectpicker('#select_categorias','categoria');

        // Clique na Lupa para buscar todas as categorias ou todos os produtos de uma categoria
        $('#btn_busca_categorias').off('click').on('click',function(){
            var id_categoria = $('#select_categorias').val();
            var id_datatable;

            // Se nenhuma categoria for escolhida, então mostra o datatable de todas as categorias
            if(id_categoria == ""){
                id_datatable = $('#tabela_categorias');
                colunas = [
                    {data: 'id_categoria' ,  title: 'ID'               ,  className: 'center'},
                    {data: 'categoria'    ,  title: 'Categoria'        ,  className: 'center'},
                    {data: 'tot_produtos' ,  title: 'Total Produtos'   ,  className: 'center'},
                    {data: 'prod_ativos'  ,  title: 'Produtos Ativos'  ,  className: 'center'}
                ];
                $('#tabela_categorias_produtos').hide();
                $('#tabela_categorias').show();
            }

            // Se escolher uma categoria, então mostra o datatable dos produtos da categoria escolhida
            else{
                id_datatable = $('#tabela_categorias_produtos');
                colunas = [
                    {data: 'id_produto'   ,  title: 'ID'           ,  className: 'center'},
                    {data: 'produto'      ,  title: 'Produto'      ,  className: 'center'},
                    {data: 'estoque'      ,  title: 'Estoque'      ,  className: 'center'},
                    {data: 'valor'        ,  title: 'Valor'        ,  className: 'center',
                        render: function(value,type,row){
                            return parseFloat(value).toLocaleString('pt-BR',{style: 'currency',currency:'BRL'});
                        }
                    },
                    {data: 'id_categoria' ,  title: 'ID'           ,  className: 'center', visible: false},
                    {data: 'categoria'    ,  title: 'Categoria'    ,  className: 'center'}
                ];
                $('#tabela_categorias').hide();
                $('#tabela_categorias_produtos').show();
            }

            if($.fn.DataTable.isDataTable(id_datatable)){
               id_datatable.DataTable().clear().destroy();
            }
            $('.btn_fecha_tabela').remove();
            $(id_datatable).DataTable({
                lengthChange: false,
                info: false,
                paging: false,
                searching: false,
                ajax:{
                    url: 'ajax.php',
                    type: 'post',
                    dataType: 'json',
                    data:{
                        acao: 'datatable_preenche',
                        id_categoria: id_categoria,
                    }
                },
                columns: colunas,
                rowCallback: function(row,data){
                    if(data.cat_ativa == 'N' || data.ativo == 'N'){
                        $(row).addClass('tabela_linha_inativa');
                    }
                },
                // Botão para fechar a tabela
                initComplete: function(){
                    $(this.api().table().container()).closest('.dataTables_wrapper')            
                        .prepend('<button class="btn glyphicon glyphicon-remove btn_fecha_tabela"></button>');
                }
            });
        });

        // Clique no 'X' para fechar a tabela de categorias/produtos da categoria
        $(document).off('click','.btn_fecha_tabela').on('click','.btn_fecha_tabela',function(){
            $(this).closest('.dataTables_wrapper').hide();
        });

        // Change da categoria, para carregar o produto
        $('#select_categorias').on('change',function(){
            var id_categoria = $('#select_categorias').val();
            carrega_selectpicker('#select_produtos','produto','',id_categoria);
            /*if(id_categoria != ''){
                $('#select_categorias').selectpicker('val',id_categoria).selectpicker('refresh');
            }*/
        });

        // Adicionar um produto ao carrinho pt 1
        $("#btn_add_produto").off('click').on('click',function(){
            var id_categoria = $('#select_categorias').val();
            $('#tabela_categorias_produtos').closest('.dataTables_wrapper').hide();
            $('#tabela_categorias').closest('.dataTables_wrapper').hide();
            if($('#select_produtos').val() == ''){
                $.notify("Escolha um Produto para Adicionar ao Carrinho","error");
                $('#select_produtos').parent().find('.dropdown-toggle').addClass('borda_cadastro_danger');
                return false;
            }
            $('#modal_produto').find('.modal-title').text('Adicionar Produto ao Carrinho');
            $('#input_produto').val($('#select_produtos option:selected').data('nome'));
            $('#input_produto').prop('disabled',true);
            $('#input_produto_estoque').val($('#select_produtos option:selected').data('estoque'));
            $('#input_produto_estoque').prop('disabled',true);
            $('#input_produto_valor').val($('#select_produtos option:selected').data('valor'));
            $('#input_produto_valor').maskMoney('mask');
            $('#input_produto_valor').prop('disabled',true);
            $('.switch-label').hide();
            carrega_selectpicker('#select_categorias2','categoria','produto_editar',id_categoria);
            $('#select_categorias2').prop('disabled',true);
            $('#modal_produto').find('.modal-body').css('height','320px');
            $('#btn_produto').addClass('btn-success').text("Adicionar");
            $('#btn_altera_quantidade').hide();
            $('#modal_produto').modal('show');
            if($('#input_produto_estoque').val() == 0){
                $('#input_quantidade_produto').prop('disabled',true);
            }
            else{
                $('#input_quantidade_produto').prop('disabled',false);
            }
        });

        // Adicionar um produto ao carrinho pt 2
        $('#btn_produto').off('click').on('click',function(){
            var id_categoria = $('#select_categorias').val();
            $('#input_quantidade_produto').removeClass('borda_cadastro_danger');
            if($('#input_quantidade_produto').val() == ''){
                $.notify("Informe a quantidade do Produto","error");
                $('#input_quantidade_produto').addClass('borda_cadastro_danger');
                return false;
            }
            if($('#input_quantidade_produto').val() <= 0){
                $.notify("Informe uma quantidade válida do Produto","error");
                $('#input_quantidade_produto').addClass('borda_cadastro_danger');
                return false;
            }
            if(parseInt($('#input_quantidade_produto').val(),10) > parseInt($('#input_produto_estoque').val(),10)){
                $.notify("Quantidade informada não pode ser mais que o estoque","error");
                $('#input_quantidade_produto').addClass('borda_cadastro_danger');
                return false;
            }
            $.ajax({
                url: 'ajax.php',
                type: 'post',
                dataType: 'json',
                data: {
                    acao: 'adicionar_produto_carrinho',
                    id_produto: $('#select_produtos').val(),
                    quantidade: $('#input_quantidade_produto').val()
                },
                success: function(resultado){
                    if(resultado.sucesso){
                        $('#modal_produto').find('.modal-title').html('&nbsp;');
                        $('#div_produto').hide();
                        $('#modal_produto').find('.modal-footer').hide();
                        $('#div_produto_sucesso').show();
                        $('#label_produto_sucesso').text("Vínculo criado com Sucesso").css('color','blue');
                        $('#modal_produto').find('.modal-body').css('height','220px');
                        carrega_selectpicker('#select_produtos','produto','',id_categoria);
                    }
                    else{
                        $('#modal_produto').find('.modal-title').html('&nbsp;');
                        $('#div_produto').hide();
                        $('#div_produto_sucesso').show();
                        $('#label_produto_sucesso').text("Você já tem esse produto no carrinho, deseja: ").css('color','red');
                        $('#btn_produto').hide();
                        $('#btn_altera_quantidade').show();
                        $('#btn_altera_quantidade').text("Alterar quantidade");
                        $('#btn_edita_quantidade').data('quantidade_atual',resultado.quantidade);
                    }
                }   
            });
        });

        // Se já tem o produto e tentou adicionar no carrinho novamente, pode escolher para alterar a quantidade
        $('#btn_altera_quantidade').off('click').on('click',function(){
            flag = false;
            $('#modal_edita_vinculo').modal('show');
            $('#modal_edita_vinculo').find('.modal-dialog').css('width','350px');
            $('#div_edita_quantidade_vinculo').show();
            $('#div_exclui_vinculo').hide();
            $('#div_sucesso_vinculo').hide();
            $('#modal_produto').addClass('modal_enfraquecido');
        });

        // Reset do modal de criar vinculo do produto com o usuário
        $('#modal_produto').on('hidden.bs.modal',function(){
            $('#div_produto').show();
            $('#modal_produto').find('.modal-footer').show();
            $('#div_produto_sucesso').hide();
            $('#modal_produto').find('.modal-body').css('height','320px');
            $('#input_quantidade_produto').removeClass('borda_cadastro_danger');
            $('#input_quantidade_produto').val('');
            $('#btn_produto').show();
            $('#btn_altera_quantidade').hide();
            $('#modal_produto').removeClass('modal_enfraquecido');

        });

        // Clique no carrinho para abrir o Carrinho do Usuário
        $('#btn_usuario_produto').off('click').on('click',function(){
            $('#modal_carrinho_usuario').modal('show');
            $('#div_carrinho_finalizar_compra').hide();
            $('#btn_voltar_compra').hide();
            $('#btn_finalizar_compra').show();
            $('#btn_finalizar_compra2').hide();
            $('#div_compra_finalizada').hide();
            $('#modal_carrinho_usuario').find('.modal-footer').show();
            if($.fn.DataTable.isDataTable('#tabela_carrinho_usuario')){
                $('#tabela_carrinho_usuario').DataTable().clear().destroy();
            }
            $('#tabela_carrinho_usuario').DataTable({
                language: {emptyTable: "Nenhum vínculo encontrado"},
                searching: false,
                lengthChange: false,
                info: false,
                paging: false,
                autoWidth: false,
                ajax:{
                    url: 'ajax.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        acao: 'preenche_datatable_carrinho_usuario', 
                    }
                },
                columns:[
                    {data: 'produto'       , title: 'Produto'},
                    {data: 'quantidade'    , title: 'Quantidade'},
                    {data: 'categoria'     , title: 'Categoria'},
                    {data: 'data_vinculo'  , title: 'Adicionado em',
                        render: function(value,type,row){
                            var campo_data = new Date(value + 'T00:00:00');
                            return campo_data.toLocaleDateString('pt-BR');
                        }
                    },
                    {data: 'preco_unidade', title: 'Preço Unidade',
                        render: function(value,type,row){
                        return parseFloat(value).toLocaleString('pt-BR',{style: 'currency',currency:'BRL'});
                    }},
                    {render: function(data,type,row){
                        var valor_total = parseFloat(row.quantidade) * parseFloat(row.preco_unidade);
                        return valor_total.toLocaleString('pt-BR',{style: 'currency',currency:'BRL'});
                    }, title: 'Valor Total'},
                    {render: function(data,type,row){
                        return `
                                <button class="glyphicon glyphicon-trash btn_excluir_vinculo" style="color:red"></button>
                                <button class="glyphicon glyphicon-pencil btn_editar_vinculo" style="color:blue"></button>  
                              `
                    }, title: 'Ações'},
                    {data: 'id_produto'    , title: '', visible: false}

                ],
                initComplete: function(){
                    $((this).api().table().container()).closest('.dataTable_wrapper')
                        .prepend('<button class="btn glyphicon glyphicon-remove btn_fecha_tabela"></button>');
                }
            });
        });

        // Clique no botão de excluir vinculo no carrinho pt 1
        $(document).off('click','.btn_excluir_vinculo').on('click','.btn_excluir_vinculo',function(){
            var linha_clicada = $('#tabela_carrinho_usuario').DataTable().row($(this).closest('tr')).data();
            var id_produto = linha_clicada.id_produto;
            var quantidade = linha_clicada.quantidade;
            $('#btn_excluir_vinculo').data('id_produto',id_produto);
            $('#btn_excluir_vinculo').data('quantidade',quantidade);
            $('#modal_edita_vinculo').modal('show');
            $('#modal_edita_vinculo').find('.modal-dialog').css('width','500px');
            $('#div_exclui_vinculo').show();
            $('#div_edita_quantidade_vinculo').hide();
            $('#div_sucesso_vinculo').hide();
            $('#modal_carrinho_usuario').addClass('modal_enfraquecido');
        });

        // Clique no botão de excluir vinculo no carrinho pt 2
        $(document).off('click','#btn_excluir_vinculo').on('click','#btn_excluir_vinculo',function(){
            var id_categoria = $('#select_categorias').val();
            $.ajax({
                url: 'ajax.php',
                type: 'post',
                dataType: 'json',
                data: {
                    acao: 'excluir_vinculo_usuprod',
                    id_produto: $('#btn_excluir_vinculo').data('id_produto'),
                    quantidade: $('#btn_excluir_vinculo').data('quantidade')
                },
                success: function(resultado){
                    carrega_selectpicker('#select_produtos','produto','',id_categoria);
                    $('#div_exclui_vinculo').hide();
                    $('#div_sucesso_vinculo').show();
                    $('#label_sucesso_vinculo').text("Produto Excluído do Carrinho").css('color','red');
                    $('#tabela_carrinho_usuario').DataTable().ajax.reload();
                }
            });
        });

        // Clique no botão de editar quantidade no carrinho pt 1
        $(document).off('click','.btn_editar_vinculo').on('click','.btn_editar_vinculo',function(){
            var linha_clicada = $('#tabela_carrinho_usuario').DataTable().row($(this).closest('tr')).data();
            $('#btn_edita_quantidade').data('id_produto',linha_clicada.id_produto);
            $('#btn_edita_quantidade').data('quantidade',linha_clicada.quantidade);
            $('#modal_edita_vinculo').modal('show');
            $('#modal_edita_vinculo').find('.modal-dialog').css('width','350px');
            $('#div_edita_quantidade_vinculo').show();
            $('#div_exclui_vinculo').hide();
            $('#div_sucesso_vinculo').hide();
            $('#modal_carrinho_usuario').addClass('modal_enfraquecido');
        });

        // Clique no botão de editar quantidade no carrinho pt 2
        $('#btn_edita_quantidade').off('click').on('click',function(){
            var id_categoria = $('#select_categorias').val();
            var id_produto = $('#btn_edita_quantidade').data('id_produto');
            var quantidade_atual = $('#btn_edita_quantidade').data('quantidade') ? parseInt($('#btn_edita_quantidade').data('quantidade')) : parseInt($('#btn_edita_quantidade').data('quantidade_atual'));
            var quantidade_nova = parseInt($('#input_nova_quantidade').val());
            var quantidade 
            var soma = (quantidade_atual < quantidade_nova) ? 1 : 0 ;
            if(soma){
                var atualiza_estoque = quantidade_nova - quantidade_atual;
            }
            else{
                atualiza_estoque = quantidade_atual - quantidade_nova;
            }
            if(quantidade_nova == quantidade_atual){
                $.notify("Quantidade nova é igual à atual","error");
                return false;
            }
            $.ajax({
                url: 'ajax.php',
                type: 'post',
                dataType: 'json',
                data: {
                    acao: 'edita_quantidade_vinculo',
                    id_produto: $('#btn_edita_quantidade').data('id_produto') ? $('#btn_edita_quantidade').data('id_produto') : $('#select_produtos').val(),
                    quantidade: quantidade_nova,
                    soma: soma,
                    atualiza_estoque: atualiza_estoque
                },
                success: function(resultado){
                    $('#div_edita_quantidade_vinculo').hide();
                    $('#div_sucesso_vinculo').show();
                    $('#label_sucesso_vinculo').text("Quantidade do Produto atualizada").css('color','blue');
                    $('#modal_edita_vinculo').find('.modal-dialog').css('width','480px');
                    carrega_selectpicker('#select_produtos','produto','',id_categoria);
                    if(flag)
                        $('#tabela_carrinho_usuario').DataTable().ajax.reload();
                }
            });
        })

        // Reset do modal do carrinho do usuario
        $('#modal_carrinho_usuario').on('hidden.bs.modal',function(){
            $('#modal_carrinho_usuario .modal_title_usuarios').text("Meus Produtos");
            $('#modal_carrinho_usuario .modal-dialog').css('width','1400px');
            $('#tabela_carrinho_usuario').show();
            $('#div_carrinho_finalizar_compra').hide();
            $('#btn_voltar_compra').hide();
            $('#btn_finalizar_compra2').hide();
            $('#btn_finalizar_compra').show();
            $('#div_compra_finalizada').hide();
            $('#modal_carrinho_usuario').find('.modal-footer').show();
        });

        // Reset do modal de editar quantidade do produto
        $('#modal_edita_vinculo').on('hidden.bs.modal',function(){
            $('#modal_carrinho_usuario').removeClass('modal_enfraquecido');
            $('#modal_produto').removeClass('modal_enfraquecido');
            $('#input_nova_quantidade').val('');
            $('#div_carrinho_finalizar_compra').hide();
        });


        // Finalizar a compra
        $('#btn_finalizar_compra').off('click').on('click',function(){
            $('#tabela_carrinho_usuario').hide();
            $('#btn_finalizar_compra').hide();
            $('#btn_finalizar_compra2').show();
            $('#btn_voltar_compra').show();
            $('#div_carrinho_finalizar_compra').show();
            $('#modal_carrinho_usuario .modal_title_usuarios').text("Finalizar a Compra");
            $('#modal_carrinho_usuario .modal-dialog').css('width','500px');
            var total_compra = 0;
            $('#tabela_carrinho_usuario').DataTable().rows().every(function(){
                var row = this.data();
                total_compra += (parseFloat(row.quantidade) * parseFloat(row.preco_unidade));
            });
            var total_formatado = total_compra.toLocaleString('pt-BR',{style: 'currency',currency: 'BRL'});
            $('#btn_finalizar_compra').data('total_compra',total_compra);
            $('#h4_valor_total').html("Valor Total: "+total_formatado);
        })

        $('#btn_voltar_compra').off('click').on('click',function(){
            $('#modal_carrinho_usuario .modal_title_usuarios').text("Meus Produtos");
            $('#modal_carrinho_usuario .modal-dialog').css('width','1400px');
            $('#tabela_carrinho_usuario').show();
            $('#div_carrinho_finalizar_compra').hide();
            $('#btn_voltar_compra').hide();
            $('#btn_finalizar_compra2').hide();
            $('#btn_finalizar_compra').show();
            $('#div_compra_finalizada').hide();
            $('#modal_carrinho_usuario').find('.modal-footer').show();
        })

        $('#btn_finalizar_compra2').off('click').on('click',function(){
            $('#modal_carrinho_usuario').find('.modal-title').html('&nbsp;');
            $('#h4_valor_total').hide();
            $('#modal_carrinho_usuario').find('.modal-footer').hide();
            $('#div_compra_finalizada').show();
            $('#div_compra_finalizada').css('margin-bottom','60px');
            $('#label_compra_finalizada').text("Parabéns pela sua compra!!").css('color','green');

        });
    });
</script>
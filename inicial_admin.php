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
    
    <!-- Bootstrap 3.4.1 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="estilos.css">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Jquery Mask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <!-- Notify.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>

    <!-- Jquery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Bootstrap 3.4.1 JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <!-- Bootstrap Datepicker CSS e JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>
    
    <title>PROJETO SEMESTRAL</title>
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

    <!-- BARRA SUPERIOR COM OS MENUS -->
    <div class="pagina_inicial_container_menu">
        <select class="selectpicker" title="CATEGORIAS" placeholder="CATEGORIAS" id="select_categorias"></select>
        <i class="glyphicon glyphicon-plus icone_categoria" title="Adicionar Categoria" id="btn_add_categoria" style="color:green;"></i>
        <i class="glyphicon glyphicon-pencil icone_categoria icone_categoria_editar" title="Editar Categoria" id="btn_edita_categoria"></i>
        <i class="glyphicon glyphicon-trash icone_categoria icone_categoria_excluir" title="Excluir Categoria" id="btn_exclui_categoria"></i>
        <i class="glyphicon glyphicon-search icone_categoria icone_categoria_buscar" title="Buscar" id="btn_busca_categorias"></i>
        <div class="icone_separador"></div>
        <select class="selectpicker" title="PRODUTOS" placeholder="PRODUTOS" id="select_produtos"></select>
        <i class="glyphicon glyphicon-plus icone_categoria" title="Adicionar Produto" id="btn_add_produto" style="color:green;"></i>
        <i class="glyphicon glyphicon-pencil icone_categoria icone_categoria_editar" title="Editar Produto" id="btn_edita_produto"></i>
        <i class="glyphicon glyphicon-trash icone_categoria icone_categoria_excluir" title="Excluir Produto" id="btn_exclui_produto"></i>
        <i class="glyphicon glyphicon-shopping-cart icone_categoria icone_categoria_usuarios" title="Ver Usuários" id="btn_usuario_produto"></i>
        <div class="icone_separador"></div>
        <div id="usuario_infos" class="pagina_inicial_usuario_infos">
            <label id="label_usuario_infos"></label>
        </div>
        <i class="glyphicon glyphicon glyphicon-off icone_categoria icone_usuario_sair" id="btn_sair" style="left:580px!important;"></i>
        <!--<i class="glyphicon glyphicon-user icone_usuario"></i>-->
    </div>

    <!-- MODAL DE CATEGORIA CADASTRAR/EDITAR/EXCLUIR -->
    <div class="modal fade" tabindex="-1" id="modal_categoria">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="div_add_categoria" id="div_categoria_infos">
                        <label>Categoria: </label>
                        <input type="text" id="input_categoria" maxlength="100" oninput="this.value = this.value.replace(/[^a-zA-ZÀ-ÿ\s]/g, '')">
                        <div class="switch-label">
                            <span style="margin-left:44px;">Ativo: </span>
                            <label class="switch">
                                <input type="checkbox" checked id="switch_categoria_ativo">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="div_cadastro_finalizado" id="div_categoria_sucesso">
                        <label id="label_categoria_sucesso"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-sm" id="btn_categoria"></button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DE PRODUTOS CADASTRAR/EDITAR/EXCLUIR -->
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
                    <div class="div_add_categoria" id="div_produto">
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
                    <div class="div_cadastro_finalizado" id="div_produto_sucesso">
                        <label id="label_produto_sucesso"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-sm" id="btn_produto"></button>
                </div>
            </div>
        </div>
    </div>

    <!-- TABELA DAS CATEGORIAS -->
    <table class="table datatable_lupa" id="tabela_categorias"></table>

     <!-- TABELA DOS PRODUTOS DE UMA CATEGORIA -->
    <table class="table datatable_lupa" id="tabela_categorias_produtos"></table>
    
    <!-- MODAL DOS USUÁRIOS DE UM PRODUTO/CATEGORIA ESPECÍFICO -->
     <div class="modal fade" tabindex="-1" id="modal_usuarios_produtos">
        <div class="modal-dialog modal_usuarios_produtos" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title modal_title_usuarios">Usuários</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal_title_usuarios modal_title_usuarios_infos">
                        <h4 id="h4_modal_usuarios_produtos_1"></h4>
                        <h4 id="h4_modal_usuarios_produtos_2"></h4>
                    </div>
                </div>
                <div class="modal-body">
                    <table class="table-bordered" id="tabela_usuarios_produtos"></table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default btn-sm" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
     </div>

    <!-- MODAL DO VINCULO USUÁRIO E PRODUTO EXCLUSÃO -->
    <div class="modal fade" tabindex="-1" id="modal_confirma_excluir_usuprod">
        <div class="modal-dialog modal_confirma_excluir_usuprod">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal_titulo_usuprod"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <button class="btn btn-default btn-sm" style="margin-left:120px;" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-danger btn-sm" id="btn_excluir_vinculo">Confirmar</button>
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
        var evento;
        $('#label_usuario_infos').html(usuario+"[ADMIN]");

        // Deslogar da conta
        $(document).on('click','#btn_sair',function(){
            conta_deslogar('index.php');
        });

        /////////////////////////
        /////// CATEGORIAS /////
        ////////////////////////
        $(document).on('click',function(e){
            $('#select_categorias').parent().find('.dropdown-toggle').removeClass('borda_cadastro_danger');
            $('#select_produtos').parent().find('.dropdown-toggle').removeClass('borda_cadastro_danger');
        });

        // Preenche o selectpicker das CATEGORIAS ao abrir a pagina
        carrega_selectpicker('#select_categorias','categoria');

        // Reseta o modal quando for fechado
        $('#modal_categoria').on('hidden.bs.modal',function(){
            div_limpa_campos('div_categoria_infos');
            $('#modal_categoria').find('.modal-footer').show();
            $('#div_categoria_infos').show();
            $('#switch_categoria_ativo').prop('checked', true);
            $('#input_categoria').prop('readonly',false);
            $('#switch_categoria_ativo').prop('disabled',false);
        });

        // Clique no botão '+' para adicionar categoria
        $('#btn_add_categoria').off('click').on('click',function(){
            evento = 'categoria_cadastrar'
            $('#div_categoria_add_sucesso').hide();
            $('#modal_categoria').modal('show');
            $('#modal_categoria').find('.modal-title').text("Categoria - Cadastrar");
            $('#div_categoria_sucesso').hide();
            $('#btn_categoria').removeClass('btn-primary btn-danger');
            $('#btn_categoria').addClass('btn-success');
            $('#btn_categoria').text("Cadastrar");
            $('#select_categorias').val('').selectpicker('refresh');
        });

        // Clique no botão de 'lapis' para editar uma categoria
        $('#btn_edita_categoria').off('click').on('click',function(){
            evento = 'categoria_editar';
            var categoria_id    = $('#select_categorias').val();
            var categoria_nome  = $('#select_categorias option:selected').data('nome');
            var categoria_ativo = $('#select_categorias option:selected').data('ativo');
            if(categoria_id == ''){
                $.notify("Escolha uma Categoria para Editar","error");
                $('#select_categorias').parent().find('.dropdown-toggle').addClass('borda_cadastro_danger');
                return false;
            }
            else{
                $('#select_categorias').parent().find('.dropdown-toggle').removeClass('borda_cadastro_danger');
                $('#modal_categoria').modal('show');
                $('#modal_categoria').find('.modal-title').text("Categoria - Editar");
                $('#div_categoria_sucesso').hide();
                $('#btn_categoria').removeClass('btn-success btn-danger');
                $('#btn_categoria').addClass('btn-primary');
                $('#btn_categoria').text("Editar");
                $('#input_categoria').val(categoria_nome);
                if(categoria_ativo == 'N'){
                    $('#switch_categoria_ativo').prop('checked', false);
                }
            }
        });

        // Clique no botão 'lixeira' para excluir uma categoria
        $('#btn_exclui_categoria').off('click').on('click',function(){
            evento = 'categoria_excluir';
            var categoria_id    = $('#select_categorias').val();
            var categoria_nome  = $('#select_categorias option:selected').data('nome');
            var categoria_ativo = $('#select_categorias option:selected').data('ativo');
            if(categoria_id == ''){
                $.notify("Escolha uma Categoria para Excluir","error");
                $('#select_categorias').parent().find('.dropdown-toggle').addClass('borda_cadastro_danger');
                return false;
            }
            else{
                $('#select_categorias').parent().find('.dropdown-toggle').removeClass('borda_cadastro_danger');
                $('#modal_categoria').modal('show');
                $('#modal_categoria').find('.modal-title').text("Categoria - Excluir");
                $('#div_categoria_sucesso').hide();
                $('#btn_categoria').removeClass('btn-primary btn-success');
                $('#btn_categoria').addClass('btn-danger');
                $('#btn_categoria').text("Excluir");
                $('#input_categoria').val(categoria_nome);
                $('#input_categoria').prop('readonly',true);
                $('#switch_categoria_ativo').prop('disabled', true);
                if(categoria_ativo == 'N'){
                    $('#switch_categoria_ativo').prop('checked', false);
                }
            }
        });

        // Clique no botão 'btn_categoria' para Cadastrar/Editar/Excluir a categoria
        $('#btn_categoria').off('click').on('click',function(){
            $('#input_categoria').removeClass('borda_cadastro_danger');
            var id = $('#select_categorias').val();
            var categoria_atual = $('#select_categorias option:selected').data('nome');
            var categoria = $('#input_categoria').val();
            var ativo_atual = $('#select_categorias option:selected').data('ativo');
            var ativo = $('#switch_categoria_ativo').is(':checked') ? 'S' : 'N';
            var acao;
            var msg_sucesso;
            var msg_erro;

            // Checa se o campo da categoria está vazio
            if(categoria.length == 0){
                $.notify("Informe uma Categoria","error");
                $('#input_categoria').addClass('borda_cadastro_danger');
                return false;
            }
            if(evento == 'categoria_cadastrar'){
                acao         = 'categoria_cadastrar';
                msg_sucesso  = 'Categoria Cadastrada com Sucesso';
                msg_erro     = "Erro: A Categoria \""+categoria+"\" já está cadastrada"
            }
            else if(evento == 'categoria_editar'){
                acao = 'categoria_editar';
                msg_sucesso  = 'Categoria Editada com Sucesso';
                // Checa se os dados para envio tiveram alteração
                if(categoria_atual == categoria && ativo_atual == ativo){
                    msg_erro = 'Erro: Categoria Não foi Editada';
                    div_limpa_campos('div_categoria_infos');
                    $('#div_categoria_sucesso').show();
                    $('label#label_categoria_sucesso').css('color','red').text(msg_erro);
                    $('#modal_categoria').find('.modal-title').html('&nbsp;');
                    $('#modal_categoria').find('.modal-footer').hide();
                    return false;
                }
            }
            else if(evento == 'categoria_excluir'){
                acao = 'categoria_excluir';
                msg_sucesso  = 'Categoria Excluída com Sucesso';
            }
            $.ajax({
                url: 'ajax.php',
                type: 'post',
                dataType: 'json',
                data:{
                    acao: acao,
                    id: id,
                    categoria: categoria,
                    ativo: ativo
                },
                success: function(resultado){
                    if(resultado){
                        div_limpa_campos('div_categoria_infos');
                        $('#div_categoria_sucesso').show();
                        $('label#label_categoria_sucesso').text(msg_sucesso);
                        $('#modal_categoria').find('.modal-title').html('&nbsp;');
                        $('#modal_categoria').find('.modal-footer').hide();
                        carrega_selectpicker('#select_categorias','categoria');
                        carrega_selectpicker('#select_produtos','produto');
                    }
                    else{
                        div_limpa_campos('div_categoria_infos');
                        $('#div_categoria_sucesso').show();
                        $('label#label_categoria_sucesso').css('color','red').text(msg_erro);
                        $('#modal_categoria').find('.modal-title').html('&nbsp;');
                        $('#modal_categoria').find('.modal-footer').hide();
                    }
                }
            });
        });

        // Clique na 'lupa' para buscar todas as categorias do banco ou todos os produtos de uma categoria selecionada
        $('#btn_busca_categorias').off('click').on('click',function(){
            var id_categoria = $('#select_categorias').val();
            var id_datatable;

            // Se nenhuma categoria for escolhida, então mostra o datatable de todas as categorias
            if(id_categoria == ""){
                id_datatable = $('#tabela_categorias');
                colunas = [
                    {data: 'id_categoria' ,  title: 'ID'               ,  className: 'center'},
                    {data: 'categoria'    ,  title: 'Categoria'        ,  className: 'center'},
                    {data: 'cat_ativa'    ,  title: 'Ativa'            ,  className: 'center'},
                    {data: 'tot_produtos' ,  title: 'Total Produtos'   ,  className: 'center'},
                    {data: 'prod_ativos'  ,  title: 'Produtos Ativos'  ,  className: 'center'},
                    {data: 'prod_inativos',  title: 'Produtos Inativos',  className: 'center'},
                    
                   
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
                    {data: 'dt_estoque'   ,  title: 'Atualizado em',  className: 'center',
                        render: function(value,type,row){
                            var campo_data = new Date(value);
                            return campo_data.toLocaleDateString('pt-BR');
                        }
                    },
                    {data: 'valor'        ,  title: 'Valor'        ,  className: 'center',
                        render: function(value,type,row){
                            return parseFloat(value).toLocaleString('pt-BR',{style: 'currency',currency:'BRL'});
                        }
                    },
                    {data: 'ativo'        ,  title: 'Ativo'        ,  className: 'center'},
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
                language:{
                    emptyTable: "Não existem categorias"
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

        // Clique no botão 'X' para fechar a tabela
        $(document).on('click','.btn_fecha_tabela',function(){
            $(this).closest('.dataTables_wrapper').hide();
        });


        
        ///////////////////////
        ///// PRODUTOS ///////
        /////////////////////

        $('#div_produto_sucesso').hide();
        $('#input_produto_valor').maskMoney({
            prefix: 'R$ ',
            allowNegative: false,
            thousands: '.',
            decimal: ',',
            affixesStay: true
        });

        $('#select_categorias').off('change').on('change',function(){
            var id_categoria = $('#select_categorias').val();
            carrega_selectpicker('#select_produtos','produto','',id_categoria);
        })

        // Clique no '+' para adicionar um produto
        $('#btn_add_produto').off('click').on('click',function(){
            var id_categoria = $('#select_categorias').val();
            evento = 'produto_cadastrar';
            $('#modal_produto').modal('show');
            $('#modal_produto').find('.modal-title').text("Produto - Cadastrar");
            $('#input_produto_estoque').on('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });
            $('#modal_produto #select_categorias2').closest('.bootstrap-select').find('.dropdown-toggle').css('font-size', '15px');
            carrega_selectpicker('#select_categorias2','categoria');
            $('#btn_produto').removeClass('btn-danger btn-primary');
            $('#btn_produto').addClass('btn-success');
            $('#btn_produto').text('Cadastrar');
        });

        // Change do select de categorias no modal de adicionar PRODUTOS
        $('#select_categorias2').off('change').on('change',function(){
            console.log('mudamos');
            if($('#select_categorias2 option:selected').data('ativo') == 'N'){
                $('#switch_produto_ativo').prop('checked',false);
                $('#switch_produto_ativo').prop('disabled',true);
            }
            else{
                $('#switch_produto_ativo').prop('disabled',false);
            }
            $('#select_categorias2').selectpicker('refresh');
        });

        // Clique no 'lápis' para editar um produto
        $('#btn_edita_produto').off('click').on('click',function(){
            evento = 'produto_editar';
            var id_produto = $('#select_produtos').val();
            var produto = $('#select_produtos option:selected').data('nome');
            var estoque = $('#select_produtos option:selected').data('estoque');
            var valor = $('#select_produtos option:selected').data('valor');
            var ativo = $('#select_produtos option:selected').data('ativo');
            var id_categoria = $('#select_produtos option:selected').attr('data-id_categoria');

            if(id_produto == ''){
                $('#select_produtos').parent().find('.dropdown-toggle').addClass('borda_cadastro_danger');
                $.notify("Escolha um Produto para Editar","error");
                return false;
            }
            else{
                $('#select_produtos').parent().find('.dropdown-toggle').removeClass('borda_cadastro_danger');
                $('#modal_produto').modal('show');
                $('#modal_produto').find('.modal-title').text("Produto - Editar");
                $('#btn_produto').removeClass('btn-danger btn-success');
                $('#btn_produto').addClass('btn-primary');
                $('#btn_produto').text('Editar');
                $('input#input_produto').val(produto);
                $('input#input_produto_estoque').val(estoque);
                $('input#input_produto_valor').val(valor);
                $('#input_produto_valor').maskMoney('mask');
                if(ativo == 'S'){
                    $('#switch_produto_ativo').prop('checked',true);
                }
                else{
                    $('#switch_produto_ativo').prop('checked',false);
                }
                carrega_selectpicker('#select_categorias2','categoria','produto_editar',id_categoria);
                $('#modal_produto').data('id_categoria_atual',id_categoria);
            }
        });

        // Clique na 'lixeira' para excluir um produto
        $('#btn_exclui_produto').off('click').on('click',function(){
            evento = 'produto_excluir';
            var id_produto = $('#select_produtos').val();
            var produto = $('#select_produtos option:selected').data('nome');
            var estoque = $('#select_produtos option:selected').data('estoque');
            var valor = $('#select_produtos option:selected').data('valor');
            var ativo = $('#select_produtos option:selected').data('ativo');
            var id_categoria = $('#select_produtos option:selected').attr('data-id_categoria');

            if(id_produto == ''){
                $('#select_produtos').parent().find('.dropdown-toggle').addClass('borda_cadastro_danger');
                $.notify("Escolha um Produto para Excluir","error");
                return false;
            }
            else{
                $('#select_produtos').parent().find('.dropdown-toggle').removeClass('borda_cadastro_danger');
                $('#modal_produto').modal('show');
                $('#modal_produto').find('.modal-title').text("Produto - Excluir");
                $('#btn_produto').removeClass('btn-primary btn-success');
                $('#btn_produto').addClass('btn-danger');
                $('#btn_produto').text('Excluir');
                $('input#input_produto').val(produto);
                $('input#input_produto').attr('readonly',true);
                $('input#input_produto_estoque').val(estoque);
                $('input#input_produto_estoque').attr('readonly',true);
                $('input#input_produto_valor').val(valor);
                $('input#input_produto_valor').prop('disabled',true);
                $('#input_produto_valor').maskMoney('mask');
                $('#switch_produto_ativo').prop('disabled',true);
                if(ativo == 'S'){
                    $('#switch_produto_ativo').prop('checked',true);
                }
                else{
                    $('#switch_produto_ativo').prop('checked',false);
                }
                carrega_selectpicker('#select_categorias2','categoria','produto_editar',id_categoria);
                $('#select_categorias2').prop('disabled', true);
                $('#modal_produto').data('id_categoria_atual',id_categoria);    
            }
        });

        // Reseta o modal ao fechar
        $('#modal_produto').on('hidden.bs.modal',function(){
            div_limpa_campos('div_produto');
            $('#div_produto_sucesso').hide();
            $('label#label_produto_sucesso').text('');
            $('#div_produto').show();
            $('#switch_produto_ativo').prop('checked',true);
            $('#modal_produto').find('.modal-footer').show();
             $('input#input_produto').attr('readonly',false);
             $('input#input_produto_estoque').attr('readonly',false);
             $('input#input_produto_valor').prop('disabled',false);
             $('#switch_produto_ativo').prop('disabled',false);
             $('#select_categorias2').prop('disabled',false);
        });

        // Clique no botão 'btn_produto' para Cadastrar, Editar ou Excluir o PRODUTOS
        $('#btn_produto').off('click').on('click',function(){
            var id_produto = $('#select_produtos').val();
            var produto = $('#input_produto').val();
            var estoque = $('#input_produto_estoque').val();
            var valor = $('#input_produto_valor').val();
            var ativo = $('#switch_produto_ativo').is(':checked') ? 'S' : 'N';
            var categoria = $('#select_categorias2').val();
            var categoria_atual = $('#modal_produto').data('id_categoria_atual');
            var msg_sucesso;
            var msg_erro;

            if(!cadastro_valida_campo_input('div_produto') || categoria == ''){
                $.notify("Preencha todos os campos","error");
                $('#select_categorias2').parent().find('.dropdown-toggle').addClass('borda_cadastro_danger');
                return false;
            }

            else{
                $('#select_categorias2').parent().find('.dropdown-toggle').removeClass('borda_cadastro_danger');
                if(evento == 'produto_cadastrar'){
                    acao = 'produto_cadastrar';
                    msg_sucesso = 'Produto Cadastrado com Sucesso';
                    msg_erro = 'Erro: Produto \"'+produto+'\" já está cadastrado';
                }
                if(evento == 'produto_editar'){
                    acao = 'produto_editar';
                    msg_sucesso = 'Produto Editado com Sucesso';
                }
                if(evento == 'produto_excluir'){
                    acao = 'produto_excluir';
                    msg_sucesso = 'Produto \''+produto+'\' Excluido com Sucesso';
                }
                console.log('ajax');
                console.log(acao);
                console.log(id_produto);
                console.log(produto);
                console.log(estoque);
                console.log(valor);
                console.log(ativo);
                console.log(categoria);
                console.log(categoria_atual);
                //return false;
                $.ajax({
                    url: 'ajax.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        acao: acao,
                        id_produto: id_produto,
                        produto: produto,
                        estoque: estoque,
                        valor: valor,
                        ativo: ativo,
                        id_categoria: categoria,
                        id_categoria_atual: categoria_atual
                    },
                    success: function(resultado){
                        if(resultado){
                            $('#div_produto').hide();
                            $('#div_produto_sucesso').show();
                            $('label#label_produto_sucesso').text(msg_sucesso);
                            $('#modal_produto').find('.modal-title').html('&nbsp;');
                            $('#modal_produto').find('.modal-footer').hide();
                            carrega_selectpicker('#select_produtos','produto','categoria_atual');
                        }
                        else{
                            $('#div_produto').hide();
                            $('#div_produto_sucesso').show();
                            $('label#label_produto_sucesso').css('color','red').text(msg_erro);
                            $('#modal_produto').find('.modal-title').html('&nbsp;');
                            $('#modal_produto').find('.modal-footer').hide();
                        }
                    }
                });
            }
        });

        // Clique no botão 'carrinho' para ver os usuarios com seus produtos
        $('#btn_usuario_produto').off('click').on('click',function(){
            var id_categoria = $('#select_categorias').val();
            var id_produto = $('#select_produtos').val();

            if(id_categoria == ''){
                $.notify("Escolha uma Categoria","error");
                $('#select_categorias').parent().find('.dropdown-toggle').addClass('borda_cadastro_danger');
                return false;
            }
            if(id_produto == ''){
                $.notify("Escolha um Produto","error");
                $('#select_produtos').parent().find('.dropdown-toggle').addClass('borda_cadastro_danger');
                return false;
            }

            $('#modal_usuarios_produtos').modal('show');
        });

        // Abertura do modal 'usuarios_produtos' e evento de datatable da tabela 'usuarios_produtos'
        $('#modal_usuarios_produtos').on('shown.bs.modal',function(){
            var id_categoria = $('#select_categorias').val();
            var categoria = $('#select_categorias option:selected').data('nome');
            var id_produto = $('#select_produtos').val();
            var produto = $('#select_produtos option:selected').data('nome');

            $('#h4_modal_usuarios_produtos_1').text("Produto: "+produto);
            $('#h4_modal_usuarios_produtos_2').text("Categoria: "+categoria);

            if($.fn.DataTable.isDataTable("#tabela_usuarios_produtos")){
                $('#tabela_usuarios_produtos').DataTable().clear().destroy();
            }
            $('#tabela_usuarios_produtos').DataTable({
                language: {emptyTable: "Nenhum vínculo encontrado"},
                searching: false,
                lengthChange: false,
                info: false,
                paging: false,
                autoWidth: false,
                ajax: {
                    url: 'ajax.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        acao: 'busca_usuarios_produtos',
                        id_produto: id_produto
                    }
                },
                columns: [
                    {data: 'id_usuario' , title: '', visible: false},
                    {data: 'usuario'    , title: 'Usuário'         },
                    {data: 'quantidade' , title: 'Quantidade'      },
                    {render:function(data,type,row){
                        return `<i class="glyphicon glyphicon-remove-circle btn_excluir_produto" style="color:red;cursor:pointer"></i>`;
                    }, title: 'Ação'}
                ],
            });
        });

        // Reset do modal 'usuario_produtos' ao fechar
        $('#modal_usuarios_produtos').on('hidden.bs.modal',function(){
            $('#h4_modal_usuarios_produtos_1').text("");
            $('#h4_modal_usuarios_produtos_2').text("");
            $('#modal_usuarios_produtos').removeClass('modal_enfraquecido');
        });

        // Exclusão do produto vinculado a um Usuário pt 1
        $(document).on('click','.btn_excluir_produto',function(){
            var linha_clicada = $('#tabela_usuarios_produtos').DataTable().row($(this).closest('tr')).data();
            var id_usuario = linha_clicada['id_usuario'];
            var quantidade = linha_clicada['quantidade'];
            $('#btn_excluir_vinculo').data('id_usuario', id_usuario);
            $('#btn_excluir_vinculo').data('quantidade', quantidade);
            $('#modal_titulo_usuprod').text('Confirma Exclusão do Vínculo?').css('color','red');
            $('#modal_confirma_excluir_usuprod').modal('show');
            $('#modal_confirma_excluir_usuprod').find('.modal-body').show();
            $('#modal_usuarios_produtos').addClass('modal_enfraquecido');
        });

        // Exclusão do produto vinculado a um Usuário pt 2
        $(document).on('click','#btn_excluir_vinculo',function(){
            $.ajax({
                url: 'ajax.php',
                type: 'post',
                dataType: 'json',
                data: {
                    acao: 'excluir_vinculo_usuprod',
                    id_usuario: $('#btn_excluir_vinculo').data('id_usuario'),
                    id_produto: $('#select_produtos option:selected').val(),
                    quantidade: $('#btn_excluir_vinculo').data('quantidade')
                },
                success: function(resultado){
                    if(resultado){
                        $('#modal_titulo_usuprod').text('Vínculo Excluído com Sucesso').css('color','rgba(6, 107, 184, 1)');
                        $('#modal_confirma_excluir_usuprod').find('.modal-body').hide();
                        $('#tabela_usuarios_produtos').DataTable().ajax.reload();
                    }
                }
            });
        });

        $('#modal_confirma_excluir_usuprod').on('hidden.bs.modal',function(){
            $('#modal_usuarios_produtos').removeClass('modal_enfraquecido');
        });

    });
</script>

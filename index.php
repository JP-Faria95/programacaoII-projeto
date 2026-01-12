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
<body class="pagina_login">
    <div class="fonte_estilo">
        <div class="container_index">

        <!-- DIV DE LOGIN INICIAL -->
            <div id="div_tela_login">
                <div class="borda_central">
                    <h1>LOGIN</h1>
                </div>
                <div class="container_divs">
                    <div class="borda_inputs">
                        <label>Usuário: </label>
                        <input type="text" id="input_usuario" maxlength="20">
                    </div>
                    <div class="borda_inputs">
                        <label>Senha: </label>
                        <input type="password" id="input_senha" maxlength="20">
                    </div>
                </div>
                <div class="borda_central botaozinho">
                    <button type="button" class="btn btn-primary" id="btn_login_continuar">Continuar</button>
                </div>
                <div class="links_tela_login">
                    <a id="a_fazer_cadastro" style="margin-left:10px;">Fazer cadastro</a>
                    <a id="a_novo_usuario">Esqueci meu usuário</a>
                    <a id="a_nova_senha">Esqueci minha senha</a>
                </div>
            </div>

        <!-- DIV DE CADASTRO DE USUÁRIO PT 1 -->
            <div id="div_cadastro_dadospessoais" style="margin-left: 10px;">
               <div class="borda_central">
                    <h1>Novo Cadastro</h1>
               </div>
               <h6 class="h6_estilo_cadastro">Todos os campos são obrigatórios</h6>
                <div class="borda_inputs2">
                    <label>Nome completo: </label>
                    <input type="text" id="input_cadastro_nome" maxlength="100">
                </div>
                <div class="borda_inputs2">
                    <label>CPF: </label>
                    <input type="text" id="input_cadastro_cpf" placeholder="000.000.000-00">
                </div>
                <div class="borda_inputs2">
                    <label>Email: </label>
                    <input type="text" id="input_cadastro_email" placeholder="exemplo@exemplo.com">
                </div>
                <div class="borda_inputs2">
                    <label>Data de nascimento: </label>
                    <input type="text" id="input_cadastro_dtnascimento" placeholder="DD/MM/AAAA">
                </div>
                <div class="borda_inputs2">
                    <label>Celular: </label>
                    <input type="text" id="input_cadastro_celular" placeholder="(00)000000000">
                </div>
                <div class="row">
                    <div class="borda_central botaozinho_cadastro">
                        <button type="button" class="btn btn-primary btn-sm" id="btn_voltar_inicio">Voltar</button>
                    </div>
                    <div class="borda_central botaozinho_cadastro">
                        <button type="button" class="btn btn-primary btn-sm" id="btn_cadastro_proximo">Próximo</button>
                    </div>
                </div>
            </div>

        <!-- DIV DE CADASTRO DE USUÁRIO PT 2 -->
            <div id="div_cadastro_usuario_senha">
                <div class="borda_central">
                    <h1>Novo Cadastro</h1>
               </div>
               <h6 class="h6_estilo_cadastro">Todos os campos são obrigatórios</h6>
               <div class="borda_usuario_senha">
                    <div class="borda_inputs borda_usuario_senha_tira_borda">
                        <label>Usuário: </label>
                        <input type="text" id="input_cadastro_usuario" maxlength="20">
                    </div>
                    <div class="borda_inputs borda_usuario_senha_tira_borda">
                        <label>Senha: </label>
                        <input type="password" id="input_cadastro_senha" maxlength="20">
                    </div>
               </div>
               <div class="row">
                    <div class="borda_central botaozinho_cadastro">
                        <button type="button" class="btn btn-primary" id="btn_anterior_cadastro">Anterior</button>
                    </div>
                    <div class="borda_central botaozinho_cadastro">
                        <button type="button" class="btn btn-primary" id="btn_cadastro_cadastrar">Cadastrar</button>
                    </div>
                </div>
            </div>

        <!-- DIV DE CADASTRO FINALIZADO / LOGIN REALIZADO -->
            <div id="div_cadastro_login_realizado">
                <div class="div_cadastro_finalizado">
                    <label id="label_cadastro_login_realizado"></label>
                </div>
                <div class="div_cadastro_sucesso">
                    <label id="label_cadastro_sucesso"></label>
                </div>
                <div class="label_redireciona">
                    <label id="label_cadastro_redireciona"></label>
                </div>
            </div>

        <!-- DIV DE RECUPERAR USUARIO/SENHA -->
            <div id="div_recuperar_usuario_senha">
                <div class="borda_central">
                    <h1 id="div_titulo_recuperar"></h1>
               </div>
                <div class="campo_cpf_alterar_usuario">
                    <label>CPF: </label>
                    <input type="text" id="input_recuperar_cpf">
                    <button type="button" class="btn btn-primary btn-sm" id="btn_buscar_cpf" style="margin-left:20px;">Buscar</button>
                </div>
                <div id="div_alterar_confirmar">
                    <div class="borda_inputs_usuario_senha" style="margin-top:30px;">
                        <label for="input_alterar_usuario_senha"></label>
                        <input type="text" id="input_alterar_usuario_senha" maxlength="20">
                    </div>
                    <div class="borda_inputs_usuario_senha" style="margin-top:10px;">
                        <label for="input_alterar_confirmar"></label>
                        <input type="text" id="input_alterar_confirmar" maxlength="20">
                    </div>
                    <div class="botaozinho_alterar_voltar">
                        <button type="button" class="btn btn-primary btn-sm" id="btn_voltar_inicio2">Voltar</button>
                        <button type="button" class="btn btn-primary btn-sm" id="btn_alterar_confirmar">Alterar</button>
                    </div>
                </div>
                <div class="borda_central">
                    <button type="button" class="btn btn-primary btn-sm" id="btn_voltar_inicio3">Inicio</button>
                </div>
            </div>

        <!-- DIV ALTERAÇÃO DE USUÁRIO OU SENHA FINALIZADO -->
            <div id="div_alterar_finalizado">
                <div class="div_cadastro_finalizado">
                    <label id="label_alterar_finalizado"></label>
                </div>
                <div class="botaozinho_cadastro" style="margin-left:260px!important;">
                    <button type="button" class="btn btn-primary btn-sm" id="btn_alterar_finalizado">Inicio</button>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
<script src="funcoes.js"></script>
<script>
    $(document).ready(function(){
        ///////////////////////
        // VARIÁVEIS GLOBAIS //
        //////////////////////

        var alteracao = '';

        //////////////////////////////////
        // INICIO DA TELA: DIV DE LOGIN //
        /////////////////////////////////
    
        // Esconde e limpa as outras divs
        div_limpa_campos('div_cadastro_dadospessoais');
        div_limpa_campos('div_cadastro_usuario_senha');
        div_limpa_campos('div_recuperar_usuario_senha');
        div_limpa_campos('div_cadastro_login_realizado');
        div_limpa_campos('div_alterar_confirmar');
        div_limpa_campos('div_alterar_finalizado');
        $('#input_usuario').val('');
        $('#input_senha').val('');

        // Verifica se o acesso é por meio de 'admin_teste' para experiência dos usuários no GitHub
        var admin_teste = verifica_parametro_url('admin_teste');
        if(admin_teste){
            $('#btn_login_continuar').trigger('click');
        }

        // Clique no botão 'Continuar' na tela de login
        $('#btn_login_continuar').off('click').on('click',function(){  

            // Checa se preencheu os campos Usuário e Senha
            if(!cadastro_valida_campo_input('div_tela_login') && !admin_teste){
                $.notify("Preencha todos os campos","error");
                return false;
            }

            // Verifica no banco se existe o cadastro
            else{
                $.ajax({
                    url: 'ajax.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        acao: 'realiza_login',
                        usuario: $('#input_usuario').val(),
                        senha: $('#input_senha').val() ? $('#input_senha').val() : null,
                        admin_teste: admin_teste ? admin_teste : null
                    },
                    success: function(resultado){
                        if(resultado.sucesso){
                            var usuario = $('#input_usuario').val();
                            $('#div_cadastro_login_realizado').show();
                            $('label#label_cadastro_login_realizado').html("Login realizado com<br>Sucesso!");
                            $('label#label_cadastro_sucesso').text("Seja Bem Vindo "+usuario);
                            div_limpa_campos('div_tela_login');
                            if(resultado.tipo_user == 1)
                                redireciona_pagina_inicial('inicial_admin.php');
                            else if(resultado.tipo_user == 0)
                                redireciona_pagina_inicial('inicial_cliente.php');
                        }
                        else{
                            $.notify("Usuário ou Senha inválidos","error");
                            $('#input_usuario').addClass('borda_cadastro_danger');
                            $('#input_senha').addClass('borda_cadastro_danger');
                            return false;
                        }
                    }
                });
            }
        });


        ///////////////////////
        // REALIZAR CADASTRO //
        //////////////////////


        // Clique no botão "realizar cadastro"
        $('#a_fazer_cadastro').off('click').on('click',function(){
            div_limpa_campos('div_tela_login');
            $('#div_cadastro_dadospessoais').show();

            // Mascara do campo cpf
            $('#input_cadastro_cpf').mask('000.000.000-00');

            // Mascara do campo data de nascimento
            $('#input_cadastro_dtnascimento').mask('00/00/0000');

            // Mascara do campo de telefone
            $('#input_cadastro_celular').mask('(00)000000000');
        });

        // Clique no botão "Próximo" que vai pra pt2 de cadastro
        $('#btn_cadastro_proximo').off('click').on('click',function(){

            // Checa se preencheu todos os campos
            if(!cadastro_valida_campo_input('div_cadastro_dadospessoais')){
                $.notify("Preencha todos os campos","error");
                return false;
            }

            // Checa se colocou um nome válido
            var checa_nome = /^[A-Za-zÀ-ÿ\s]+$/;
            if(!checa_nome.test($('#input_cadastro_nome').val())){
                $('#input_cadastro_nome').addClass('borda_cadastro_danger');
                $.notify("Informe um Nome válido","error");
                return false;
            }

            // Colocou um cpf válido?
            if($('#input_cadastro_cpf').val().length < 14){
                $.notify("Informe um CPF válido","error");
                $('#input_cadastro_cpf').addClass('borda_cadastro_danger');
                return false;
            }

            // Checar email válido
            var checa_email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if(!checa_email.test($('#input_cadastro_email').val())){
                $.notify("Informe um Email válido","error");
                $('#input_cadastro_email').addClass('borda_cadastro_danger');
                return false;
            }

            // Checar a data de nascimento
            if(!cadastro_valida_data_nascimento($('#input_cadastro_dtnascimento').val())){
                $.notify("Informe uma Data de nascimento válida","error");
                $('#input_cadastro_dtnascimento').addClass('borda_cadastro_danger')
                return false;
            }

            // Checar telefone
            if($('#input_cadastro_celular').val().length < 13){
                $.notify("Informe um Celular válido","error");
                return false;
            }

            else{
                div_limpa_campos('div_cadastro_dadospessoais',false);
                $('#div_cadastro_usuario_senha').show();
            }
        });

        // Clique no botão "Anterior" na pt2 de cadastro que volta para pt1
        $('#btn_anterior_cadastro').off('click').on('click',function(){
            div_limpa_campos('div_cadastro_usuario_senha');
            $('#div_cadastro_dadospessoais').show();
            $('#input_cadastro_usuario').removeClass('borda_cadastro_danger');
        });

        // Clique no botão "Voltar" que volta para tela de login inicial
        $('#btn_voltar_inicio').off('click').on('click',function(){
            div_limpa_campos('div_cadastro_dadospessoais');
            div_limpa_campos('div_recuperar_usuario_senha');
            $('#div_tela_login').show();
        });

        // Clique no botão "Cadastrar" na ultima tela de cadastro
        $('#btn_cadastro_cadastrar').off('click').on('click',function(){

            // Preencheu todos os campos?
            if(!cadastro_valida_campo_input('div_cadastro_usuario_senha')){
                $.notify("Preencha todos os campos","error");
                return false;
            }

            // Checar o campo usuario e senha ao mesmo tempo
            if($('#input_cadastro_usuario').val().length < 6 && $('#input_cadastro_senha').val().length < 6){
                $('#input_cadastro_usuario').addClass('borda_cadastro_danger');
                $('#input_cadastro_senha').addClass('borda_cadastro_danger')
                $.notify("O Usuário e a Senha devem ter no mínimo 6 caracteres","error");
                return false;
            }

            // Checar campo usuário
            if($('#input_cadastro_usuario').val().length < 6){
                $('#input_cadastro_usuario').addClass('borda_cadastro_danger');
                $.notify("O Usuário deve ter no mínimo 6 caracteres","error");
                return false;
            }

            // Checar o campo senha
            if($('#input_cadastro_senha').val().length < 6){
                $('#input_cadastro_senha').addClass('borda_cadastro_danger');
                $.notify("A Senha deve ter no mínimo 6 caracteres","error");
                return false;
            }

            else{
                $.ajax({
                    url: 'ajax.php',
                    type: 'post',
                    dataType: 'json',
                    data:{
                        acao: 'cadastrar_usuario',
                        nome: $('#input_cadastro_nome').val(),
                        cpf:  $('#input_cadastro_cpf').val(),
                        email: $('#input_cadastro_email').val(),
                        dt_nasc: $('#input_cadastro_dtnascimento').val(),
                        celular: $('#input_cadastro_celular').val(),
                        usuario: $('#input_cadastro_usuario').val(),
                        senha: $('#input_cadastro_senha').val()
                    },
                    success: function(resultado){
                        if(resultado.sucesso){
                            var usuario = $('#input_cadastro_nome').val();
                            $('#div_cadastro_login_realizado').show();
                            $('label#label_cadastro_login_realizado').html("Cadastro realizado com<br>Sucesso!");
                            $('label#label_cadastro_sucesso').text("Seja Bem Vindo "+usuario);
                            div_limpa_campos('div_cadastro_usuario_senha');
                            div_limpa_campos('div_cadastro_dadospessoais');
                            redireciona_pagina_inicial('index.php');
                        }
                        else{
                            if(resultado.erro == 'cpf'){
                                $.notify(resultado.msg,"error");
                                $('#input_cadastro_cpf').addClass('borda_cadastro_danger');
                            }
                            if(resultado.erro == 'email'){
                                $.notify(resultado.msg,"error");
                                $('#input_cadastro_email').addClass('borda_cadastro_danger');
                            }
                            if(resultado.erro == 'celular'){
                                $.notify(resultado.msg,"error");
                                $('#input_cadastro_celular').addClass('borda_cadastro_danger');
                            }
                            if(resultado.erro == 'usuario'){
                                $.notify(resultado.msg,"error");
                                $('#input_cadastro_usuario').addClass('borda_cadastro_danger');
                            }
                            return false;
                        }
                    }
                });
            }
        });

        //////////////////////////////
        // ALTERAR USUÁRIO OU SENHA///
        /////////////////////////////


        // Clique no botão "Esqueci usuário"
        $('#a_novo_usuario').off('click').on('click',function(){
            alteracao = 'usuario';
            div_limpa_campos('div_tela_login');
            $('#div_recuperar_usuario_senha').show();

            // Coloca mascara de cpf no campo de cpf
            $('#input_recuperar_cpf').mask('000.000.000-00');

            // Altera o titulo da div
            $('#div_titulo_recuperar').text("Alterar Usuário");
        });

        // Clique no botão "Esqueci minha senha"
        $('#a_nova_senha').off('click').on('click',function(){
            alteracao = 'senha';
            div_limpa_campos('div_tela_login');
            $('#div_recuperar_usuario_senha').show();

            // Coloca mascara de cpf no campo de cpf
            $('#input_recuperar_cpf').mask('000.000.000-00');

            // Altera o titulo da div
            $('#div_titulo_recuperar').text("Alterar Senha");
        });

        // Clique no botão 'Buscar' o cpf 
        $('#btn_buscar_cpf').off('click').on('click',function(){
            if(!cadastro_valida_campo_input('div_recuperar_usuario_senha')){
                $.notify("Preencha todos os campos","error");
                return false;
            }
            else if($('#input_recuperar_cpf').val().length < 14){
                $.notify("Insira um CPF válido","error");
                return false;
            }

            else{
                $.ajax({
                    url: 'ajax.php',
                    type: 'post',
                    dataType: 'json',
                    data:{
                        acao: 'buscar_cpf',
                        cpf: $('#input_recuperar_cpf').val()
                    },
                    success: function(resultado){
                        if(resultado){
                            $('#div_alterar_confirmar').show();
                            if(alteracao == 'usuario'){
                                $('label[for="input_alterar_usuario_senha"]').text("Novo Usuário");
                                $('label[for="input_alterar_confirmar"]').text("Confirmar Usuário");
                            }
                            else if(alteracao == 'senha'){
                                $('label[for="input_alterar_usuario_senha"]').text("Nova Senha");
                                $('label[for="input_alterar_confirmar"]').text("Confirmar Senha");
                                $('#input_alterar_usuario_senha,#input_alterar_confirmar').attr('type','password');
                            }
                        }
                        else{
                            $.notify("CPF não encontrado","error");
                            $('#input_recuperar_cpf').addClass('borda_cadastro_danger');
                            return false;
                        }
                    }
                });
            }
        });

        // Clique no botão 'Voltar' para limpar o campo cpf
        $('#btn_voltar_inicio2').off('click').on('click',function(){
            div_limpa_campos('div_alterar_confirmar');
            $('#input_recuperar_cpf').val('');
            $('#input_alterar_usuario_senha').removeClass('borda_cadastro_danger');
            $('#input_alterar_confirmar').removeClass('borda_cadastro_danger');
        });

        // Clique no botão 'Inicio' para voltar à pagina inicial
        $('#btn_voltar_inicio3').off('click').on('click',function(){
            div_limpa_campos('div_alterar_confirmar');
            div_limpa_campos('div_recuperar_usuario_senha');
            $('#div_tela_login').show();
            $('#input_alterar_usuario_senha').removeClass('borda_cadastro_danger');
            $('#input_alterar_confirmar').removeClass('borda_cadastro_danger');
        });

        // Clique no botão 'Alterar' para alterar usuário ou senha
        $('#btn_alterar_confirmar').off('click').on('click',function(){

            // Checa se preencheu os campos
            if(!cadastro_valida_campo_input('div_alterar_confirmar')){
                if(alteracao == 'usuario'){
                    $.notify("Informe e confirme um novo Usuário","error");
                    return false;
                }
                else if(alteracao == 'senha'){
                    $.notify("Informe e confirme uma nova Senha","error");
                    return false;
                }
            }

            // Checa se tem minimo 6 caracteres
            else if($('#input_alterar_usuario_senha').val().length < 6 && $('#input_alterar_confirmar').val().length < 6){
                if(alteracao == 'usuario'){
                    $.notify("O Usuário deve ter no mínimo 6 caracteres","error");
                }
                if(alteracao == 'senha'){
                    $.notify("A senha deve ter no mínimo 6 caracteres","error");
                }
                $('#input_alterar_usuario_senha').addClass('borda_cadastro_danger');
                $('#input_alterar_confirmar').addClass('borda_cadastro_danger');
                return false;
            }

            else if($('#input_alterar_usuario_senha').val().length < 6){
                if(alteracao == 'usuario'){
                    $.notify("O Usuário deve ter no mínimo 6 caracteres","error");
                }
                if(alteracao == 'senha'){
                    $.notify("A senha deve ter no mínimo 6 caracteres","error");
                }
                $('#input_alterar_usuario_senha').addClass('borda_cadastro_danger');
                return false;
            }

            else if($('#input_alterar_confirmar').val().length < 6){
                if(alteracao == 'usuario'){
                    $.notify("O Usuário deve ter no mínimo 6 caracteres","error");
                }
                if(alteracao == 'senha'){
                    $.notify("A senha deve ter no mínimo 6 caracteres","error");
                }
                $('#input_alterar_confirmar').addClass('borda_cadastro_danger');
                return false;
            }

            // Checa se são iguais:
            if($('#input_alterar_usuario_senha').val() != $('#input_alterar_confirmar').val()){
                if(alteracao == 'usuario'){
                    $.notify("Confirmação de Usuário errada","error");
                }
                if(alteracao == 'senha'){
                    $.notify("Confirmação de Senha errada","error");
                }
                $('#input_alterar_usuario_senha').addClass('borda_cadastro_danger');
                $('#input_alterar_confirmar').addClass('borda_cadastro_danger');
                return false;
            }

            else{
                $.ajax({
                    url: 'ajax.php',
                    type: 'post',
                    dataType: 'json',
                    data:{
                        acao: 'alterar_usuario_senha',
                        alteracao: alteracao,
                        cpf: $('#input_recuperar_cpf').val(),
                        novo: $('#input_alterar_usuario_senha').val()
                    },
                    success: function(resultado){
                        if(resultado){
                            div_limpa_campos('div_recuperar_usuario_senha');
                            if(alteracao == 'usuario'){
                                $('label#label_alterar_finalizado').text("Usuário alterado com sucesso");
                            }
                             else if(alteracao == 'senha'){
                                $('label#label_alterar_finalizado').text("Senha alterada com sucesso");
                            }
                            $('#div_alterar_finalizado').show();
                        }
                    }
                });
            }
        });

        // Clique no botão 'Inicio' na tela de alterar usuário/senha com sucesso
        $('#btn_alterar_finalizado').off('click').on('click',function(){
            div_limpa_campos('div_alterar_finalizado');
            div_limpa_campos('div_alterar_confirmar');
            $('#div_tela_login').show();
        });
    });
</script>

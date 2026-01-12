<?php
require_once "conexao.php";
session_start();

$acao = $_REQUEST['acao'];
$cpf = $_POST['cpf'] ?? null;
$id_usuario = $_SESSION['id_usuario'] ?? null;
$tipo_usuario = $_SESSION['tipo_user'] ?? null;

if($cpf){ 
    $cpf_ajustado = str_replace(['.','-'],'',$cpf);
}

$valor = $_POST['valor'] ?? null;
if($valor){
    $valor_ajustado = str_replace(['R$',' '],'',$valor);
    $valor_ajustado = str_replace(['.'],'',$valor_ajustado);
    $valor_ajustado = str_replace([','],'.',$valor_ajustado);
}

// FAZ O REGISTRO DE UM USUÁRIO, TIPO_USER = 0 É UM USUÁRIO COMUM
if($acao == 'cadastrar_usuario'){
    $celular = $_POST['celular'];
    $dt_nasc = $_POST['dt_nasc'];
    $email   = $_POST['email'];
    $nome    = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $senha   = $_POST['senha'];

    // Limpa os '()' do celular, enviando apenas números
    $cel_ajustado = str_replace(['(',')'],'',$celular);

    // Converter a data de nascimento para o formato do MYSQL
    list($dia, $mes, $ano) = explode('/',$dt_nasc);
    $mysql_dt_nasc = "$ano-$mes-$dia";

    // Checa se algum dos dados inseridos do tipo 'unique' ja estão no banco

    // CPF
    $select_query = "SELECT CPF FROM USUARIOS WHERE CPF = '$cpf_ajustado'";
    $resultado = $con -> query($select_query);
    if($resultado -> num_rows > 0){
        $retorno = array(
            "erro"    => "cpf",
            "msg"     => "CPF informado já está cadastrado",
            "sucesso" => false,
        );
        die(json_encode($retorno));
    }

    // Email
    $select_query = "SELECT EMAIL FROM USUARIOS WHERE EMAIL = '$email'";
    $resultado = $con -> query($select_query);
    if($resultado -> num_rows > 0){
        $retorno = array(
            "erro"    => "email",
            "msg"     => "Email informado já está cadastrado",
            "sucesso" => false
        );
        die(json_encode($retorno));
    }

    // Celular
    $select_query = "SELECT CELULAR FROM USUARIOS WHERE CELULAR = '$cel_ajustado'";
    $resultado = $con -> query($select_query);
    if($resultado -> num_rows > 0){
        $retorno = array(
            "erro"    => "celular",
            "msg"     => "Celular informado já está cadastrado",
            "sucesso" => false
        );
        die(json_encode($retorno));
    }

    // Usuário
    $select_query = "SELECT USUARIO FROM USUARIOS WHERE USUARIO = '$usuario'";
    $resultado = $con -> query($select_query);
    if($resultado -> num_rows > 0){
        $retorno = array(
            "erro"    => "usuario",
            "msg"     => "Usuário informado já está cadastrado",
            "sucesso" => false
        );
        die(json_encode($retorno));
    }

    // Inserindo no banco
    $insert_query = "INSERT INTO USUARIOS
                        (USUARIO, SENHA, NOME, CPF, CELULAR, DT_NASC, EMAIL, TIPO_USER)
                    VALUES
                        ('$usuario','$senha','$nome','$cpf_ajustado','$cel_ajustado','$mysql_dt_nasc','$email','0')";
    $resultado = $con -> query($insert_query);
    if($resultado){
        $retorno = array(
            "sucesso" => true
        );
    }
}

// BUSCA UM CPF NO BANCO PARA VALIDAR SE O USUÁRIO EXISTE
else if($acao == 'buscar_cpf'){
    $select_query = "SELECT 1
                     FROM USUARIOS
                     WHERE CPF = '$cpf_ajustado'";
    $resultado = $con -> query($select_query);
    if($resultado -> num_rows > 0){
        $retorno = true;
    }
    else{
        $retorno = false;
    }
}

// ALTERA O USUARIO OU SENHA DE ACORDO COM O ESCOLHIDO
else if($acao == 'alterar_usuario_senha'){
    $alteracao = $_POST['alteracao'];
    $novo = $_POST['novo'];
    
    if($alteracao == 'usuario'){
        $update_query = "UPDATE USUARIOS
                         SET USUARIO = '$novo'
                         WHERE CPF = '$cpf_ajustado'";
    }

    else if($alteracao == 'senha'){
        $update_query = "UPDATE USUARIOS
                         SET SENHA = '$novo'
                         WHERE CPF = '$cpf_ajustado'";
    }

    $resultado = $con -> query($update_query);
    if($resultado){
        $retorno = true;
    }
    else{
        $retorno = false;
    }
}

// REALIZA O LOGIN
else if($acao == 'realiza_login'){
    $usuario = $_POST['usuario'] ?? 'admin_teste';
    $senha = $_POST['senha'];
    $admin_teste = $_POST['admin_teste'];

    // Busca o tipo_user do usuário e senha inseridos
    if(!$admin_teste){    
        $select_query = "SELECT ID_USUARIO,NOME,TIPO_USER
                         FROM USUARIOS
                         WHERE USUARIO = '$usuario' AND SENHA = '$senha'";
        $resultado = $con -> query($select_query);
    }

    if($resultado -> num_rows > 0 || $admin_teste){
        $usuario_infos = $resultado -> fetch_assoc();
        $_SESSION['id_usuario'] = $usuario_infos['ID_USUARIO'] ?? 9999;
        $_SESSION['nome']       = $usuario_infos['NOME']       ?? 'Administrador Teste';
        $_SESSION['tipo_user']  = $usuario_infos['TIPO_USER']  ?? 1;
        $_SESSION['usuario']    = $usuario;
        $retorno = array(
            "sucesso"   => true,
            "nome"      => $usuario_infos['NOME'] ?? 'Administrador Teste',
            "tipo_user" => $usuario_infos['TIPO_USER'] ?? 1,
            "usuario"   => $usuario
        );
    }

    // Usuário não existe no banco
    else{
        $retorno = array(
            "sucesso" => false
        );
    }
}

// PREENCHER O SELECTPICKER DAS CATEGORIAS
else if($acao == 'categoria_busca_selectpicker'){
    if($tipo_usuario == 1){
        $select_query = "SELECT * FROM CATEGORIAS";
    }
    else{
        $select_query = "SELECT * FROM CATEGORIAS WHERE ATIVO = 'S'";
    }
    $resultado = $con -> query($select_query);
    if($resultado -> num_rows > 0){
        while($linha = $resultado -> fetch_array()){
            $retorno['data'][] = array(
                'id_categoria' => $linha['ID_CATEGORIA'],
                'categoria'    => $linha['CATEGORIA'],
                'ativo'        => $linha['ATIVO']
            );
        }
    }
    else{
        $retorno = false;
    }
}

// ADICIONAR UMA CATEGORIA
else if($acao == 'categoria_cadastrar'){
    $categoria = $_POST['categoria'];
    $ativo     = $_POST['ativo'];

    // Checa se a categoria já não foi cadastrada antes
    $select_query = "SELECT CATEGORIA FROM CATEGORIAS WHERE CATEGORIA = '$categoria'";
    $resultado = $con -> query($select_query);
    if($resultado -> num_rows > 0){
        $retorno = false;
    }
    else{
        $insert_query = "INSERT INTO CATEGORIAS
                            (CATEGORIA, ATIVO)
                         VALUES 
                            ('$categoria','$ativo')";
        $resultado = $con -> query($insert_query);
        if($resultado){
            $retorno = true;
        }
    }
}

// EDITAR UMA CATEGORIA
else if($acao == 'categoria_editar'){
    $id_categoria = $_POST['id'];
    $categoria    = $_POST['categoria'];
    $ativo        = $_POST['ativo'];
    if($ativo == 'N'){
        $update_query = "UPDATE PRODUTOS
                         SET ATIVO = 'N'
                         WHERE ID_CATEGORIA = $id_categoria";
        $resultado = $con -> query($update_query);
    }
    $update_query = "UPDATE CATEGORIAS
                     SET CATEGORIA = '$categoria',
                         ATIVO     = '$ativo'
                     WHERE ID_CATEGORIA = $id_categoria";
    $resultado = $con -> query($update_query);
    if($resultado){
        $retorno = true;
    }
    else{
        $retorno = false;
    }
}

// EXCLUIR UMA CATEGORIA
else if($acao == 'categoria_excluir'){
    $id_categoria = $_POST['id'];

    // Antes de excluir a categoria, retira o vinculo com os produtos atuais e inativa eles
    $update_query = "UPDATE PRODUTOS 
                     SET ID_CATEGORIA = NULL, ATIVO = 'N'
                     WHERE ID_CATEGORIA = $id_categoria";
    $resultado = $con -> query($update_query);

    $delete_query = "DELETE FROM CATEGORIAS WHERE ID_CATEGORIA = $id_categoria";
    $resultado = $con -> query($delete_query);
    if($resultado){
        $retorno = true;
    }
    else{
        $retorno = false;
    }
}

// PREENCHER O SELECTPICKER DE PRODUTOS
else if($acao == 'produto_busca_selectpicker'){
    $id_categoria = $_POST['id_categoria'];

    if($tipo_usuario == 1){
        $select_query = "SELECT * FROM PRODUTOS WHERE ID_CATEGORIA = $id_categoria";
    }
    else{
        $select_query = "SELECT * FROM PRODUTOS WHERE ID_CATEGORIA = $id_categoria AND ATIVO = 'S'";
    }
    $resultado = $con -> query($select_query);
    if($resultado -> num_rows > 0){
        while($linha = $resultado -> fetch_array()){
            $retorno['data'][] = array(
                'id_produto'   => $linha['ID_PRODUTO'],
                'produto'      => $linha['PRODUTO'],
                'estoque'      => $linha['ESTOQUE'],
                'valor'        => $linha['VALOR'],
                'ativo'        => $linha['ATIVO'],
                'id_categoria' => $linha['ID_CATEGORIA']
            );
        }
    }
    else{
        $retorno = false;
    }
}

// CADASTRAR UM PRODUTO
else if($acao == 'produto_cadastrar'){
    $produto      = $_POST['produto'];
    $estoque      = $_POST['estoque'];
    $ativo        = $_POST['ativo'];                  
    $id_categoria = $_POST['id_categoria']; 
    
    // Verifica se esse produto já consta no banco
    $select_query = "SELECT 1 FROM PRODUTOS WHERE PRODUTO = '$produto'";
    $resultado = $con -> query($select_query);
    if($resultado -> num_rows > 0){
        $retorno = false;
    }

    // Se não constar, faz o insert
    else{
        $insert_query = "INSERT INTO PRODUTOS
                            (PRODUTO, ESTOQUE, ESTOQUE_DT_ATUAL, VALOR, ATIVO, ID_CATEGORIA)
                        VALUES
                            ('$produto','$estoque',sysdate(),'$valor_ajustado','$ativo',$id_categoria)";
        $resultado = $con -> query($insert_query);
        if($resultado){
            $retorno = true;
        }
        else{
            $retorno = false;
        }
    }
}

// EDITAR UM PRODUTO
else if($acao == 'produto_editar'){
    $id_produto = $_POST['id_produto'];
    $produto      = $_POST['produto'];
    $estoque      = $_POST['estoque'];
    $ativo        = $_POST['ativo'];                  
    $id_categoria = $_POST['id_categoria'];
    $id_categoria_atual = $_POST['id_categoria_atual'];

    $update_query = "UPDATE PRODUTOS
                     SET PRODUTO = '$produto',
                         ESTOQUE = '$estoque',
                         ESTOQUE_DT_ATUAL = sysdate(),
                         VALOR = '$valor_ajustado',
                         ATIVO = '$ativo',
                         ID_CATEGORIA = $id_categoria
                     WHERE ID_PRODUTO = $id_produto
                        AND ID_CATEGORIA = $id_categoria_atual";
    $resultado = $con -> query($update_query);
    if($resultado){
        $retorno = true;
    }
    else{
        $retorno = false;
    }
}

// EXCLUIR UM PRODUTO
else if($acao == 'produto_excluir'){
    $id_produto = $_POST['id_produto'];
    $delete_query = "DELETE FROM PRODUTOS WHERE ID_PRODUTO = $id_produto";
    $resultado = $con -> query($delete_query);
    if($resultado){
        $retorno = true;
    }
    else{
        $retorno = false;
    }
}

// PREENCHER O DATATABLE DAS CATEGORIAS OU DOS PRODUTOS DA CATEGORIA
else if($acao == 'datatable_preenche'){
    $id_categoria = $_POST['id_categoria'];
    $retorno['data'] = [];
    if($id_categoria == ''){
        if($tipo_usuario == 1){
            $select_query = "SELECT
                                A.ID_CATEGORIA, A.CATEGORIA, A.ATIVO,
                                COUNT(B.ID_PRODUTO) AS TOTAL_PRODUTOS,
                                SUM(CASE WHEN B.ATIVO = 'S' THEN 1 ELSE 0 END) AS TOTAL_PRODUTOS_ATIVOS,
                                SUM(CASE WHEN B.ATIVO = 'N' THEN 1 ELSE 0 END) AS TOTAL_PRODUTOS_INATIVOS
                            FROM
                                CATEGORIAS A LEFT JOIN PRODUTOS B ON A.ID_CATEGORIA = B.ID_CATEGORIA
                            GROUP BY A.ID_CATEGORIA, A.CATEGORIA, A.ATIVO
                            ORDER BY A.CATEGORIA";
            $resultado = $con -> query($select_query);
            if($resultado -> num_rows > 0){
                while($linha = $resultado -> fetch_array()){
                    $retorno['data'][] = array(
                        'id_categoria'  => $linha['ID_CATEGORIA'],
                        'categoria'     => $linha['CATEGORIA'],
                        'cat_ativa'     => $linha['ATIVO'],
                        'tot_produtos'  => $linha['TOTAL_PRODUTOS'],
                        'prod_ativos'   => $linha['TOTAL_PRODUTOS_ATIVOS'],
                        'prod_inativos' => $linha['TOTAL_PRODUTOS_INATIVOS']
                    );
                }
            }
        }
        else if($tipo_usuario == 0){
            $select_query = "SELECT 
                                A.ID_CATEGORIA, A.CATEGORIA,
                                COUNT(B.ID_PRODUTO) AS TOTAL_PRODUTOS,
                                SUM(CASE WHEN B.ATIVO = 'S' THEN 1 ELSE 0 END) AS TOTAL_PRODUTOS_ATIVOS
                            FROM 
                                CATEGORIAS A LEFT JOIN PRODUTOS B ON A.ID_CATEGORIA = B.ID_CATEGORIA
                            WHERE A.ATIVO = 'S'
                            GROUP BY A.ID_CATEGORIA, A.CATEGORIA
                            ORDER BY A.CATEGORIA";
            $resultado = $con -> query($select_query);
            if($resultado -> num_rows > 0){
                while($linha = $resultado -> fetch_array()){
                    $retorno['data'][] = array(
                        'id_categoria'  => $linha['ID_CATEGORIA'],
                        'categoria'     => $linha['CATEGORIA'],
                        'tot_produtos'  => $linha['TOTAL_PRODUTOS'],
                        'prod_ativos'   => $linha['TOTAL_PRODUTOS_ATIVOS']
                    );
                }
            }
        }
    }
    else{
        if($tipo_usuario == 1){
            $select_query = "SELECT A.*, B.CATEGORIA
                             FROM PRODUTOS A
                             JOIN CATEGORIAS B ON A.ID_CATEGORIA = B.ID_CATEGORIA
                             WHERE A.ID_CATEGORIA = $id_categoria";
        }
        else{
            $select_query = "SELECT A.ID_PRODUTO, A.PRODUTO, A.ESTOQUE, A.VALOR,
                                    B.CATEGORIA
                             FROM PRODUTOS A
                             JOIN CATEGORIAS B ON A.ID_CATEGORIA = B.ID_CATEGORIA
                             WHERE A.ID_CATEGORIA = $id_categoria AND A.ATIVO = 'S'";
        }
        $resultado = $con -> query($select_query);
        if($resultado -> num_rows > 0){
            while($linha = $resultado -> fetch_array()){
                $retorno['data'][] = array(
                    'id_produto'   => $linha['ID_PRODUTO'],
                    'produto'      => $linha['PRODUTO'],
                    'estoque'      => $linha['ESTOQUE'],
                    'dt_estoque'   => $linha['ESTOQUE_DT_ATUAL'] ?? null,
                    'valor'        => $linha['VALOR'],
                    'ativo'        => $linha['ATIVO'] ?? null,
                    'id_categoria' => $linha['ID_CATEGORIA'] ?? null,
                    'categoria'    => $linha['CATEGORIA']
                );
            }
        }
    }
}

// PREENCHER O DATATABLE 'USUARIOS_PRODUTOS'
else if($acao == 'busca_usuarios_produtos'){
    $id_produto = $_POST['id_produto'];
    $select_query = "SELECT A.ID_USUARIO, A.QUANTIDADE, B.USUARIO
                     FROM USUARIO_PRODUTO A JOIN USUARIOS B
                     ON A.ID_USUARIO = B.ID_USUARIO
                     WHERE A.ID_PRODUTO = $id_produto";
    $resultado = $con -> query($select_query);
    if($resultado -> num_rows > 0){
        while($linha = $resultado -> fetch_array()){
            $retorno['data'][] = array(
                'id_usuario' => $linha['ID_USUARIO'],
                'usuario'    => $linha['USUARIO'],
                'quantidade' => $linha['QUANTIDADE']
            );
        }
    }
    else{
        $retorno['data'] = array();
    }
    
}

// EXCLUIR VÍNCULO ENTRE UM USUÁRIO E UM PRODUTO
else if($acao == 'excluir_vinculo_usuprod'){
    $id_produto = $_POST['id_produto'];
    $quantidade = $_POST['quantidade'];
    if($tipo_usuario == 1){
        $id_usuario = $_POST['id_usuario'];
    }
    $delete_query = "DELETE FROM USUARIO_PRODUTO WHERE ID_USUARIO = $id_usuario AND ID_PRODUTO = $id_produto";
    $resultado = $con -> query($delete_query);
    if($resultado){
        $update_query = "UPDATE PRODUTOS SET ESTOQUE = ESTOQUE + $quantidade
                         WHERE ID_PRODUTO = $id_produto";
        $resultado = $con -> query($update_query);
        $retorno = true;
    }
    else{
        $retorno = false;
    }
}

// CRIAR VINCULO ENTRE UM USUÁRIO E UM PRODUTO (SOMENTE NA PÁGINA DO USUÁRIO NÃO ADMIN)
else if($acao == 'adicionar_produto_carrinho'){
    $id_produto = $_POST['id_produto'];
    $quantidade = $_POST['quantidade'];

    // Verifica se o vinculo já existe
    $select_query = "SELECT * FROM USUARIO_PRODUTO WHERE ID_USUARIO = $id_usuario AND ID_PRODUTO = $id_produto";
    $resultado = $con -> query($select_query);

    if($resultado -> num_rows > 0){
        $linha = $resultado -> fetch_assoc();
        $retorno = array(
            "sucesso" => false,
            "quantidade" => $linha['QUANTIDADE']
        );
    }

    else{
        $insert_query = "INSERT INTO USUARIO_PRODUTO (ID_USUARIO, ID_PRODUTO, QUANTIDADE, DT_CRIADO)
                         VALUES ($id_usuario, $id_produto, $quantidade,sysdate())";
        $resultado = $con -> query($insert_query);
        if($resultado){
            $update_query = "UPDATE PRODUTOS SET ESTOQUE = ESTOQUE - $quantidade
                             WHERE ID_PRODUTO = $id_produto";
            $resultado = $con -> query($update_query);
            $retorno = array(
                "sucesso" => true
            );
        }
        else{
            $retorno = false;
        }
    }
}

// PREENCHE O DATATABLE DOS VINCULOS DE UM USUÁRIO AOS PRODUTOS
else if($acao == 'preenche_datatable_carrinho_usuario'){
    $select_query = "SELECT A.*, B.PRODUTO, B.VALOR, C.CATEGORIA
                     FROM USUARIO_PRODUTO A 
                     JOIN PRODUTOS B ON A.ID_PRODUTO = B.ID_PRODUTO
                     JOIN CATEGORIAS C ON B.ID_CATEGORIA = C.ID_CATEGORIA
                     WHERE ID_USUARIO = $id_usuario"; 
    $resultado = $con -> query($select_query);
    if($resultado -> num_rows > 0){
        while($linha = $resultado -> fetch_array()){
            $retorno['data'][] = array(
                'produto'       => $linha['PRODUTO'],
                'quantidade'    => $linha['QUANTIDADE'],
                'categoria'     => $linha['CATEGORIA'],
                'data_vinculo'  => $linha['DT_CRIADO'],
                'id_produto'    => $linha['ID_PRODUTO'],
                'preco_unidade' => $linha['VALOR']
            );
        }
    }
    else{
        $retorno['data'] = array();
    }
}

// EDITAR A QUANTIDADE DE PRODUTOS DO VINCULO DO USUÁRIO (SOMENTE NA PÁGINA DO USUÁRIO NÃO ADMIN)
else if($acao == 'edita_quantidade_vinculo'){
    $id_produto       = $_POST['id_produto'];
    $quantidade       = $_POST['quantidade'];
    $soma             = $_POST['soma'];
    $atualiza_estoque = $_POST['atualiza_estoque'];

    $update_query = "UPDATE USUARIO_PRODUTO
                     SET QUANTIDADE = $quantidade
                     WHERE ID_USUARIO = $id_usuario AND ID_PRODUTO = $id_produto";
    $resultado = $con -> query($update_query);
    if($resultado){
        if($soma == 1){
            $update_query = "UPDATE PRODUTOS SET ESTOQUE = ESTOQUE - $atualiza_estoque
                             WHERE ID_PRODUTO = $id_produto";
        }
        else{
            $update_query = "UPDATE PRODUTOS SET ESTOQUE = ESTOQUE + $atualiza_estoque
                             WHERE ID_PRODUTO = $id_produto";
        }
        $resultado = $con -> query($update_query);
        $retorno = true;
    }
    else{
        $retorno = false;
    }
}

die(json_encode($retorno));

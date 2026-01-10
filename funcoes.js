// FUNÇÃO QUE LIMPA TODOS OS CAMPOS DA DIV DEPOIS QUE ELA É ESCONDIDA
function div_limpa_campos(div_id,limpar='true'){
    var div = $('#' + div_id);
    
    if(limpar){
        div.find('input[type!="checkbox"][type!="radio"], select, textarea').val('');
    }
    div.find('.borda_cadastro_danger').removeClass('borda_cadastro_danger');
    div.hide();
}

// FUNÇÃO QUE VALIDA CAMPOS DO FORMULÁRIO DE CADASTRO
function cadastro_valida_campo_input(div_id){
    var validado = true;

    $('#' + div_id + ' input[type="text"]:visible, #' + div_id + ' input[type="password"]:visible').each(function(){
        if($(this).val() == ''){
            validado = false;
            $(this).addClass('borda_cadastro_danger');
        }
        else{
            $(this).removeClass('borda_cadastro_danger');
        }
    });

    return validado;
}

// FUNÇÃO QUE VALIDA A DATA DE NASCIMENTO REGISTRADA
function cadastro_valida_data_nascimento(dt_nascimento){
    var data_valida = true;
    var data_dividida = dt_nascimento.split('/');
    var dia = parseInt(data_dividida[0],10);
    var mes = parseInt(data_dividida[1],10);
    var ano = parseInt(data_dividida[2],10);
    var ano_atual = new Date().getFullYear();
    if(dia < 1 || dia > 31){
        data_valida = false;
    }
    if(mes < 1 || mes > 12){
        data_valida = false;
    }
    if(ano < 1900 || ano > ano_atual){
        data_valida = false;
    }
    return data_valida;
}

// FUNÇÃO QUE FAZ UMA CONTAGEM REGRESSIVA PARA REDIRECIONAR O USUÁRIO PARA PAGINA INICIAL APÓS O CADASTRO
function redireciona_pagina_inicial(url_pagina){
    var segundos = 5;
    $('#label_cadastro_redireciona').text("Redirecionando em "+segundos);
    
    var intervalo = setInterval(function(){
        segundos --;
         $('#label_cadastro_redireciona').text("Redirecionando em "+segundos);

         if(segundos <= 0){
            clearInterval(intervalo);
            window.location.href = url_pagina;
         }
    },1000);
}

// FUNÇÃO QUE SAI DA CONTA ATUAL
function conta_deslogar(url_pagina){
    var segundos = 3;
    var intervalo = setInterval(function(){
        segundos --;
        if(segundos == 0){
            clearInterval(intervalo);
            window.location.href = url_pagina;
        }
    })
}

// FUNÇÃO QUE CARREGA E PREENCHE O SELECTPICKER DAS CATEGORIAS OU PRODUTOS
/*function carrega_selectpicker(id_selectpicker,tipo,evento='',id_categoria=''){
    var select = $(id_selectpicker);
    var acao;
    var titulo;
    if(tipo == 'categoria'){
        acao = 'categoria_busca_selectpicker';
        titulo = 'CATEGORIAS';
    }
    if(tipo == 'produto'){
        acao = 'produto_busca_selectpicker';
        titulo = 'PRODUTOS';
        if(id_categoria == ''){
            select.empty();
            select.selectpicker('refresh');
            return false;
        }
    }
    $.ajax({
        url: 'ajax.php',
        type: 'post',
        dataType: 'json',
        data: {
            acao: acao,
            id_categoria: id_categoria
        },
        success: function(resultado){
            if(!resultado){
                select.empty();
                select.selectpicker('refresh');
                $('#select_categorias').selectpicker('val','').selectpicker('refresh');
                return false;
            }
            select.empty();
            //select.attr('title', titulo);
            select.append('<option value="" data-content="' + titulo + '">' + titulo + '</option>');
            if(tipo == 'categoria'){
                $.each(resultado.data,function(index,valor){
                    var cor = (valor.ativo == 'N') ? 'color: #999;' : ''; 
                    select.append($('<option>',{
                        value: valor.id_categoria,
                        'data-content': '<span style="'+cor+'">'+valor.categoria+'</span>',
                        'data-nome': valor.categoria,
                        'data-ativo': valor.ativo
                    }));
                });
            }
            if(tipo == 'produto'){
                $.each(resultado.data,function(index,valor){
                    var cor = (valor.ativo == 'N') ? 'color: #999;' : ''; 
                    select.append($('<option>',{
                        value: valor.id_produto,
                        'data-content': '<span style="'+cor+'">'+valor.produto+'</span>',
                        'data-nome': valor.produto,
                        'data-ativo': valor.ativo,
                        'data-estoque': valor.estoque,
                        'data-valor': valor.valor,
                        'data-id_categoria': valor.id_categoria
                    }));
                });
            
                if(evento == 'produto_editar' || evento == 'produto_excluir'){
                    if(id_categoria){
                        select.selectpicker('val',id_categoria);
                    }
                    else{
                        select.selectpicker('val','');
                    }
                }
            }
            select.selectpicker('refresh');
        }
    });
}*/

function carrega_selectpicker(id_selectpicker,tipo,evento='',id_categoria=''){
    var select = $(id_selectpicker);
    var acao;
    var titulo;
    if(tipo == 'categoria'){
        acao = 'categoria_busca_selectpicker';
        titulo = 'CATEGORIAS';
    }
    if(tipo == 'produto'){
        acao = 'produto_busca_selectpicker';
        titulo = 'PRODUTOS';
        if(id_categoria == ''){
            select.empty();
            $('#select_categorias').selectpicker('val','').selectpicker('refresh');
            $('#select_produtos').selectpicker('val','').selectpicker('refresh');
            console.log('Vai retornar');
            return false;
        }
    }
    $.ajax({
        url: 'ajax.php',
        type: 'post',
        dataType: 'json',
        data: {
            acao: acao,
            id_categoria: id_categoria
        },
        success: function(resultado){
            if(!resultado){
                select.empty();
                //select.append('<option value="" data-content="' + titulo + '">' + titulo + '</option>');
                select.selectpicker('refresh');
                $('#select_categorias').selectpicker('val',id_categoria).selectpicker('refresh');
                return false;
            }
            select.empty();
            //select.append($('<option>',{ value: '', 'data-content': titulo }));
            select.append('<option value="" data-content="' + titulo + '">' + titulo + '</option>');
            if(tipo == 'categoria'){
                $.each(resultado.data,function(index,valor){
                    var cor = (valor.ativo == 'N') ? 'color: #999;' : ''; 
                    select.append($('<option>',{
                        value: valor.id_categoria,
                        'data-content': '<span style="'+cor+'">'+valor.categoria+'</span>',
                        'data-nome': valor.categoria,
                        'data-ativo': valor.ativo
                    }));
                });
            }
            if(tipo == 'produto'){
                $.each(resultado.data,function(index,valor){
                    var cor = (valor.ativo == 'N' || valor.estoque == 0) ? 'color: #999;' : ''; 
                    select.append($('<option>',{
                        value: valor.id_produto,
                        'data-content': '<span style="'+cor+'">'+valor.produto+'</span>',
                        'data-nome': valor.produto,
                        'data-ativo': valor.ativo,
                        'data-estoque': valor.estoque,
                        'data-valor': valor.valor,
                        'data-id_categoria': valor.id_categoria
                    }));
                });
            }
            select.selectpicker('refresh');
            if(evento == 'produto_editar' || evento == 'produto_excluir'){
                if(id_categoria){
                    select.selectpicker('val',id_categoria).selectpicker('refresh');
                }
                else{
                    select.selectpicker('val','').selectpicker('refresh');
                }
            }
            if(id_categoria != ''){
                $('#select_categorias').selectpicker('val',id_categoria).selectpicker('refresh');
            }
            else{
                $('#select_categorias').selectpicker('val','').selectpicker('refresh');
            }
        }
    });
}
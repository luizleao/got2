$(document).ready(function(){
    var dadosBranco = {
        host:  "",
        login: "",
        senha: ""
    };
    
    var dadosMysql = {
        host: "localhost",
        login: "root",
        senha: "root"
    };
    
    var dadosSqlServer = {
        host:  "172.16.107.88",
        login: "sa",
        senha: "cgti*2013"
    };
    
    var classe = $(".active > span").html();
    var tempoTimeout = 50000;
    
    $('#btnGerar').addClass("disabled");
    
    
    /**
     * Funcao selecionar SGBD
     * 
     * 
     */
    
    $("#sgbd").change(function (){
        //alert($("#sgbd").val());
        switch($("#sgbd").val()){
            case "mysql": 
                objFormTemp = dadosMysql;
            break;
            
            case "sqlserver": 
                objFormTemp = dadosSqlServer;
            break;
            
            default: 
                objFormTemp = dadosBranco;
            break;
        }
        
        $("#host").val(objFormTemp.host);
        $("#login").val(objFormTemp.login);
        $("#senha").val(objFormTemp.senha);
    });
    
    /**
     * Funcao Conectar BD
     * 
     */
    $("#btnConectar").click(function(){
        if($("#sgbd").val() === ''){
            $('#btnConectar').button('reset');
            $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_alert.png" /> Selecione o SGBD');
            $('#modalResposta').modal('show');
            $('#modalResposta').on('hide.bs.modal', function () {
                $("#sgbd").focus();
            });
        }
        else if($("#login").val() === ''){
            $('#btnConectar').button('reset');
            $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_alert.png" /> Digite o login');
            $('#modalResposta').modal('show');
            $('#modalResposta').on('hide.bs.modal', function () {
                $("#login").focus();
            });
            
        } else {
            $.ajax({
                type      : "post",
                url       : "conectar.php",
                data      : retornaParametros(document.forms[0]),
                dataType  : "json",
                beforeSend: function(){
                    $('#btnConectar').button('loading');
                },
                timeout   : tempoTimeout,
                success   : function(json){
                   /*
                     $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<pre> '+json +'</pre>');
                     $('#modalResposta').modal('show');
                     */
                    if(json.toString() === ''){
                        $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_error.png" /> Nenhum Database encontrado');
                        $('#modalResposta').modal('show');
                        $('#btnConectar').button('reset');
                    } else {
                        //alert(json);
                        $('#btnConectar').button('reset');
                        $("#database").empty();
                        $.each(json, function(chave, valor){
                            $("#database").append(new Option(valor, valor, true, true));
                        });
                        $('#btnGerar').removeClass("disabled");
                    }
                },
                error    : function(retorno){
                    $('#btnConectar').button('reset');
                    $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                    $('#modalResposta').modal('show');
                }
            });
            $('#modalResposta').on('shown.bs.modal', function (){
                $('#modalResposta > .modal-footer > #btnFechar').focus();
            });
        }
    });

    /**
     * 
     * Funcao Gerar XML
     * 
     * @author luizleao
     */
    $("#btnGerar").click(function () {
        $.ajax({
            url       : 'index.php?acao=xml',
            type      : 'post',
            data      : retornaParametros(document.forms[0]),
            dataType  : 'html',
            beforeSend: function(){
                $('#btnGerar').button('loading');
            },
            timeout   : tempoTimeout,
            success   : function(retorno){
                //print_r(document.forms[0]);
                $('#btnGerar').button('reset');

                if(retorno !== '')
                    $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                else
                    $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_success.png" /> XML gerado com sucesso');
                $('#modalResposta').modal('show');
                $('#modalResposta').on('hide.bs.modal', function (){
                    window.location = './';
                });
            },
            error    : function(retorno){
                $('#btnGerar').button('reset');
                $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown.bs.modal', function (){
            $('#modalResposta > .modal-footer > #btnFechar').focus();
        });
    });
    
    /**
     * 
     * Funcao Gerar Artefatos
     * 
     * @author luizleao
     */
    $("ul.dropdown-menu > li > a#btnGerarArtefatos").click(function () {
         $.ajax({
            url       : 'index.php?acao=gerar',
            type      : 'post',
            data      : 'xml='+$(this).attr("data-xml"),
            dataType  : 'html',
            beforeSend: function(){
                //this.button('loading');
            },
            timeout   : tempoTimeout,
            success   : function(retorno){
                
                //print_r(document.forms[0]);
                //this.button('reset');

                $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_info.png" /> <br /> '+retorno);
                $('#modalResposta').modal('show');
                $('#modalResposta').on('hide.bs.modal', function (){
                    window.location = './';
                });
            },
            error    : function(retorno){
                $('#btnGerar').button('reset');
                $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown.bs.modal', function (){
            $('#modalResposta > .modal-footer > #btnFechar').focus();
        });
    });
    
    /**
     * 
     * Funcao Excluir XML
     * 
     * @author luizleao
     */
    $("ul.dropdown-menu > li > a#btnExcluirXML").click(function () {
         $.ajax({
            url       : 'index.php?acao=excluirXML',
            type      : 'post',
            data      : 'xml='+$(this).attr("data-xml"),
            dataType  : 'html',
            beforeSend: function(){
                //$('#btnGerarArtefatos').button('loading');
            },
            timeout   : tempoTimeout,
            success   : function(retorno){
                //print_r(document.forms[0]);
                $('#btnGerarArtefatos').button('reset');

                $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_success.png" /> XML excluido com sucesso');
                $('#modalResposta').modal('show');
                $('#modalResposta').on('hide.bs.modal', function (){
                    window.location = './';
                });
            },
            error    : function(retorno){
                $('#btnGerar').button('reset');
                $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_error.png" /> <br />'+retorno);
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown.bs.modal', function (){
            $('#modalResposta > .modal-footer > #btnFechar').focus();
        });
    });
    
    /**
     * 
     * Funcao Cadastrar
     * 
     * @author luizleao
     */
    $("#btnCadastrar").click(function () {
        $.ajax({
            url       : 'cad'+classe+'.php',
            type      : 'post',
            data      : retornaParametros(document.forms[0]),
            dataType  : 'html',
            beforeSend: function(){
                $('#btnCadastrar').button('loading');
            },
            timeout   : tempoTimeout,
            success   : function(retorno){
                $('#btnCadastrar').button('reset');

                if(retorno !== '')
                    $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                else
                    $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_success.png" /> Cadastrado com sucesso');
                $('#modalResposta').modal('show');
            },
            error    : function(retorno){
                $('#btnCadastrar').button('reset');
                $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown.bs.modal', function (){
            $('#modalResposta > .modal-footer > #btnFechar').focus();
        });
    });

    /**
     * 
     * Funcao Editar
     * @author luizleao
     */
    $("#btnEditar").click(function () {
        $.ajax({
            url 	: 'edit'+classe+'.php',
            type 	: 'post',
            data 	: retornaParametros(document.forms[0]),
            dataType    : 'html',
            beforeSend  : function(){
                $('#btnEditar').button('loading');
            },
            timeout     : tempoTimeout,
            success     : function(retorno){
                $('#btnEditar').button('reset');

                if(retorno !== '')
                    $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                else
                    $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_success.png" /> Editado com sucesso');
                $('#modalResposta').modal('show');
            },
            error       : function(){
                $('#btnEditar').button('reset');
                $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('Erro!!');
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown.bs.modal', function (){
            $('#modalResposta > .modal-footer > #btnFechar').focus();
        });
    });


    /**
     * 
     * Função Logar
     * @author luizleao
     */
    $('#btnLogar').click(function(){
        dados = retornaParametros(document.forms[0]);
        $.ajax({
            url       : 'resIndex.php',
            type      : 'post',
            data      : dados,
            dataType  : 'html',
            beforeSend: function(){
                $('#btnLogar').button('loading');
            },
            timeout   : tempoTimeout,
            success   : function(retorno){
                $('#btnLogar').button('reset');

                if(retorno !== ''){
                    $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                    $('#modalResposta').modal('show');
                } else{
                    window.location = 'principal.php';
                }
            },
            error     : function(retorno){
                $('#btnLogar').button('reset');
                $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_error.png" /> Erro: '+retorno);
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown.bs.modal', function (){
            $('#modalResposta > .modal-footer > #btnFechar').focus();
        });
    });
	
    /**
     * 
     * Cadastrar programas ao grupo selecionado
     * @author luizleao
     */
    $('#btnCadastroPrograma').click(function (){
        dados = retornaParametros(document.forms[0]);
        $.ajax({
            url       : 'cadGrupoPrograma.php',
            type      : 'post',
            data      : dados,
            dataType  : 'html',
            beforeSend: function(){
                $('#btnCadastroPrograma').button('loading');
            },
            timeout   : tempoTimeout,
            success   : function(retorno){
                $('#btnCadastroPrograma').button('reset');

                if(retorno !== '')
                    $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                else
                    $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_success.png" />Cadastrado com sucesso');
                $('#modalResposta').modal('show');
            },
            error     : function(retorno){
                $('#btnCadastroPrograma').button('reset');
                $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_error.png" /> Erro: '+retorno);
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown.bs.modal', function (){
            $('#modalResposta > .modal-footer > #btnFechar').focus();
        });
    });
    
    /**
     * Mascaramento de campos
     * 
     */
    $('.valor').mask('000000000.00', {
        reverse: true
        });
    $('.data').mask('00:00:00');
    $('.datahora').mask('99/99/9999 00:00:00');
    $('.cep').mask('99999-999');
    $('.fone').mask('(99) 9999-9999'); 
    
});

function excluir(campo, valor){
    $('#modalExcluir').modal('show');
    $('#modalExcluir > .modal-body').html('Deseja excluir '+ classe +'?');

    $('#btnSim').click(function () {
        $.ajax({
            url        : 'adm'+classe+'.php?acao=excluir&'+campo+'='+valor,
            type       : 'get',
            beforeSend : function(){
                $('#btnCadastrar').button('loading');
            },
            timeout    : tempoTimeout,
            success    : function(retorno){
                $('#modalExcluir').modal('hide');
                if(retorno !== ''){
                    $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                    $('#modalResposta').modal('show');
                }
                else{
                    $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_success.png" /> Excluido com sucesso');
                    $('#modalResposta').modal('show');
                    $('#modalResposta').on('hide.bs.modal', function () {
                        window.location = 'adm'+classe+'.php';
                    });
                }
            },
            error      : function(retorno){
                $('#modalExcluir').modal('hide');
                $('#modalResposta > .modal-dialog > .modal-content > .modal-body').html('<img src="img/ico_error.png" /> ERRO: '+retorno);
                $('#modalResposta').modal('show');
            }
        });
    });
}
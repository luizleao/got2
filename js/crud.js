$(document).ready(function(){
    var dadosBranco    = {host:"", login:"", senha: ""};   
    var dadosMysql 	   = {host:"localhost", login:"root", senha:"root"};    
    var dadosSqlServer = {host:"172.16.107.88", login:"sa", senha:"cgti*2013"};    
    var dadosPostgre   = {host:"localhost", login:"postgres", senha:"postgres"};
    
    var classe       = $(".active > span").html();
    var tempoTimeout = 1000000;
    
    $('#btnGerar').addClass("disabled");
    
    /**
     * Funcao selecionar SGBD
     * 
     */
    $("#sgbd").change(function (){
        //alert($("#sgbd").val());
        switch($("#sgbd").val()){
            case "mysql":     objFormTemp = dadosMysql; break;
            case "sqlserver": objFormTemp = dadosSqlServer; break;
            case "postgre":   objFormTemp = dadosPostgre; break;            
            default:          objFormTemp = dadosBranco; break;
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
            $('#modalResposta').find('.modal-body').html('<img src="img/ico_alert.png" /> Selecione o SGBD');
            $('#modalResposta').modal('show');
            $('#modalResposta').on('hide.bs.modal', function () {
                $("#sgbd").focus();
            });
        }
        else if($("#login").val() === ''){
            $('#btnConectar').button('reset');
            $('#modalResposta').find('.modal-body').html('<img src="img/ico_alert.png" /> Digite o login');
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
                     $('#modalResposta').find('.modal-body').html('<pre> '+json +'</pre>');
                     $('#modalResposta').modal('show');
                     */
                    if(json.toString() === ''){
                        $('#modalResposta').find('.modal-body').html('<img src="img/ico_error.png" /> Nenhum Database encontrado');
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
                error: function (event, jqXHR, ajaxSettings){
                    $('#btnConectar').button('reset');
                    $('#modalResposta').find('.modal-body').html('<img src="img/ico_error.png" /> '+event +'-' +jqXHR +'-' +ajaxSettings);
                    $('#modalResposta').modal('show');
                }
            });
            $('#modalResposta').on('shown.bs.modal', function (){
                $('#modalResposta').find('#btnFechar').focus();
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
                    $('#modalResposta').find('.modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                else
                    $('#modalResposta').find('.modal-body').html('<img src="img/ico_success.png" /> XML gerado com sucesso');
                $('#modalResposta').modal('show');
                $('#modalResposta').on('hide.bs.modal', function (){
                    window.location = './';
                });
            },
            error: function (event, jqXHR, ajaxSettings){
                $('#btnGerar').button('reset');
                $('#modalResposta').find('.modal-body').html('<img src="img/ico_error.png" /> '+event +'-' +jqXHR +'-' +ajaxSettings);
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown.bs.modal', function (){
            $('#modalResposta').find('#btnFechar').focus();
        });
    });
    
    /**
     * 
     * Funcao Gerar Artefatos
     * 
     * @author luizleao
     */
    $("a#btnGerarArtefatos").click(function () {
    //$("ul.dropdown-menu > li > a#btnGerarArtefatos").click(function () {
         $.ajax({
            url       : 'index.php?acao=gerar',
            type      : 'post',
            data      : 'xml='+$(this).data("xml")+'&gui='+$(this).data("gui"),
            dataType  : 'html',
            beforeSend: function(){
                //this.button('loading');
            },
            timeout   : tempoTimeout,
            success   : function(retorno){
                
                //print_r(document.forms[0]);
                //this.button('reset');

                $('#modalResposta').find('.modal-body').html('<img src="img/ico_info.png" /> <br /> '+retorno);
                $('#modalResposta').modal('show');
                $('#modalResposta').on('hide.bs.modal', function (){
                    window.location = './';
                });
            },
            error    : function(retorno){
                $('#btnGerar').button('reset');
                $('#modalResposta').find('.modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown.bs.modal', function (){
            $('#modalResposta').find('#btnFechar').focus();
        });
    });
    
    /**
     * 
     * Funcao Excluir XML
     * 
     * @author luizleao
     */
    $("a#btnExcluirXML").click(function () {
    	
    //$("ul.dropdown-menu > li > a#btnExcluirXML").click(function () {
        /* 
    	$.ajax({
            url       : 'index.php?acao=excluirXML',
            type      : 'post',
            data      : 'xml='+$(this).data("xml"),
            dataType  : 'html',
            beforeSend: function(){
                //$('#btnGerarArtefatos').button('loading');
            },
            timeout   : tempoTimeout,
            success   : function(retorno){
                //print_r(document.forms[0]);
                $('#btnGerarArtefatos').button('reset');

                $('#modalResposta').find('.modal-body').html('<img src="img/ico_success.png" /> XML excluido com sucesso');
                $('#modalResposta').modal('show');
                $('#modalResposta').on('hide.bs.modal', function (){
                    window.location = './';
                });
            },
            error    : function(retorno){
                $('#btnGerar').button('reset');
                $('#modalResposta').find('.modal-body').html('<img src="img/ico_error.png" /> <br />'+retorno);
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown.bs.modal', function (){
            $('#modalResposta').find('#btnFechar').focus();
        });
        */
    	arquivoXml = $(this).data("xml");
    	$('#modalExcluir').modal('show');
        $('#modalExcluir').find('.modal-body').html('Deseja excluir o arquivo "'+$(this).data("xml")+'.xml"?');

        $('#btnSim').click(function () {
            $.ajax({
            	url       : 'index.php?acao=excluirXML',
                type      : 'post',
                data      : 'xml='+arquivoXml,
                dataType  : 'html',
                timeout    : tempoTimeout,
                beforeSend: function(){
                    //$('#btnGerarArtefatos').button('loading');
                },
                success    : function(retorno){
                	//alert(retorno);
                    $('#modalExcluir').modal('hide');
                    $('#modalResposta').find('.modal-body').html((retorno !== '' && retorno !== '1') ? '<img src="img/ico_error.png" /> '+retorno : '<img src="img/ico_success.png" /> XML excluido com sucesso');
                    $('#modalResposta').modal('show');
                    $('#modalResposta').on('hide.bs.modal', function () {
                    	window.location = './';
                    });
                },
                error	   : function(retorno){
                    $('#modalExcluir').modal('hide');
                    $('#modalResposta').find('.modal-body').html('<img src="img/ico_error.png" /> ERRO: '+retorno);
                    $('#modalResposta').modal('show');
                }
            });
        });
    });
});
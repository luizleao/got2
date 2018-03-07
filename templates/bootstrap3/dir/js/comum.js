/**
 * Simula a funcao print_r do PHP
 * 
 * @param form oForm
 * @returns void
 */
function print_r(oForm){
    params = new Array();
    j = 0;
    params[j++] = 'Array(\n';
    for(var i=0; i<oForm.elements.length; i++){
        // Verifica caracteres a serem codificados para serem encondados antes da gravaçao
        if(/[\+]/.test(oForm.elements[i].value)){
            valor = encodeURIComponent(escape(oForm.elements[i].value));
        }else{
            valor = escape(oForm.elements[i].value);
        }
        switch(oForm.elements[i].type){
            case "radio":
            case "checkbox":
                if(oForm.elements[i].checked) 
                    params[j++] = oForm.elements[i].name + '=' + valor+'\n';
            break;
            case "select-multiple":
                for(var z=0; z<oForm.elements[i].options.length; z++){
                    if(oForm.elements[i].options[z].selected) 
                        params[j++] = oForm.elements[i].name + '=' + escape(oForm.elements[i].options[z].value)+'\n';
                }
            break;
            /*
            case "text":
            case "hidden":
            case "password":
            case "textarea":
            case "select-one":
                params[j++] = oForm.elements[i].name + '=' + valor;
            break;
            */
            default:
                params[j++] = oForm.elements[i].name + '=' + valor+' xxx\n';
            break;
        }
    }
    params[j++] = ')';
    console.log(params.join(''));
    alert(params.join(''));
}

/**
 * Monta a lista de parametros a serem submetidos
 * 
 * @param form oForm
 * @returns string
 */
function retornaParametros(oForm){
    params = new Array();
    j = 0;
    for(var i=0; i<oForm.elements.length; i++){
        // Verifica caracteres a serem codificados para serem encondados antes da gravaçao
        if(/[\+]/.test(oForm.elements[i].value)){
            valor = encodeURIComponent(escape(oForm.elements[i].value));
        }else{
            valor = escape(oForm.elements[i].value);
        }
        switch(oForm.elements[i].type){
            case "text":
            case "hidden":
            case "password":
            case "textarea":
            case "select-one":
                params[j++] = oForm.elements[i].name + '=' + valor;
            break;
            case "radio":
            case "checkbox":
                if(oForm.elements[i].checked) 
                    params[j++] = oForm.elements[i].name + '=' + valor;
            break;
            case "select-multiple":
                for(var z=0; z<oForm.elements[i].options.length; z++){
                    if(oForm.elements[i].options[z].selected) 
                        params[j++] = oForm.elements[i].name + '=' + escape(oForm.elements[i].options[z].value);
                }
            break;
        }
    }
    return params.join('&');
}

function retornaObjeto(oForm){
    params = new Array();
    j = 0;
    for(var i=0; i<oForm.elements.length; i++){
        switch(oForm.elements[i].type){
            case "text":
            case "hidden":
            case "password":
            case "textarea":
            case "select-one":
                params[j++] = "'" + oForm.elements[i].name + "':'" + escape(oForm.elements[i].value) + "'";
            break;
            case "radio":
            case "checkbox":
                if(oForm.elements[i].checked) 
                    params[j++] = "'" + oForm.elements[i].name + "':'" + escape(oForm.elements[i].value) + "'";
            break;
            case "select-multiple":
                for(var z=0; z<oForm.elements[i].options.length; z++){
                    if(oForm.elements[i].options[z].selected) 
                        params[j++] = "'" + oForm.elements[i].name + "':'" + escape(oForm.elements[i].options[z].value) + "'";
                }
            break;
        }
    }
    return "{"+params.join(', ')+"}";
}

/**
 * FUNCAO QUE VALIDA AS TECLAS PRESSIONADAS
 * 
 * @param handler event
 * @param string tipoCampo
 * @returns boolean
 */
function validaTecla(event, tipoCampo){
    var tecla;

    tecla       = (navigator.appName.indexOf("Netscape") != -1) ? event.which : event.keyCode;	
    codigoTecla = String.fromCharCode(tecla); 

    // ========== VERIFICANDO O TIPO DE CAMPO =========
    switch(tipoCampo){
        case 'numero':
            lista 	  = '0123456789';
            habilitar = true;
        break;

        case 'moeda':
            lista 	  = '0123456789.';
            habilitar = true;
        break;

        case 'nome':
            lista = "0123456789&@$#%.,!?*\\/-+_=[]{}|';()";
            habilitar = false;
        break;
    }
    // ============ VERIFICAR QUAL TECLA FOI PRESSIONADA ==========
    switch(tecla){
        case 0:  // TAB
        case 8:	 // BACKSPACE
        case 13: // ENTER
                return true;
        break;
    }

    // ============ HABILITAR/DESABILITAR LISTA DE CARACTERES ==========
    if(habilitar == true){
        if(lista.indexOf(codigoTecla) == -1)
            return false;
    }
    else{
        if(lista.indexOf(codigoTecla) != -1)
            return false;
    }
}

function selecionarTodos(obj){
    var marcado = true;
    var i;
    if(obj.length){
        // ======== Verifica se ha pelo menos um desmarcado ===========
        for(i=0; i<obj.length; i++){
            if(obj[i].disabled == false && obj[i].type == 'checkbox'){
                if(obj[i].checked == false){
                    marcado = false;
                }
            }
        }
        for(i=0; i<obj.length; i++){
            if(obj[i].disabled == false && obj[i].type == 'checkbox'){
                obj[i].checked = (marcado == false) ? true : false;
            }
        }
    }
    else{
        if(obj.disabled == false){
            obj.checked = (obj.checked) ? false : true;
        }
    }
}
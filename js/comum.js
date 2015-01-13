// ================== Funoes Loading =================
// ================== Abrir Pagina =================
function print_r(oForm){
    params = new Array();
    j = 0;
    params[j++] = 'Array(\n';
    for(var i=0; i<oForm.elements.length; i++){
        switch(oForm.elements[i].type){
            case "text":
            case "hidden":
            case "password":
            case "textarea":
            case "select-one":
                params[j++] = '\t['+ oForm.elements[i].name + '] => ' + escape(oForm.elements[i].value) + ',\n';
            break;
            case "radio":
            case "checkbox":
                if(oForm.elements[i].checked) 
                    params[j++] = '\t['+ oForm.elements[i].name + '] => ' + escape(oForm.elements[i].value) + ',\n';
            break;
            case "select-multiple":
                for(var z=0; z<oForm.elements[i].options.length; z++){
                    if(oForm.elements[i].options[z].selected) 
                        params[j++] = '\t['+ oForm.elements[i].name + '] => ' + escape(oForm.elements[i].options[z].value) + ',\n';
                }
            break;
        }
    }
    params[j++] = ')';
    alert(params.join(''));
}

function retornaParametros(oForm){
    params = new Array();
    j = 0;
    for(var i=0; i<oForm.elements.length; i++){
        switch(oForm.elements[i].type){
            case "text":
            case "hidden":
            case "password":
            case "textarea":
            case "select-one":
                params[j++] = oForm.elements[i].name + '=' + escape(oForm.elements[i].value);
            break;
            case "radio":
            case "checkbox":
                if(oForm.elements[i].checked) 
                    params[j++] = oForm.elements[i].name + '=' + escape(oForm.elements[i].value);
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

// ============== FUNCAO QUE VALIDA AS TECLAS PRESSIONADAS ========== 
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

// ================== FORMATAR HORA ====================
function formataHora(obj, teclapres){
    var tecla = teclapres.keyCode;

    valor = obj.value;
    valor = valor.replace('.', '');
    valor = valor.replace(':', '');
    valor = valor.replace(':', '');

    tam = obj.value.length + 1;
	
    if(tecla != 9 && tecla != 8){
        if(tam > 2 && tam < 5)
            obj.value = valor.substr(0, tam-1) + ':' + valor.substr(tam-1, tam);

        if(tam > 5 && tam <= 8)
            obj.value = valor.substr(0, 2) + ':' + valor.substr(2, 2) + ':' + valor.substr(4, 4);
    }
}

// ================== FORMATAR DATA ====================
function formataData(obj, teclapres){
    var tecla = teclapres.keyCode;

    valor = obj.value;
    valor = valor.replace('.', '');
    valor = valor.replace('/', '');
    valor = valor.replace('/', '');

    tam = obj.value.length + 1;

    if(tecla != 9 && tecla != 8){
        if(tam > 2 && tam < 5)
            obj.value = valor.substr(0, tam-1) + '/' + valor.substr(tam-1, tam);
        if(tam > 5 && tam <= 10)
            obj.value = valor.substr(0, 2) + '/' + valor.substr(2, 2) + '/' + valor.substr(4, 4);
    }
}
// ================== FORMATAR MOEDA ====================
function formataValor(campo, tammax, teclapres){
    var tecla = (teclapres.keyCode) ? teclapres.keyCode : teclapres.which;
    vr = campo.value;
    vr = vr.replace("/", "");
    vr = vr.replace("/", "");
    vr = vr.replace(",", "");
    vr = vr.replace(".", "");
    vr = vr.replace(".", "");
    vr = vr.replace(".", "");
    vr = vr.replace(".", "");	
    tam = vr.length;

    if(tam < tammax && tecla != 8){ 
        tam = vr.length + 1;
    }
    if(tecla == 8){	
        tam = tam-1 ; 
    }
    if((tecla == 8 || tecla >= 48) && (tecla <= 57 || tecla >= 96) && (tecla <= 105)){
        if(tam <= 2)
            campo.value = vr ; 
        if((tam > 2) && (tam <= 5))
            campo.value = vr.substr(0, tam-2) + ',' + vr.substr(tam-2, tam);
        if((tam >= 6) && (tam <= 8))
            campo.value = vr.substr(0, tam-5) + '.' + vr.substr(tam-5, 3) + ',' + vr.substr(tam-2, tam);
        if((tam >= 9) && (tam <= 11))
            campo.value = vr.substr(0, tam-8) + '.' + vr.substr(tam-8, 3) + '.' + vr.substr(tam-5, 3) + ',' + vr.substr(tam-2, tam);
        if((tam >= 12) && (tam <= 14))
            campo.value = vr.substr(0, tam-11) + '.' + vr.substr(tam-11, 3) + '.' + vr.substr(tam-8, 3) + '.' + vr.substr(tam-5, 3) + ',' + vr.substr(tam-2, tam);
        if((tam >= 15) && (tam <= 17))
            campo.value = vr.substr(0, tam-14) + '.' + vr.substr(tam-14, 3) + '.' + vr.substr(tam-11, 3) + '.' + vr.substr(tam-8, 3) + '.' + vr.substr(tam-5, 3) + ',' + vr.substr(tam-2, tam);
    }
}

function selecionarTodos(obj){
    var marcado = true;
    var i;
    if(obj.length){
        // ======== Verifica se ha pelo menos um desmarcado ===========
        for(i=0; i<obj.length; i++){
            if(obj[i].disabled == false && obj[i].type == 'checkbox')
                if(obj[i].checked == false)
                    marcado = false;
        }
        for(i=0; i<obj.length; i++){
            if(obj[i].disabled == false && obj[i].type == 'checkbox')
                obj[i].checked = (marcado == false) ? true : false;
        }
    }
    else{
        if(obj.disabled == false)
            obj.checked = (obj.checked) ? false : true;
    }
}
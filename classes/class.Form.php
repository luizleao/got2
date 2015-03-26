<?php
/**
 * Classe Form
 * 
 * Responsável pela construção dos formulários e relatórios da aplicação
 * 
 * @author Luiz Leão <luizleao@gmail.com>
 */
class Form {
    /**
     * Gera componentes input
     * 
     * @param string $obj Objeto a ser editado
     * @param string $campo Nome do atributo
     * @param string $label Rótulo do atributo
     * @param string $tipoTela Tipo de formulário: CAD - Cadastro, EDIT - Edição
     * @param string $tipoDado Tipo de dado do atributo
     * @param string $gui Tipo de GUI (Graphic User Interface)
     * @return string
     */
    static function geraInput($obj, $campo, $label, $tipoTela, $tipoDado, $gui) {
        switch ($tipoTela) {
            case 'CAD':
                $value = "";
                $valueRadioM = $valueRadioF = "";
            break;
            case 'EDIT':
                $value = "<?=$obj"."->$campo?>";
                $valueRadioM = "<?=($obj"."->$campo == 'M') ? \"Checked\" : \"\" ?>";
                $valueRadioF = "<?=($obj"."->$campo == 'F') ? \"Checked\" : \"\" ?>";
            break;
        }

        // Email
        if(preg_match("#e?[\-_]?mail#is", $campo)){
            $modelo = Util::getConteudoTemplate($gui.'/Modelo.Form.Email.tpl');
            
            $modelo = str_replace('%%CAMPO%%', $campo, $modelo);
            $modelo = str_replace('%%VALOR%%', $value, $modelo);
            
            $retorno = $modelo;
        
        // Analisado o Tipo de Dados
        // Moeda
        }elseif (preg_match("#(?:valor|pre[cç]o|moeda|va?l_|desconto|despesa)#is", $campo)){
            if(preg_match("#(?:money|float|double|number)#is", $tipoDado)){
                $modelo = Util::getConteudoTemplate($gui.'/Modelo.Form.Moeda.tpl');
            
                $modelo = str_replace('%%CAMPO%%', $campo, $modelo);
                $modelo = str_replace('%%VALOR%%', $value, $modelo);

                $retorno = $modelo;
            }
        } elseif(preg_match("#(?:genero|genre|sexo)#is", $campo)){
            $modelo = Util::getConteudoTemplate($gui.'/Modelo.Form.Sexo.tpl');
            
            $modelo = str_replace('%%CAMPO%%',           $campo,       $modelo);
            $modelo = str_replace('%%VALOR_MASCULINO%%', $valueRadioM, $modelo);
            $modelo = str_replace('%%VALOR_FEMININO%%',  $valueRadioF, $modelo);

            $retorno = $modelo;
        
        } elseif(preg_match("#(?:url|link|(?:web)?page)#is", $campo)){
            $modelo = Util::getConteudoTemplate($gui.'/Modelo.Form.Url.tpl');
            
            $modelo = str_replace('%%CAMPO%%', $campo, $modelo);
            $modelo = str_replace('%%VALOR%%', $value, $modelo);
            
            $retorno = $modelo;
            
        } else {
            $tipoInput = "text";

            //CPF
            if(preg_match("#cpf#is", $campo)){
                $classCss = " cpf";
            }

            //CPF
            if(preg_match("#(?:cnpj|cgc)#is", $campo)){
                $classCss = " cnpj";
            }

            //Telefone
            if(preg_match("#(?:tel_|fone|telefone)#is", $campo)){
                $classCss = " telefone";
            }

            //CEP
            if(preg_match("#(?:cep)#is", $campo)){
                $classCss = " cep";
            }
            
            $modelo = Util::getConteudoTemplate($gui.'/Modelo.Form.Text.tpl');
            
            $modelo = str_replace('%%TYPE%%',      $tipoInput,$modelo);
            $modelo = str_replace('%%CAMPO%%',     $campo,    $modelo);
            $modelo = str_replace('%%VALOR%%',     $value,    $modelo);
            $modelo = str_replace('%%CLASS_CSS%%', $classCss, $modelo);
            $modelo = str_replace('%%LABEL%%',     $label,    $modelo);

            $retorno = $modelo;
        }
        return $retorno;
    }
    
    /**
     * Gera campo de senha
     * 
     * @param string $obj Objeto selecionado
     * @param string $campo atributo a ser analisado
     * @param string $label Rótulo do atributo
     * @param string $tipoTela Tipo de formulário: CAD - Cadastro, EDIT - Edição
     * @param string $gui Tipo de GUI (Graphic User Interface)
     * @return string
     */
    static function geraPassword($obj, $campo, $label, $tipoTela, $gui) {
        switch ($tipoTela) {
            case 'CAD': $value = ""; break;
            case 'EDIT': $value = "<?=$obj"."->$campo?>"; break;
        }
        
        $retorno = Util::getConteudoTemplate($gui.'/Modelo.Form.Senha.tpl');
            
        $retorno = str_replace('%%LABEL%%', $label, $retorno);
        $retorno = str_replace('%%CAMPO%%', $campo, $retorno);
        $retorno = str_replace('%%VALOR%%', $value, $retorno);
        
        return $retorno;
    }
    
    /**
     * Gera campo textarea
     * 
     * @param string $obj Objeto selecionado
     * @param string $campo atributo a ser analisado
     * @param string $label Rótulo do atributo
     * @param string $tipoTela Tipo de formulário: CAD - Cadastro, EDIT - Edição
     * @param string $gui Tipo de GUI (Graphic User Interface)
     * @return string
     */
    static function geraTextArea($obj, $campo, $label, $tipoTela, $gui) {
        switch ($tipoTela) {
            case 'CAD': $value = ""; break;
            case 'EDIT': $value = "<?=$obj"."->$campo?>"; break;
        }
        $retorno = Util::getConteudoTemplate($gui.'/Modelo.Form.Textarea.tpl');
            
        $retorno = str_replace('%%LABEL%%', $label, $retorno);
        $retorno = str_replace('%%CAMPO%%', $campo, $retorno);
        $retorno = str_replace('%%VALOR%%', $value, $retorno);

        return $retorno;
    }
    /**
     * Gera combo dinâmico, alimentado por lista de valores provenientes da Chave Estrangeira (FK)
     * 
     * @param string $obj Nome do Objeto
     * @param string $campo atributo a ser analisado
     * @param string $classeFK Classe da Chave Estrangeira
     * @param string $campoFK Campo chave estrangeira
     * @param string $labelFK Atributo Textual que representa a classe
     * @param string $tipoTela Tipo de Formulário: CAD - Cadastro, EDIT - Edição
     * @param string $gui Tipo de GUI (Graphic User Interface)
     * @return string
     */
    static function geraSelect($obj, $campo, $classeFK, $campoFK, $labelFK, $tipoTela, $gui) {
        switch ($tipoTela) {
            case 'CAD': $editValue = ""; break;
            case 'EDIT': $editValue = "<?=(\$o$classeFK"."->$campo == $obj"."->o$classeFK"."->$campoFK) ? \" selected\" : \"\"?>"; break;
        }
        
        $retorno = Util::getConteudoTemplate($gui.'/Modelo.Form.Select.tpl');
            
        $retorno = str_replace('%%CLASSE_FK%%',  $classeFK,  $retorno);
        $retorno = str_replace('%%CAMPO%%',      $campo,     $retorno);
        $retorno = str_replace('%%EDIT_VALUE%%', $editValue, $retorno);
        $retorno = str_replace('%%LABEL_FK%%',   $labelFK,   $retorno);

        return $retorno;
    }
    
    /**
     * Gera combobox, alimentado por valores do Enum (MySQL Apenas)
     * 
     * @param string $obj Nome do Objeto
     * @param string $campo atributo a ser analisado
     * @param string $enum Lista de valores recuperadas
     * @param string $label Rótulo do atributo
     * @param string $tipoTela Tipo de Formulário: CAD - Cadastro, EDIT - Edição
     * @param string $gui Tipo de GUI (Graphic User Interface)
     * @return string
     */
    static function geraEnum($obj, $campo, $enum, $label, $tipoTela, $gui) {
        $retorno = Util::getConteudoTemplate($gui.'/Modelo.Form.Enum.tpl');
        
        $retorno = str_replace('%%CAMPO%%',  $campo,  $retorno);        
        $retorno = str_replace('%%LABEL%%',  $label,  $retorno);
        
        if (preg_match_all("#'(.*?)'#i", $enum, $aCampo)) {
            foreach ($aCampo[1] as $sCampo) {
                switch ($tipoTela) {
                    case 'CAD': $editValue = ""; break;
                    case 'EDIT': $editValue = "<?=($obj"."->$campo == \"$sCampo\") ? \" selected\" : \"\"?>"; break;
                }
                $aListaEnum[] = "<option value=\"$sCampo\"$editValue>$sCampo</option>";
            }
        }
        $retorno = str_replace('%%LISTA_ENUM%%',  implode("\r", $aListaEnum),  $retorno);
        return $retorno;
    }
    
    /**
     * Gera campo de calendário (Data)
     * 
     * @param string $obj Nome do Objeto
     * @param string $campo atributo a ser analisado
     * @param string $label Rótulo do atributo
     * @param string $tipoTela Tipo de Formulário: CAD - Cadastro, EDIT - Edição
     * @return string
     */
    static function geraCalendario($obj, $campo, $label, $tipoTela) {
        switch ($tipoTela) {
            case 'ADM':
                $retorno = "Util::formataDataBancoForm($obj" . "->$campo)";
                break;
            case 'CAD':
                $retorno = "
                            <label for=\"$campo\">$label</label>
                            <?php \$oControle" . "->componenteCalendario('$campo')?>";
                break;
            case 'EDIT':
                $retorno = "
                            <label for=\"$campo\">$label</label>
                            <?php \$oControle" . "->componenteCalendario('$campo', Util::formataDataBancoForm($obj" . "->$campo))?>";
                break;
        }
        return $retorno;
    }
    
    /**
     * Gera campo de calendário (Data/hora)
     * 
     * @param string $obj Nome do Objeto
     * @param string $campo atributo a ser analisado
     * @param string $label Rótulo do atributo
     * @param string $tipoTela Tipo de Formulário: CAD - Cadastro, EDIT - Edição
     * @return string
     */
    static function geraCalendarioDataHora($obj, $campo, $label, $tipoTela) {
        switch ($tipoTela) {
            case 'ADM':
                $retorno = "Util::formataDataHoraBancoForm($obj" . "->$campo)";
                break;
            case 'CAD':
                $retorno = "
                            <label for=\"$campo\">$label</label>
                            <?php \$oControle" . "->componenteCalendario('$campo', NULL, NULL, true)?>";
                break;
            case 'EDIT':
                $retorno = "
                            <label for=\"$campo\">$label</label>
                            <?php \$oControle" . "->componenteCalendario('$campo', Util::formataDataHoraBancoForm($obj" . "->$campo), NULL, true)?>";
                break;
        }
        return $retorno;
    }
    
    /**
     * Gera campo checkbox
     * 
     * @param string $obj Nome do Objeto
     * @param string $campo atributo a ser analisado
     * @param string $label Rótulo do atributo
     * @param string $tipoTela Tipo de Formulário: CAD - Cadastro, EDIT - Edição
     * @param string $gui Tipo de GUI (Graphic User Interface)
     * @return string
     */    
    static function geraCheckBox($obj, $campo, $label, $tipoTela, $gui) {
        switch ($tipoTela) {
            case 'CAD': $editValue = ""; break;
            case 'EDIT': $editValue = "<?=($obj" . "->$campo == 1) ? ' checked=\"checked\"' : '' ?>"; break;
        }
        $retorno = Util::getConteudoTemplate($gui.'/Modelo.Form.CheckBox.tpl');
            
        $retorno = str_replace('%%CAMPO%%',      $campo,     $retorno);
        $retorno = str_replace('%%LABEL%%',      $label,     $retorno);
        $retorno = str_replace('%%EDIT_VALUE%%', $editValue, $retorno);
        
        return $retorno;
    }
    
    /**
     * Gera campo hidden
     * 
     * @param string $campo nome do campo
     * @return string
     */
    static function geraHidden($campo) {
        $retorno = "<input name=\"$campo\" type=\"hidden\" id=\"$campo\" value=\"<?=\$_REQUEST['$campo']?>\" />";
        return $retorno;
    }
    
    /**
     * Gera botão de acesso a tela de edição
     * 
     * @param string $nomeClasse Nome da Classe
     * @param string $idPK Nome do campo PK do objeto a ser editado
     * @param string $PK Nome da chave primária da classe
     * @param string $gui Tipo de GUI (Graphic User Interface)
     * @return string
     */
    static function geraAdmEdit($nomeClasse, $idPK, $PK, $gui) {
        $retorno = Util::getConteudoTemplate($gui.'/Modelo.Form.AdmEdit.tpl');
            
        $retorno = str_replace('%%CLASSE%%', $nomeClasse, $retorno);
        $retorno = str_replace('%%ID_PK%%',  $idPK,       $retorno);
        $retorno = str_replace('%%PK%%',     $PK,         $retorno);

        return $retorno;
    }

    /**
     * Gera botão de exclusão
     * 
     * @param string $nomeClasse Nome da Classe
     * @param string $idPK Nome do campo PK do objeto a ser editado
     * @param string $PK Nome da chave primária da classe
     * @param string $gui Tipo de GUI (Graphic User Interface)
     * @return string
     */
    static function geraAdmDelete($nomeClasse, $idPK, $PK, $gui) {
        $retorno = Util::getConteudoTemplate($gui.'/Modelo.Form.AdmDel.tpl');
            
        $retorno = str_replace('%%CLASSE%%', $nomeClasse, $retorno);
        $retorno = str_replace('%%ID_PK%%',  $idPK,       $retorno);
        $retorno = str_replace('%%PK%%',     $PK,         $retorno);
        
        return $retorno;
    }
}
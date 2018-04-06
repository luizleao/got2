<?php
class UsuarioBDBase {
    public $oConexao;
    public $msg;

    function __construct(Conexao $oConexao){
        try{
            $this->oConexao = $oConexao;
        } 
        catch (PDOException $e){
            $this->msg = $e->getMessage();
        }
    }
	
    function inserir($oUsuario){
        $reg = UsuarioMAP::objToRs($oUsuario);
        $aCampo = array_keys($reg);
        $sql = "
                insert into usuario(
                    ".implode(',', $aCampo)."
                ) 
                values(
                    :".implode(", :", $aCampo).")";

            foreach($reg as $cv=>$vl)
                $regTemp[":$cv"] = ($vl=='') ? NULL : $vl;

            try{
                $this->oConexao->executePrepare($sql, $regTemp);
                if($this->oConexao->msg != ""){
                    $this->msg = $this->oConexao->msg;
                    return false;
                }
                return $this->oConexao->lastID();
            }
            catch(PDOException $e){
                $this->msg = $e->getMessage();
                return false;
            }
	}
	
	function alterar($oUsuario){
            $reg = UsuarioMAP::objToRs($oUsuario);
            $sql = "
                    update 
                        usuario 
                    set
                        ";
            foreach($reg as $cv=>$vl){
                if($cv == "idUsuario") continue;
                $a[] = "$cv = :$cv";
            }
            $sql .= implode(",\n", $a);
            $sql .= "
                    where
                        idUsuario = {$reg['idUsuario']}";

            foreach($reg as $cv=>$vl){
                if($cv == "idUsuario") continue;
                $regTemp[":$cv"] = ($vl=='') ? NULL : $vl;
            }
            try{
                $this->oConexao->executePrepare($sql, $regTemp);
                if($this->oConexao->msg != ""){
                    $this->msg = $this->oConexao->msg;
                    return false;
                }
                return true;
            }
            catch(PDOException $e){
                $this->msg = $e->getMessage();
                return false;
            }
	}
	
	function excluir($idUsuario){
            $sql = "
                    delete from
                        usuario 
                    where
                        idUsuario = $idUsuario";

            try{
                $this->oConexao->execute($sql);
                if($this->oConexao->msg != ""){
                    $this->msg = $this->oConexao->msg;
                    return false;
                }
                return true;
            }
            catch(PDOException $e){
                $this->msg = $e->getMessage();
                return false;
            }
	}
	
	function selecionar($idUsuario){
            $sql = "
                    select 
                        usuario.idUsuario as usuario_idUsuario,
					usuario.login as usuario_login,
					usuario.senha as usuario_senha,
					usuario.nome as usuario_nome,
					usuario.ativo as usuario_ativo,
					usuario.grupo as usuario_grupo 
                    from
                        usuario 
                    where
                        usuario.idUsuario = $idUsuario";
            try{
                $this->oConexao->execute($sql);
                if($this->oConexao->numRows() != 0){
                    $aReg = $this->oConexao->fetchReg();
                    return UsuarioMAP::rsToObj($aReg);
                } else {
                    $this->msg = "Nenhum registro encontrado!";
                    return false;
                }
            }
            catch(PDOException $e){
                $this->msg = $e->getMessage();
                return false;
            }
	}
	
    function carregarColecao(){
        $sql = "
                select
                    usuario.idUsuario as usuario_idUsuario,
					usuario.login as usuario_login,
					usuario.senha as usuario_senha,
					usuario.nome as usuario_nome,
					usuario.ativo as usuario_ativo,
					usuario.grupo as usuario_grupo 
                from
                    usuario";

        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = UsuarioMAP::rsToObj($aReg);
                }
                return $aObj;
            } else {
                return false;
            }
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }

    function totalColecao(){
        $sql = "select count(*) from usuario";
        try{
            $this->oConexao->execute($sql);
            $aReg = $this->oConexao->fetchReg();
            return (int) $aReg[0];
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }
	
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
                select
                    usuario.idUsuario as usuario_idUsuario,
					usuario.login as usuario_login,
					usuario.senha as usuario_senha,
					usuario.nome as usuario_nome,
					usuario.ativo as usuario_ativo,
					usuario.grupo as usuario_grupo 
                from
                    usuario
                where
                    usuario.login like '$valor' 
					or usuario.senha like '$valor' 
					or usuario.nome like '$valor' 
					or usuario.ativo like '$valor' 
					or usuario.grupo like '$valor'";
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = UsuarioMAP::rsToObj($aReg);
                }
                return $aObj;
            } else {
                return false;
            }
        }
    	catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }
}
<?php
class PostBDBase {
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
	
    function inserir($oPost){
        $reg = PostMAP::objToRs($oPost);
        $aCampo = array_keys($reg);
        $sql = "
                insert into post(
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
	
	function alterar($oPost){
            $reg = PostMAP::objToRs($oPost);
            $sql = "
                    update 
                        post 
                    set
                        ";
            foreach($reg as $cv=>$vl){
                if($cv == "idPost") continue;
                $a[] = "$cv = :$cv";
            }
            $sql .= implode(",\n", $a);
            $sql .= "
                    where
                        idPost = {$reg['idPost']}";

            foreach($reg as $cv=>$vl){
                if($cv == "idPost") continue;
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
	
	function excluir($idPost){
            $sql = "
                    delete from
                        post 
                    where
                        idPost = $idPost";

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
	
	function selecionar($idPost){
            $sql = "
                    select 
                        post.idPost as post_idPost,
					post.idUsuario as post_idUsuario,
					post.titulo as post_titulo,
					post.descricao as post_descricao,
					post.dataHoraCadastro as post_dataHoraCadastro,
					usuario.idUsuario as usuario_idUsuario,
					usuario.login as usuario_login,
					usuario.senha as usuario_senha,
					usuario.nome as usuario_nome,
					usuario.ativo as usuario_ativo,
					usuario.grupo as usuario_grupo 
                    from
                        post 
				left join usuario 
					on (post.idUsuario = usuario.idUsuario) 
                    where
                        post.idPost = $idPost";
            try{
                $this->oConexao->execute($sql);
                if($this->oConexao->numRows() != 0){
                    $aReg = $this->oConexao->fetchReg();
                    return PostMAP::rsToObj($aReg);
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
                    post.idPost as post_idPost,
					post.idUsuario as post_idUsuario,
					post.titulo as post_titulo,
					post.descricao as post_descricao,
					post.dataHoraCadastro as post_dataHoraCadastro,
					usuario.idUsuario as usuario_idUsuario,
					usuario.login as usuario_login,
					usuario.senha as usuario_senha,
					usuario.nome as usuario_nome,
					usuario.ativo as usuario_ativo,
					usuario.grupo as usuario_grupo 
                from
                    post 
				left join usuario 
					on (post.idUsuario = usuario.idUsuario)";

        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = PostMAP::rsToObj($aReg);
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
        $sql = "select count(*) from post";
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
                    post.idPost as post_idPost,
					post.idUsuario as post_idUsuario,
					post.titulo as post_titulo,
					post.descricao as post_descricao,
					post.dataHoraCadastro as post_dataHoraCadastro,
					usuario.idUsuario as usuario_idUsuario,
					usuario.login as usuario_login,
					usuario.senha as usuario_senha,
					usuario.nome as usuario_nome,
					usuario.ativo as usuario_ativo,
					usuario.grupo as usuario_grupo 
                from
                    post 
				left join usuario 
					on (post.idUsuario = usuario.idUsuario)
                where
                    post.idUsuario like '$valor' 
					or post.titulo like '$valor' 
					or post.descricao like '$valor' 
					or post.dataHoraCadastro like '$valor'";
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = PostMAP::rsToObj($aReg);
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
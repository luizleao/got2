<?php
class ComentarioBDBase {
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
	
    function inserir($oComentario){
        $reg = ComentarioMAP::objToRs($oComentario);
        $aCampo = array_keys($reg);
        $sql = "
                insert into comentario(
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
	
	function alterar($oComentario){
            $reg = ComentarioMAP::objToRs($oComentario);
            $sql = "
                    update 
                        comentario 
                    set
                        ";
            foreach($reg as $cv=>$vl){
                if($cv == "idComentario") continue;
                $a[] = "$cv = :$cv";
            }
            $sql .= implode(",\n", $a);
            $sql .= "
                    where
                        idComentario = {$reg['idComentario']}";

            foreach($reg as $cv=>$vl){
                if($cv == "idComentario") continue;
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
	
	function excluir($idComentario){
            $sql = "
                    delete from
                        comentario 
                    where
                        idComentario = $idComentario";

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
	
	function selecionar($idComentario){
            $sql = "
                    select 
                        comentario.idComentario as comentario_idComentario,
					comentario.idPost as comentario_idPost,
					comentario.descricao as comentario_descricao,
					comentario.nome as comentario_nome,
					comentario.email as comentario_email,
					comentario.webpage as comentario_webpage,
					comentario.dataHoraCadastro as comentario_dataHoraCadastro,
					post.idPost as post_idPost,
					post.idUsuario as post_idUsuario,
					post.titulo as post_titulo,
					post.descricao as post_descricao,
					post.dataHoraCadastro as post_dataHoraCadastro 
                    from
                        comentario 
				left join post 
					on (comentario.idPost = post.idPost) 
                    where
                        comentario.idComentario = $idComentario";
            try{
                $this->oConexao->execute($sql);
                if($this->oConexao->numRows() != 0){
                    $aReg = $this->oConexao->fetchReg();
                    return ComentarioMAP::rsToObj($aReg);
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
                    comentario.idComentario as comentario_idComentario,
					comentario.idPost as comentario_idPost,
					comentario.descricao as comentario_descricao,
					comentario.nome as comentario_nome,
					comentario.email as comentario_email,
					comentario.webpage as comentario_webpage,
					comentario.dataHoraCadastro as comentario_dataHoraCadastro,
					post.idPost as post_idPost,
					post.idUsuario as post_idUsuario,
					post.titulo as post_titulo,
					post.descricao as post_descricao,
					post.dataHoraCadastro as post_dataHoraCadastro 
                from
                    comentario 
				left join post 
					on (comentario.idPost = post.idPost)";

        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = ComentarioMAP::rsToObj($aReg);
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
        $sql = "select count(*) from comentario";
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
                    comentario.idComentario as comentario_idComentario,
					comentario.idPost as comentario_idPost,
					comentario.descricao as comentario_descricao,
					comentario.nome as comentario_nome,
					comentario.email as comentario_email,
					comentario.webpage as comentario_webpage,
					comentario.dataHoraCadastro as comentario_dataHoraCadastro,
					post.idPost as post_idPost,
					post.idUsuario as post_idUsuario,
					post.titulo as post_titulo,
					post.descricao as post_descricao,
					post.dataHoraCadastro as post_dataHoraCadastro 
                from
                    comentario 
				left join post 
					on (comentario.idPost = post.idPost)
                where
                    comentario.idPost like '$valor' 
					or comentario.descricao like '$valor' 
					or comentario.nome like '$valor' 
					or comentario.email like '$valor' 
					or comentario.webpage like '$valor' 
					or comentario.dataHoraCadastro like '$valor'";
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = ComentarioMAP::rsToObj($aReg);
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
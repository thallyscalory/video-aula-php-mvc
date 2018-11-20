<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaoProduto
 *
 * @author Usuario
 */
class DaoProduto implements IDao {
    
    
    public function excluir($p) { //variavel "p" é produto
        $sql = "delete FROM produto where id=:ID";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $p1 = $p->getId();
        $sth->bindParam("ID", $p1);
        try {
            $sth->execute();
            return true;
        } catch (Exception $exc) {
            return $exc->getMessage();
        }
    }
    public function listar($p1) {
        $sql = "SELECT * FROM produto where id=:ID";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $sth->bindParam("ID", $p1);
        try {
            $sth->execute();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        $prod = $sth->fetchObject("Produto");
        return $prod;
    }
    public function listarTodos() {
        $sql = "SELECT * FROM produto";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        try {
            $sth->execute();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        $arProd = array();
        while ($Prod = $sth->fetchObject("Produto")) {
            $dcat = new DaoCategoria();
            if ($Prod->categorias) {
                $cat = $dcat->listar($Prod->categorias);
                $Prod->setCategoria($cat);
            }
   
            $arProd[] = $Prod;
        }
        return $arProd;
    }
    public function salvar($p) {
        $nome = $p->getNome();
        $valor = $p->getValor();
        $situacao = $p->getSituacao();
        $categoria = $p->getCategoria();
        $id = 0;
        if ($p->getId()) {
            $id = $p->getId();
            $sql = "update produto set nome=:nome, situacao=:situacao, valor=:valor, categorias=:categorias where id=:id";
        } else {
            $sql = "insert into produto(id,nome,situacao,valor,categorias) values "
                    . "(:id,:nome,:situacao,:valor,:categorias)";
        }
        $cnx = Conexao::getConexao();
        $sth = $cnx->prepare($sql);
        $sth->bindParam("id", $id);
        $sth->bindParam("nome", $nome);
        $sth->bindParam("situacao", $situacao);
        $sth->bindParam("valor", $valor);
        $sth->bindParam("categorias", $categoria);
        
        try {
            $sth->execute();
            return $p;
        } catch (Exception $exc) {
            return $exc->getMessage();
    }
    }
}
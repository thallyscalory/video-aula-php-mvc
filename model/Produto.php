<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Produto
 *
 * @author Usuario
 */
class Produto {
    private $id;
    private $nome;
    private $situacao;
    private $valor;
    private $categoria;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getSituacao() {
        return $this->situacao;
    }

    function getValor() {
        return $this->valor;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }


}
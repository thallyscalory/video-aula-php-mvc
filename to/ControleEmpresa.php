<?php

/**
 * Description of ControleUsuario
 *
 * @author Administrador
 */
class ControleEmpresa implements IPrivateTO {

    public function listaDeEmpresa() {
        $de = new DaoEmpresa();
        $empresas = $de->listarTodos();
        $v = new TGui("listaDeEmpresa");
        $v->addDados("empresas", $empresas);
        $v->renderizar();
    }

    public function editar($id) {
        $p1 = $id[2];
        $de = new DaoEmpresa();
        $u = $de->listar($p1);
        $v = new TGui("formularioEmpresa");
        $v->addDados("empresario", $u);
        $v->renderizar();
    }

    public function novo() {
        $u = new Empresa();
        $v = new TGui("formularioEmpresa");
        $v->addDados("empresa", $u);
        $v->renderizar();
    }

    public function salvar() {
       
        $u = new Empresa();
        $id = isset($_POST['id']) ? $_POST['id'] : FALSE;
        if (trim($id) != "") {
            $u->setId($id);
        }
        $nome = isset($_POST['nome']) ? $_POST['nome'] : FALSE;
        if (!$nome || trim($nome) == "") {
            throw new Exception("O campo nome é obrigatório!");
        }
        $situacao = isset($_POST['situacao']) ? $_POST['situacao'] : FALSE;
        if (!$situacao || trim($situacao) == "") {
            throw new Exception("O campo situacao é obrigatório!");
        }
        
        $u->setNome($nome);
        $u->setSituacao($situacao);
        

        $de = new DaoEmpresa();
        $emp = $de->salvar($u);
        header("location: " . URL . "controle-empresa/lista-de-empresa");
       
    }

    public function excluir($id) {
        $p1 = $id[2];
        $de = new DaoEmpresa();
        $u = $de->listar($p1);
        $v = new TGui("confirmaExclusaoEmpresa");
        $v->addDados("empresa", $u);
        $v->renderizar();
    }

    public function confirmaExclusao() {
        $id = isset($_POST['id']) ? $_POST['id'] : false;
        if ($id) {
            $de = new DaoEmpresa();
            $u = $de->listar($id);
            if ($de->excluir($u)) {
                header("location: " . URL . "controle-empresa/lista-de-empresa");
            } else {
                throw new Exception("Não foi possível excluir o registro!");
            }
        } else {
            header("location: " . URL . "controle-empresa/lista-de-empresa");
        }
    }

}

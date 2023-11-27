<?php
    include_once "../bd/conexao.php";

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $id = $dados['idAssuntoEdit'];
    $topico = $dados['assuntoEdit'];
    $ativo = $dados['ativoAssuntoEdit'];

    if(empty($id)){
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Tente mais tarde!</div>"];
    }
    else{
        $editAssunto = "UPDATE topico SET
            topico = '$topico',
            ativo = '$ativo'
        WHERE id = $id";
        if($mysqli->query($editAssunto)){
            $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'> Editado com sucesso! </div>"];
        }else{
            $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro ao editar empresa!</div>"];
        }
        
    }

    echo json_encode($retorna);

?>
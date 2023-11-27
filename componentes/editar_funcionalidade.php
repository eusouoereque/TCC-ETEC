<?php
    include_once "../bd/conexao.php";

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $id = $dados['idFuncEdit'];
    $subtopico = $dados['funcEdit'];
    $ativo = $dados['ativoFuncEdit'];
    $id_topico = $dados['topicoFuncEdit'];
    $id_prioridade = $dados['funcPrioridadeEdit'];
    

    if(empty($id)){
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Tente mais tarde!</div>"];
    }
    else{
        $editFuncionalidade = "UPDATE subtopico SET
            subtopico = '$subtopico',
            ativo = '$ativo',
            id_topico = '$id_topico',
            id_prioridade = '$id_prioridade'
            WHERE id = $id";
        if($mysqli->query($editFuncionalidade)){
            $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'> Editado com sucesso! </div>"];
        }else{
            $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro ao editar empresa!</div>"];
        }
        
    }

    echo json_encode($retorna);

?>
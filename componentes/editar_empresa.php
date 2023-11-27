<?php
    include_once "../bd/conexao.php";

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $id_empresa = $dados['idEmpresaEdit'];
    $empresa = $dados['empresaEdit'];
    $razao_social = $dados['razaoSocialEdit'];
    $cnpj = $dados['cnpjEdit'];
    $ativo = $dados['ativoEmpresaEdit'];

    if(empty($id_empresa)){
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Tente mais tarde!</div>"];
    }
    else{
        $editEmpresa = "UPDATE empresa SET
            empresa = '$empresa',
            razao_social = '$razao_social', 
            cnpj = '$cnpj', 
            ativo = '$ativo'
        WHERE id_empresa = $id_empresa ";
        if($mysqli->query($editEmpresa)){
            $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'> Editado com sucesso! </div>"];
        }else{
            $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro ao editar empresa!</div>"];
        }
        
    }

    echo json_encode($retorna);

?>
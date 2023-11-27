<?php
    include_once "../bd/conexao.php";

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $id_user = $dados['idUsuarioEdit'];
    $nome = $dados['nomeUsuarioEdit'];
    $email = $dados['emailUserEdit'];
    $id_empresa = $dados['empresaUsuarioEdit'];
    $ativo = $dados['ativoUserEdit'];
    $id_nivel = $dados['nivelUsuarioEdit'];

    if(empty($id_user)){
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Tente mais tarde!</div>"];
    }
    else{
        $editUser = "UPDATE usuario SET
            nome='$nome',
            email='$email',
            id_empresa_usuario='$id_empresa', 
            ativo_user='$ativo', 
            id_nivel='$id_nivel'
        WHERE id_user = $id_user ";
        if($mysqli->query($editUser)){
            $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'> Editado com sucesso! </div>"];
        }else{
            $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro ao editar usuário!</div>"];
        }
        
    }

    echo json_encode($retorna);

?>
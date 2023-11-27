<?php
    include_once "../bd/conexao.php";
    include_once "protect.php";

    $id_user = $_POST['idUsuarioEditConta'];
    $nome = $mysqli->real_escape_string($_POST['nomeEditConta']);
    $email = $_POST['emailEditConta'];
    $senha = $mysqli->real_escape_string($_POST['senhaEditConta']);
    $senhaNew = $_POST['SenhaNewEditConta'];
    $SenhaNew2 = $_POST['SenhaNewEditContaRep'];

    $sqlCheca = "SELECT senha FROM usuario WHERE nome = '$nome' AND senha = '$senha'";

    $sql_result_busca = $mysqli->query($sqlCheca);

    $quantidade = $sql_result_busca->num_rows;



    

    if(empty($id_user)){
        $_SESSION['mensagem'] = "Erro ao alterar dados!";
        header("Location: ../index.php");
    }
    else{
        if ($quantidade == 1) {

            $editConta = "UPDATE usuario SET
            email='$email',
            senha='$senhaNew'
            WHERE id_user = $id_user";

            $sql_result_busca = $mysqli->query($editConta);

            $_SESSION['mensagem'] = "Dados alterados com sucesso!";
            header("Location: ../index.php");

        }else{
            $_SESSION['mensagem'] = "Erro ao alterar dados! Senha atual incorreta.";
            header("Location: ../index.php");
        }
           
    }
        
    

?>
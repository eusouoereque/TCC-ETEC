<?php 
    include_once "../bd/conexao.php";
    include_once "../componentes/protect.php";

    if (isset($_POST['enviar_email'])) {

        $email = mysqli_escape_string($mysqli, $_POST['emailUsuario']);

        $id = $_SESSION['user'];

        $sql_email = "UPDATE usuario
        SET email = '$email'
        WHERE id_user = $id";

        if($mysqli->query($sql_email)){
            $_SESSION['mensagem'] = "E-mail adicionado com sucesso!";
            header("Location: ../index.php");
        } else {
            $_SESSION['mensagem'] = "Erro ao cadastrar!";
            header("Location: ../index.php");
        }
    }
    


?>
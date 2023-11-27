<?php 
    include_once "../bd/conexao.php";
    include_once "../componentes/protect.php";

    if (isset($_POST['enviar_usuario'])) {

        $nome = mysqli_escape_string($mysqli, $_POST['nomeUsuarioNav']);
        $email = mysqli_escape_string($mysqli, $_POST['emailUser']);
        $empresa = mysqli_escape_string($mysqli, $_POST['empresaUsuarioNav']);
        $nivel = mysqli_escape_string($mysqli, $_POST['nivelUsuarioNav']);
        $senha = mysqli_escape_string($mysqli, $_POST['senhaUsuarioNav']);
        $senha2 = mysqli_escape_string($mysqli, $_POST['confirmaSenhaUsuarioNav']);
        $ativo = 1;

        $sql_usuario = "INSERT INTO usuario
        (nome, email, senha, id_empresa_usuario, ativo_user, data_criacao_user, id_nivel) VALUES
        ('$nome', '$email', '$senha', '$empresa' , $ativo, now(), $nivel)";

        if($mysqli->query($sql_usuario)){
            $_SESSION['mensagem'] = "Cadastrado com sucesso!";
            header("Location: ../usuarios.php");
        } else {
            $_SESSION['mensagem'] = "Erro ao cadastrar!";
            header("Location: ../usuarios.php");
        }
    }
    


?>
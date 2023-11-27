<?php

include '../bd/conexao.php';

$email = mysqli_escape_string($mysqli, $_POST['emailSenha']);

$sql = "SELECT * FROM usuario WHERE email = '$email'";
$query = mysqli_query($mysqli, $sql);
$result = mysqli_fetch_assoc($query);
// $emailResult = $result['email'];




if (empty($result)) {
    session_start();
    $_SESSION['mensagem'] = "Esse email não foi encontrado!";
                    header("Location: ../componentes/esqueci_senha.php");

} else {
    $senha = $result['senha'];
    header("Location: senha_email.php?email=$email&senha=$senha");
?>


    <script>
        window.alert('Sua senha foi enviada para seu email!')
    </script>
<?php
}
?>
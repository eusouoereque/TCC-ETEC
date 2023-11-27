<?php

include_once '../componentes/esqueci_senha.php';
include_once '../bd/conexao.php';

$email = mysqli_escape_string($mysqli, $_POST['emailSenha']);

$sql = "SELECT * FROM usuario WHERE email = '$email'";
$query = mysqli_query($mysqli, $sql);
$result = mysqli_fetch_assoc($query);
$emailResult = $result['email'];

print_r($emailResult);

?>
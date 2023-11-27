<?php

include_once '../componentes/protect.php';
include_once '../bd/conexao.php';

$id_ticket = $_GET['id'];

$sql = "SELECT *  FROM topico topi
JOIN ticket tic
ON topi.id = tic.id_topico_ticket
JOIN subtopico sub
ON sub.id = tic.id_subtopico
JOIN empresa emp
ON emp.id_empresa = tic.id_empresa_ticket
JOIN usuario us
ON us.id_user = tic.id_usuario
JOIN prioridade pri
ON pri.id = tic.id_prioridade_ticket
JOIN status sta
ON sta.id = tic.id_status

WHERE tic.id_ticket = " . " '$id_ticket'";

$email = $mysqli->query($sql);

while($user_data = mysqli_fetch_assoc($email)){
    $status = $user_data['status'];
    $topico = $user_data['topico'];
    $subtopico = $user_data['subtopico'];
    $prioridade = $user_data['prioridade'];
    $titulo =  $user_data['titulo'];
    $empresa = $user_data['empresa'];
    $detalhes = $user_data['detalhes'];
    $username = $user_data['nome'];
    $email_enviar = $user_data['email'];
}
?>
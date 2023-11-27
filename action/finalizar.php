<?php
include_once "../bd/conexao.php";
include_once "../componentes/protect.php";

$finalizar = mysqli_escape_string($mysqli, $_POST['finalizar']);
$id_ticket = mysqli_escape_string($mysqli, $_POST['id_ticket_finalizar']);

    if($_SESSION['nivel'] == 2){
        header("Location: ../index.php");
    }else{
            if (isset($_POST['btnfinalizar'])) {
                
                $sql_finalizar = "UPDATE ticket
                                    SET id_status = $finalizar
                                    WHERE id_ticket = $id_ticket";
            
                if ($mysqli->query($sql_finalizar)) {
                    $_SESSION['mensagem'] = "Status alterado com sucesso!";
                    header("Location: email.php?id=$id_ticket");
                } else {
                    $_SESSION['mensagem'] = "Erro ao alterar status!";
                    header("Location: ../ticket_adm.php?id=$id_ticket");
                }
            }else{
                $_SESSION['mensagem'] = "Erro ao alterar status!";
                header("Location: ../ticket_adm.php?id=$id_ticket");
            }
    }


<?php
include_once "../bd/conexao.php";
include_once "../componentes/protect.php";

if($_SESSION['nivel'] == 2){
    header("Location: ../index.php");
}else{
        if (isset($_POST['enviar_resposta'])) {
            $comentario = mysqli_escape_string($mysqli, $_POST['resposta']);
            $id_ticket = mysqli_escape_string($mysqli, $_POST['id_ticket_comentario']);
            $usuario = $_SESSION['user'];
            $sql_comentario = "INSERT INTO comentario
                    (comentario, id_usuario_comentario, id_ticket_comentario, datainsert) VALUES
                    ('$comentario', '$usuario', '$id_ticket' , now())";
        
            if ($mysqli->query($sql_comentario)) {
                $_SESSION['mensagem'] = "Respondido com sucesso!";
                header("Location: ../ticket_adm.php?id=$id_ticket");
            } else {
                $_SESSION['mensagem'] = "Erro ao responder!";
                header("Location: ../ticket_adm.php?id=$id_ticket");
            }
        }else{
            $_SESSION['mensagem'] = "Erro ao responder!";
            header("Location: ../ticket_adm.php?id=$id_ticket");
        }
}
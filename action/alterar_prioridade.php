<?php
include_once "../bd/conexao.php";
include_once "../componentes/protect.php";

$prioridade = mysqli_escape_string($mysqli, $_POST['prioridade']);
$id_ticket = mysqli_escape_string($mysqli, $_POST['id_ticket_prioridade']);

if($prioridade == 4){
    $_SESSION['mensagem'] = "Valor invalido!";
    header("Location: ../ticket_adm.php?id=$id_ticket");
}else{
    if($_SESSION['nivel'] == 2){
        header("Location: ../index.php");
    }else{
            if (isset($_POST['btnalterarprioridade'])) {
                
                $sql_comentario = "UPDATE ticket
                                    SET id_prioridade_ticket = $prioridade
                                    WHERE id_ticket = $id_ticket";
            
                if ($mysqli->query($sql_comentario)) {
                    $_SESSION['mensagem'] = "Prioridade alterada com sucesso!";
                    header("Location: ../ticket_adm.php?id=$id_ticket");
                } else {
                    $_SESSION['mensagem'] = "Erro ao alterar prioridade!";
                    header("Location: ../ticket_adm.php?id=$id_ticket");
                }
            }else{
                $_SESSION['mensagem'] = "Erro ao alterar prioridade!";
                header("Location: ../ticket_adm.php?id=$id_ticket");
            }
    }
}


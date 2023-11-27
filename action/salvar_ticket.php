<?php 
    include_once "../bd/conexao.php";
    include_once "../componentes/protect.php";


    $topico = $_POST['topico'];
    $subtopico = $_POST['subtopico'];
    $titulo = $_POST['titulo'];
    $detalhes = $_POST['detalhes'];
    $idusuario = $_SESSION['user'];
    $empresa = $_SESSION['empresa'];
    $empresa_adm = $_POST['empresaticket'];
    $status = 3;
    $sql_prioridade = "SELECT id_prioridade FROM prioridade pri
                    JOIN  subtopico sub
                    ON pri.id = sub.id_prioridade
                    WHERE sub.id =  $subtopico;";
    $result_prioridade = $mysqli->query($sql_prioridade);
    //$prioridade = mysqli_fetch_array($result_prioridade);


    while ($row = mysqli_fetch_assoc($result_prioridade)) {
        $prioridade = $row['id_prioridade'];
    }

    if($_SESSION['nivel'] == 1){

        $sql_ticket_adm = "INSERT INTO ticket
        (id_topico_ticket, id_subtopico, titulo, detalhes, id_empresa_ticket, id_usuario, data_abertura, id_prioridade_ticket, id_status) VALUES
        ($topico, $subtopico, '$titulo', '$detalhes', $empresa_adm, $idusuario, now(), $prioridade, $status)";

        if($mysqli->query($sql_ticket_adm)){
            $_SESSION['mensagem'] = "Ticket enviado com sucesso!";
            header("Location: ../meu_ticket.php");
        } else {
            $_SESSION['mensagem'] = "Erro ao enviar ticket!";
            header("Location: ../meu_ticket.php");
        }
    }else{

        $sql_ticket = "INSERT INTO ticket
        (id_topico_ticket, id_subtopico, titulo, detalhes, id_empresa_ticket, id_usuario, data_abertura, id_prioridade_ticket, id_status) VALUES
        ($topico, $subtopico, '$titulo', '$detalhes', $empresa, $idusuario, now(), $prioridade, $status)";

        if($mysqli->query($sql_ticket)){
            $_SESSION['mensagem'] = "Ticket enviado com sucesso! Por favor aguarde a resposta.";
            header("Location: ../meu_ticket.php");
        } else {
            $_SESSION['mensagem'] = "Erro ao enviar ticket!";
            header("Location: ../meu_ticket.php");
        }
    }







?>
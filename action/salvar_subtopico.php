<?php 
    include_once "../bd/conexao.php";
    include_once "../componentes/protect.php";

    if (isset($_POST['enviar_subtopico'])) {
        $topico = mysqli_escape_string($mysqli, $_POST['topicoSubtopicoNav']);
        $subtopico = mysqli_escape_string($mysqli, $_POST['subtopicoNav']);
        $prioridade = mysqli_escape_string($mysqli, $_POST['subtopicoPrioridadeNav']);
        $ativo = mysqli_escape_string($mysqli, $_POST['ativoSubtopicoNav']);

        $sql_subtopico = "INSERT INTO subtopico
        (subtopico, ativo, id_topico, id_prioridade) VALUES
        ('$subtopico', '$ativo', '$topico' , $prioridade)";

        if ($mysqli->query($sql_subtopico)) {
            $_SESSION['mensagem'] = "Adicionado com sucesso!";
            header("Location: ../subtopicos.php");
        } else {
            $_SESSION['mensagem'] = "Erro ao adicionar!";
            header("Location: ../subtopicos.php");
        }
    }


?>
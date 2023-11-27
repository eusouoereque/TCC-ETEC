<?php 
    include_once "../bd/conexao.php";
    include_once "../componentes/protect.php";

    if (isset($_POST['enviar_topico'])) {
        $topico = mysqli_escape_string($mysqli, $_POST['topicoNav']);
        $ativo = mysqli_escape_string($mysqli, $_POST['ativoTopicoNav']);

        $sql_topico = "INSERT INTO topico
        (topico, ativo) VALUES
        ('$topico', $ativo)";

        if($mysqli->query($sql_topico)){
            $_SESSION['mensagem'] = "Adicionado com sucesso!";
            header("Location: ../topicos.php");
        } else {
            $_SESSION['mensagem'] = "Erro ao adicionar!";
            header("Location: ../topicos.php");
        }
    }


?>
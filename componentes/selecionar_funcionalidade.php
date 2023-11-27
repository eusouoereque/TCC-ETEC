<?php
    include 'protect.php';
    include '../bd/conexao.php';

    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    if(!empty($id)){
        $sql = "SELECT subt.id, subt.subtopico, subt.ativo, topi.id as id_topico, prio.id as id_prioridade FROM subtopico subt
        JOIN topico topi
        ON topi.id = subt.id_topico
        JOIN prioridade prio
        ON prio.id = subt.id_prioridade
        WHERE subt.id = '$id' LIMIT 1";

        $result = $mysqli->query($sql);

        $row_funcionalidade = mysqli_fetch_assoc($result);

       $retorna = $row_funcionalidade;


    }else{
        $retorna = "erro";
    }

    echo json_encode($retorna);

    

?>
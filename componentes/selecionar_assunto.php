<?php
    include 'protect.php';
    include '../bd/conexao.php';

    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    if(!empty($id)){
        $sql = "SELECT * FROM topico
        WHERE id = '$id' LIMIT 1";

        $result = $mysqli->query($sql);

        $row_assunto = mysqli_fetch_assoc($result);

       $retorna = $row_assunto;


    }else{
        $retorna = "erro";
    }

    echo json_encode($retorna);

    

?>
<?php
    include 'protect.php';
    include '../bd/conexao.php';

    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    if(!empty($id)){
        $sql = "SELECT id_empresa, razao_social, empresa, cnpj, ativo FROM empresa emp
        WHERE id_empresa = '$id' LIMIT 1";

        $result = $mysqli->query($sql);

        $row_empresa = mysqli_fetch_assoc($result);

       $retorna = $row_empresa;


    }else{
        $retorna = "erro";
    }

    echo json_encode($retorna);

    

?>
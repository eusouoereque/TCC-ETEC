<?php
    include 'protect.php';
    include '../bd/conexao.php';

    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);


    
    if(!empty($id)){
        $sql = "SELECT id_user, nome, email, id_empresa, ativo_user, niv.id 
        
        FROM usuario user
        JOIN empresa emp
        ON emp.id_empresa = user.id_empresa_usuario
        JOIN nivel niv
        ON niv.id = user.id_nivel
        WHERE id_user = '$id' LIMIT 1";

        $result = $mysqli->query($sql);

        $row_usuario = mysqli_fetch_assoc($result);



       $retorna = $row_usuario;



    }else{
        $retorna = "erro";
    }

    echo json_encode($retorna);

?>
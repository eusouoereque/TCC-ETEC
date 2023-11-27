

<?php
    header('Content-type: text/html; charset=iso-8859-1');
    include_once ("bd/conexao.php");
    $topico = $_REQUEST['topico'];

    $result_subtopico = "SELECT * FROM subtopico WHERE id_topico=$topico AND ativo=1 ORDER BY subtopico";
    $resultado_subtopico = mysqli_query($mysqli, $result_subtopico);

    while ($row_subtopico = mysqli_fetch_assoc($resultado_subtopico) ){
        $subtopico[] = array(
            'id' =>$row_subtopico['id'],
            'nome_subtopico' => $row_subtopico['subtopico'],
        );
    }

    echo (json_encode($subtopico));


?>


<?php
    include 'componentes/protect.php';
    include 'bd/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="./imagens/favicon.ico" type="image/x-icon">
        <title>Sistemax Sistemas</title>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="css/estilo.css">
        <link rel="stylesheet" href="css/meu-ticket.css">
        <link rel="stylesheet" href="css/ticket.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    </head>
    <body style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
    <?php
        include 'componentes/navbar.php';
        $id_ticket = $_GET['id'];

        $sql_ticket = "SELECT * FROM ticket tic
         JOIN topico topi
         ON tic.id_topico_ticket = topi.id
         JOIN subtopico sub
         ON sub.id = tic.id_subtopico
         JOIN empresa emp
         ON emp.id_empresa = tic.id_empresa_ticket
         JOIN usuario us
         ON us.id_user = tic.id_usuario
         JOIN prioridade pri
         ON pri.id = tic.id_prioridade_ticket
         JOIN status sta
         ON sta.id = tic.id_status

         WHERE tic.id_ticket = " . " '$id_ticket'
        ";
        
        $ticket = $mysqli->query($sql_ticket);

        while($user_data = mysqli_fetch_assoc($ticket)){
            $date = $user_data['data_abertura'];
            $data = date_create($date);
            $data_formatada = date_format($data, 'd/m/Y - H:i:s');

            $data_abertura = $data_formatada;
            $status = $user_data['status'];
            $topico = $user_data['topico'];
            $subtopico = $user_data['subtopico'];
            $prioridade = $user_data['prioridade'];
            $titulo =  $user_data['titulo'];
            $empresa = $user_data['empresa'];
            $detalhes = $user_data['detalhes'];
            $username = $user_data['nome'];
    
        }
    ?>
    <div class="container">
        <div class="row justify-content-start d-flex">
            <div class="col-6 justify-content-start d-flex">
                <h3 class=""><b><?php echo "#" . $id_ticket . " — " . $titulo ;?></b></h3>
            </div>
            <div class="col-6 text-end">
                <h3 class=""><b><?php echo "Status: " . $status;?></b></h3>
            </div>
        </div>
        <div class="row row justify-content-start d-flex">
            <div class="col-5 text-start">
                <h3> <?php echo $empresa; ?></h3>
            </div>
            <div class="col-7 justify-content-end d-flex">
                <h3><?php echo "Data de abertura: " . $data_abertura; ?></h3>
            </div>
        </div>
        <div class="row row justify-content-start d-flex" style="margin-top:-15px ;">
            <div class="col-12">
                <hr style="opacity:100%; border: none; height: 4px; background: black; margin-bottom: 35px;"></hr>
            </div>
        </div>
        <div class="row">
            <div class="col-3">

            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-header  cor_resposta_titulo">
                        <div class="row">
                            <div class="col-6">
                                <?php echo $data_formatada; ?>
                            </div>
                            <div class="col-6 text-end">
                                <?php echo $username; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body cor_resposta">
                        <blockquote class="blockquote mb-0">
                            <p class="text-dark"><?php echo $detalhes; ?></p>
                        </blockquote>
                    </div>
                </div>
            </div>

        </div>

        <br>

<?php   
    $sql_comentario = "SELECT * FROM comentario coment
                                JOIN ticket tic
                                ON tic.id_ticket = coment.id_ticket_comentario
                                JOIN usuario user
                                ON user.id_user = coment.id_usuario_comentario
                        WHERE id_ticket = " . " '$id_ticket'";
    $result_comentario = $mysqli->query($sql_comentario);
    $linhas = mysqli_num_rows($result_comentario);

    if($linhas > 0){
        while($user_data = mysqli_fetch_assoc($result_comentario)){
            $date = $user_data['datainsert'];
            $data = date_create($date);
            $data_formatada_comentario = date_format($data, 'd/m/Y - H:i:s');

            $data_abertura_comentario = $data_formatada_comentario;
            $comentario = $user_data['comentario'];
            $username_comentario = $user_data['nome'];

            ?>
                <!-- RESPOSTA DO ADMINISTRADOR! -->
                <div class="row d-flex justify-content-end">
    
                    <div class="col-9 ">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-6 text-start">
                                                <?php echo $username_comentario; ?>
                                            </div>
                                            <div class="col-6 text-end">
                                                <?php echo $data_abertura_comentario; ?>
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="card-body ">
                                        <blockquote class="blockquote mb-0">
                                            <p class="text-dark"><?php echo $comentario; ?></p>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 d-flex">
                    </div>
                </div>
                <br>
            <?php
    
        }
    }else{
        ?>
            <div class="row">
                <div class="col-12">
                    <h4 class="text-start ms-5">Aguarde a resposta!</h4>
                </div>
            </div>
            <br>

        <?php
    }


?>

    </div>
 




</body>
</html>
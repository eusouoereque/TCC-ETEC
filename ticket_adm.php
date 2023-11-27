<?php
    include 'componentes/protect.php';
    if($_SESSION['nivel'] == 2){
        header("Location: index.php");
    }
    if(isset($_SESSION['mensagem'])){
        ?>
        <script>
            setTimeout(function(){
                alert("<?php echo $_SESSION['mensagem'];?>")
            },30);
        </script>
        <?php
    }
    unset($_SESSION['mensagem']);
    
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

         WHERE tic.id_ticket = " . " '$id_ticket'";
        
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
        <a href="meu_ticket.php" >
            <button type="button" class="btn btn-primary mb-2">
                <i class="fas fa-arrow-left"></i>
            </button>
        </a>
        <div class="row justify-content-start d-flex">
            <div class="col-6 justify-content-start d-flex">
                <h3 class=""><b><?php echo "#" . $id_ticket . " — " . $titulo ;?></b></h3>
            </div>
            <div class="col-6 text-end">
                <h3 class=""><b><?php echo "Prioridade: " . $prioridade;?></b></h3>
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
        <div class="row d-flex justify-content-end">
            
            <div class="col-9">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header ">
                                <div class="row">
                                    <div class="col-6 text-start">
                                        <?php echo $username; ?>
                                    </div>  
                                    <div class="col-6 text-end">
                                        <?php echo $data_formatada; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p class="text-dark"><?php echo $detalhes; ?></p>
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
                            <div class="col-3 d-flex">
                            </div>
                            <div class="col-9 ">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header cor_resposta_titulo">
                                                <div class="row">
                                                    <div class="col-6 text-start">
                                                        <?php echo $data_abertura_comentario; ?>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <?php echo $username_comentario; ?>
                                                    </div>   
                                                </div>
                                            </div>
                                            <div class="card-body cor_resposta">
                                                <blockquote class="blockquote mb-0">
                                                    <p class="text-dark"><?php echo $comentario; ?></p>
                                                </blockquote>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    <?php
            
                }
                
            }else{
                ?>
                    <div class="row">
                        <div class="col-12">
                            <h4 class="text-end me-5">Aguardando resposta!</h4>
                        </div>
                    </div>
                    <br>

                <?php
            }


        ?>

        <div class="row row justify-content-start d-flex" style="margin-top:-15px ;">
            <div class="col-12">
                <hr style="opacity:100%; border: none; height: 4px; background: black; margin-bottom: 35px;"></hr>
            </div>
        </div>  

        <!-- <div class="row">
            <div class="col-12">
                <h4>Responda o ticket</h4>
            </div>
        </div> -->

        <div class="row align-items-center ">
            <div class="col-5">
                <form action="action/salvar_comentario.php" method="POST">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Seu comentário" id="resposta" name="resposta" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Deixe seu comentário!</label>
                </div>
                <input type="text" name="id_ticket_comentario" id="id_ticket_comentario" value="<?php echo $id_ticket; ?>" hidden>
            </div>
            <div class="col-1">
                    <button type="submit" value="enviar_resposta" name="enviar_resposta" id="enviar_resposta" class="btn btn-primary ms-2">Enviar</button>
                </form>
                
            </div>
            <div class="col-2">
                    
            </div>
            <div class="col-3">
                <form action="action/alterar_prioridade.php" method="post">
                <div class="form-floating">
                    <select class="form-select" name="prioridade" id="prioridade" required>  
                        <option value="3">Baixa</option>
                        <option value="2">Média</option>
                        <option value="1">Alta</option>
                        <option selected value="4" >Selecione uma opção</option>
                    </select>
                    <label for="floatingSelectGrid">Alterar Prioridade</label>
                </div>
            </div>
            <div class="col-1">
                <input type="text" name="id_ticket_prioridade" id="id_ticket_prioridade" value="<?php echo $id_ticket; ?>" hidden>
                    <button type="submit" value="btnalterarprioridade" name="btnalterarprioridade" id="btnalterarprioridade" class="btn btn-primary">Enviar</button>
                </form>
            </div>

        </div>
        <div class="row mt-3 mb-5">
            <div class="col-6"> <?php
                    if($status == 'Em aguardo'){
                        ?>
                        <div class="d-grid gap-2">
                                <button disabled class="btn btn-dark" name="btnaguardo" id="btnaguardo" type="button">Colocar em Aguardo</button>
                            </div>
                        <?php
                    }else{
                        ?>
                        <form action="action/emaguardo.php" method="post">
                            <input type="text" name="id_ticket_aguardo" id="id_ticket_aguardo" value="<?php echo $id_ticket; ?>" hidden>
                            <input type="text" name="aguardo" id="aguardo" value="1" hidden>
                            <div class="d-grid gap-2">
                                <button class="btn btn-danger" name="btnaguardo" id="btnaguardo" type="submit">Colocar em Aguardo</button>
                            </div>
                        </form>
                    <?php
                    }

                ?>
                
            </div>
            <div class="col-6">
                
                <?php
                    if($status == 'Resolvido'){
                        ?>
                        <div class="d-grid gap-2">
                            <button disabled class="btn btn-dark" name="btnfinalizar" id="btnfinalizar" type="button">Finalizar Ticket</button>
                        </div>
                        <?php
                    }else{
                        ?>
                        <form action="action/finalizar.php" method="post">
                            <input type="text" name="id_ticket_finalizar" id="id_ticket_finalizar" value="<?php echo $id_ticket; ?>" hidden>
                            <input type="text" name="finalizar" id="finalizar" value="2" hidden>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" name="btnfinalizar" id="btnfinalizar" type="submit">Finalizar Ticket</button>
                            </div>
                        </form>
                    <?php
                    }

                ?>

                
            </div>
        </div >
    </div>
    




</body>
</html>
    
<?php
include 'componentes/protect.php';
if (isset($_SESSION['mensagem'])) {
?>
    <script>
        window.onload = function() {
            alert("<?php echo $_SESSION['mensagem']; ?>")
        }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">

    <?php
    include 'componentes/navbar.php';
    ?>
    <div class="container" style="overflow-x:auto;">

        <center>
            <h1 class=""><b><?php if ($_SESSION['nivel'] == 1) {
                                echo "Ver Tickets";
                            } else {
                                echo "Meus Tickets";
                            } ?></b></h1>

            <hr class="hrrrr">
            </hr>
        </center>

        <?php
        $id = $_SESSION['user'];

        $sql = "SELECT *  FROM topico topi
            JOIN ticket tic
            ON topi.id = tic.id_topico_ticket
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

            WHERE us.id_user = " . " '$id' " . "ORDER BY tic.id_ticket DESC";

        $cliente = $mysqli->query($sql);

        $sql = "SELECT *  FROM topico topi
            JOIN ticket tic
            ON topi.id = tic.id_topico_ticket
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

            ORDER BY tic.id_ticket DESC";

        $adm = $mysqli->query($sql);


        ?>

        <?php if ($_SESSION['nivel'] == 2) { ?>
            <div class="">
                <table class="table table-striped" id="table_tickets">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col-1">#</th>
                            <th class="text-center" scope="col-2">Data de Abertura</th>
                            <th class="text-center" scope="col-2">Tópico</th>
                            <th class="text-center" scope="col-2">Subtópico</th>
                            <th class="text-center" scope="col-2">Título</th>
                            <th class="text-center" scope="col-1">Prioridade</th>
                            <th class="text-center" scope="col-1">Status</th>    
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while ($user_data = mysqli_fetch_assoc($cliente)) {
                            $date = $user_data['data_abertura'];
                            $data = date_create($date);
                            $data_formatada = date_format($data, 'd/m/Y - H:i');
                            $status = $user_data['status'];
                        ?>
                            <tr class='clickable text-center' onclick="location.href='ticket.php?id= <?php echo $user_data['id_ticket']; ?>'">
                                <td> <?php echo $user_data['id_ticket']; ?></td>
                                <td> <?php echo $date; ?> </td>
                                <td> <?php echo $user_data['topico']; ?> </td>
                                <td> <?php echo $user_data['subtopico']; ?> </td>
                                <td> <?php echo $user_data['titulo']; ?> </td>
                                <td> <?php echo $user_data['prioridade']; ?> </td>
                                <td class="<?php if($status == 'Resolvido'){echo 'text-success ';}elseif($status == 'Em aguardo'){echo 'text-warning ';}else{echo 'text-danger ';} ?>"><b><?php echo $status; ?></b></td>
                                
                                
                                
                                
                                </a>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        <?php } else { ?>

            <div class="col-12 mb-5">
                <table class="table table-striped" id="table_tickets">

                    <thead>
                        <tr>
                            <th class="text-center" scope="col-1">#</th>
                            <th class="text-center" scope="col-3">Data de Abertura</th>
                            <th class="text-center" scope="col-1">Empresa</th>
                            <th class="text-center" scope="col-2">Tópico</th>
                            <th class="text-center" scope="col-1">Subtópico</th>
                            <th class="text-center" scope="col-1">Título</th>
                            <th class="text-center" scope="col-1">Prioridade</th>
                            <th class="text-center" scope="col-1">Status</th> 
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while ($user_data = mysqli_fetch_assoc($adm)) {
                            $date = $user_data['data_abertura'];
                            $data = date_create($date);
                            $data_formatada = date_format($data, 'd/m/Y - H:i');
                            $status = $user_data['status'];
                            
                        ?>
                            <tr class='clickable text-center' onclick="location.href='ticket_adm.php?id=<?php echo $user_data['id_ticket']; ?>'">
                                <td><?php echo $user_data['id_ticket']; ?></td>
                                <td><span hidden><?php $date; ?></span><?php echo $data_formatada; ?></td>
                                <td><?php echo $user_data['empresa']; ?></td>
                                <td><?php echo $user_data['topico']; ?></td>
                                <td><?php echo $user_data['subtopico']; ?></td>
                                <td><?php echo $user_data['titulo']; ?></td>
                                <td><?php echo $user_data['prioridade']; ?></td>
                                <td class="<?php if($status == 'Resolvido'){echo 'text-success ';}elseif($status == 'Em aguardo'){echo 'text-warning ';}else{echo 'text-danger ';} ?>"><b><?php echo $status; ?></b></td>         
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>
            </div>

        <?php } ?>

    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#table_tickets').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
                },
            });
        });
    </script>

</body>

</html>
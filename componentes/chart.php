<?php 

if(!isset($_SESSION)){
    session_start();
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
    include("./bd/conexao.php");
    $id = $_SESSION['user'];
    //Todos
    $script = "SELECT * FROM ticket WHERE id_usuario = $id" ;

    $query = mysqli_query($mysqli, $script);

    $countTicket = mysqli_num_rows($query);

    //Em aguardo
    $script1 = "SELECT * FROM ticket WHERE id_usuario = $id AND id_status=1" ;

    $query1 = mysqli_query($mysqli, $script1);

    $countTicket1 = mysqli_num_rows($query1);

    //Resolvido
    $script2 = "SELECT * FROM ticket WHERE id_usuario = $id AND id_status=2" ;

    $query2 = mysqli_query($mysqli, $script2);

    $countTicket2 = mysqli_num_rows($query2);

    //Aberto
    $script3 = "SELECT * FROM ticket WHERE id_usuario = $id AND id_status=3" ;

    $query3 = mysqli_query($mysqli, $script3);

    $countTicket3 = mysqli_num_rows($query3);

?>

<script language="javascript">

    //Todos
    var all = "<?php echo $countTicket; ?>";

    var todos = parseInt(all);

    //Em aguardo
    var aguardo = "<?php echo $countTicket1; ?>";

    var emaguardo = parseInt(aguardo);

    //Resolvido
    var pronto = "<?php echo $countTicket2; ?>";

    var resolvido = parseInt(pronto);

    //Aberto
    var open = "<?php echo $countTicket3; ?>";

    var aberto = parseInt(open);
    
</script>
    
</body>
</html>

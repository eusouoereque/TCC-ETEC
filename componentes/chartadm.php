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
$script4 = "SELECT * FROM ticket" ;

$query4 = mysqli_query($mysqli, $script4);

$countTicket4 = mysqli_num_rows($query4);

//Em aguardo
$script5 = "SELECT * FROM ticket WHERE id_status=1" ;

$query5 = mysqli_query($mysqli, $script5);

$countTicket5 = mysqli_num_rows($query5);

//Resolvido
$script6 = "SELECT * FROM ticket WHERE id_status=2" ;

$query6 = mysqli_query($mysqli, $script6);

$countTicket6 = mysqli_num_rows($query6);

//Aberto
$script7 = "SELECT * FROM ticket WHERE id_status=3" ;

$query7 = mysqli_query($mysqli, $script7);

$countTicket7 = mysqli_num_rows($query7);

?>

<script language="javascript">

    //Todos
    var alladm = "<?php echo $countTicket4; ?>";

    var todosadm = parseInt(alladm);

    //Em aguardo
    var aguardoadm = "<?php echo $countTicket5; ?>";

    var emaguardoadm = parseInt(aguardoadm);

    //Resolvido
    var prontoadm = "<?php echo $countTicket6; ?>";

    var resolvidoadm = parseInt(prontoadm);

    //Aberto
    var openadm = "<?php echo $countTicket7; ?>";

    var abertoadm = parseInt(openadm);
</script>
    
</body>
</html>

<?php
include 'componentes/protect.php';
if(isset($_SESSION['mensagem'])){
    ?>
    <script>
        window.onload = function(){
            alert("<?php echo $_SESSION['mensagem'];?>")
        }
    </script>
    <?php
}
 unset($_SESSION['mensagem']);

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/paineldecontrole.css">
</head>

<body style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
    <?php
        include 'bd/conexao.php';
        include 'componentes/navbar.php';  
        include 'componentes/chart.php';
        include 'componentes/chartadm.php';
        include 'componentes/aviso_email.php';
        //https://www.youtube.com/watch?v=vfdw_Z_HSkY
        //https://alertifyjs.com/
    ?>    

    <div class="container">

        <h1 class="sistemaxcor sombrinha"><b><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-git sistemaxcor" viewBox="0 0 16 16">
            <path d="M15.698 7.287 8.712.302a1.03 1.03 0 0 0-1.457 0l-1.45 1.45 1.84 1.84a1.223 1.223 0 0 1 1.55 1.56l1.773 1.774a1.224 1.224 0 0 1 1.267 2.025 1.226 1.226 0 0 1-2.002-1.334L8.58 5.963v4.353a1.226 1.226 0 1 1-1.008-.036V5.887a1.226 1.226 0 0 1-.666-1.608L5.093 2.465l-4.79 4.79a1.03 1.03 0 0 0 0 1.457l6.986 6.986a1.03 1.03 0 0 0 1.457 0l6.953-6.953a1.031 1.031 0 0 0 0-1.457"/>
        </svg> Painel de controle</b></h1>

        <?php
            if($_SESSION['nivel'] == 1){
        ?>
        <div class="row mt-5">

                <!-- PC ------------------------------------------->
            <div class="col-3 pc">
                <h3 class="fonte3" >Enviados</h3>
    
                <h3 class="risquinhe fonte3 fs-2"><?php echo '<br>' . $countTicket ?></a></h3>

            </div>
                
            <div class="col-3 pc">
                <h3 class="fonte3">Abertos</h3>

                <h3 class="risquinhe fonte3 fs-2"><?php echo '<br>' . $countTicket3 ?></h3>

            </div>


            <div class="col-3 pc">
                <h3 class="fonte3">Em aguardo</h3>

                <h3 class="risquinhe fonte3 fs-2"><?php echo '<br>' . $countTicket1 ?></h3>

            </div>

            <div class="col-3 pc">
                <h3 class="fonte3">Resolvidos</h3>

                <h3 class="risquinhe fonte3 fs-2"><?php echo '<br>' . $countTicket2 ?></h3>

            </div>

            <!-- laptop ------------------------------------------->
            <div class="col-3 laptop">
                <h3 class="fonte3" >Enviados</h3>
    
                <h3 class="risquinhe  fonte3 fs-2"><?php echo '<br>' . $countTicket ?></a></h3>

            </div>
                
            <div class="col-3 laptop">
                <h3 class="fonte3">Abertos</h3>

                <h3 class="risquinhe  fonte3 fs-2"><?php echo '<br>' . $countTicket3 ?></h3>

            </div>


            <div class="col-3 laptop">
                <h3 class=" fonte3">Aguardo</h3>

                <h3 class="risquinhe  fonte3 fs-2"><?php echo '<br>' . $countTicket1 ?></h3>

            </div>

            <div class="col-3 laptop">
                <h3 class="fonte3">Resolvidos</h3>

                <h3 class="risquinhe  fonte3 fs-2"><?php echo '<br>' . $countTicket2 ?></h3>

            </div>

            <!-- tablet ------------------------------------------->
            <div class="col-3 tablet">
                <h3 class="fonte3" >Enviados</h3>
    
                <h3 class="risquinhe  fonte3 fs-2"><?php echo '<br>' . $countTicket ?></a></h3>

            </div>
                
            <div class="col-3 tablet">
                <h3 class="fonte3">Abertos</h3>

                <h3 class="risquinhe  fonte3 fs-2"><?php echo '<br>' . $countTicket3 ?></h3>

            </div>


            <div class="col-3 tablet">
                <h3 class="fonte3 ">Aguardo</h3>

                <h3 class="risquinhe  fonte3 fs-2"><?php echo '<br>' . $countTicket1 ?></h3>

            </div>

            <div class="col-3 tablet">
                <h3 class="fonte3">Resolvidos</h3>

                <h3 class="risquinhe  fonte3 fs-2"><?php echo '<br>' . $countTicket2 ?></h3>

            </div>

            <!-- celular ------------------------------------------->
            <div class="col-3 celular">
                <h3 class="fonte3" >Enviados</h3>
    
                <h3 class="risquinhe fonte3  fs-2"><?php echo '<br>' . $countTicket ?></a></h3>

            </div>
                
            <div class="col-3 celular">
                <h3 class="">Abertos</h3>

                <h3 class="risquinhe fonte3  fs-2"><?php echo '<br>' . $countTicket3 ?></h3>

            </div>


            <div class="col-3 celular">
                <h3 class=" ">Aguardo</h3>

                <h3 class="risquinhe fonte3  fs-2"><?php echo '<br>' . $countTicket1 ?></h3>

            </div>

            <div class="col-3 celular">
                <h3 class="">Resolvidos</h3>

                <h3 class="risquinhe fonte3  fs-2"><?php echo '<br>' . $countTicket2 ?></h3>

            </div>

                <!-- celularmedio ------------------------------------------->
            <div class="col-6 celularmedio">
                <h3 class="fonte3" >Enviados</h3>
    
                <h3 class="risquinhe fonte3  fs-2"><?php echo '<br>' . $countTicket ?></a></h3>

                <h3 class="fonte3">Abertos</h3>

                <h3 class="risquinhe fonte3  fs-2"><?php echo '<br>' . $countTicket3 ?></h3>

            </div>


            <div class="col-6 celularmedio mb-5">
                <h3 class="fonte3 ">Aguardo</h3>

                <h3 class="risquinhe fonte3  fs-2"><?php echo '<br>' . $countTicket1 ?></h3>

                <h3 class="fonte3">Resolvidos</h3>

                <h3 class="risquinhe fonte3  fs-2"><?php echo '<br>' . $countTicket2 ?></h3>

            </div>

            <!-- celularpequeno ------------------------------------------->
            <div class="col-6 celularpequeno">
                <h3 class="fonte3" >Enviados</h3>
    
                <h3 class="risquinhe fonte3  fs-2"><?php echo '<br>' . $countTicket ?></a></h3>

                <h3 class="fonte3">Abertos</h3>

                <h3 class="risquinhe fonte3  fs-2"><?php echo '<br>' . $countTicket3 ?></h3>

            </div>


            <div class="col-6 celularpequeno mb-5">
                <h3 class="fonte3 ">Aguardo</h3>

                <h3 class="risquinhe fonte3  fs-2"><?php echo '<br>' . $countTicket1 ?></h3>

                <h3 class="fonte3">Resolvidos</h3>

                <h3 class="risquinhe fonte3  fs-2"><?php echo '<br>' . $countTicket2 ?></h3>

            </div>

        </div>

        <h1 class="sistemaxcor sombrinha padrao ms-4" style="margin-top: 3%"><b>Atendimentos</b></h1>

        <h1 class="sistemaxcor sombrinha celularpequeno ms-3" style="margin-top: 3%"><b>Atendimentos</b></h1>

        <div class="row mt-5 d-flex justify-content-center">


                            <!-- PC -->
                <div class="col-3 text-start  margemcima ms-5 pc">
                    <h3 class="margembaixo "><b class="cor1"><?php echo $countTicket6 ?></b> Resolvidos</h3>

                    <h3 class=""><b class="cor2"><?php echo $countTicket5 ?></b> Em aguardo</h3>
                </div>

                <div class="col-3 margemcima text-start ms-5 pc">
                    <h3 class="  margembaixo"><b class="cor3"><?php echo $countTicket7 ?></b> Abertos</h3>

                    <h3 class=""><b class="cor4"><?php echo $countTicket4 ?></b> Todos</h3>
                </div>

                            <!-- laptop -->
                <div class="col-3 text-start  margemcima ms-2 laptop">
                    <h3 class="margembaixo "><b class="cor1"><?php echo $countTicket6 ?></b> Resolvidos</h3>

                    <h3 class=""><b class="cor2"><?php echo $countTicket5 ?></b> Em aguardo</h3>
                </div>

                <div class="col-3 margemcima text-start ms-5 laptop">
                    <h3 class="  margembaixo"><b class="cor3"><?php echo $countTicket7 ?></b> Abertos</h3>

                    <h3 class=""><b class="cor4"><?php echo $countTicket4 ?></b> Todos</h3>
                </div>

                            <!-- tablet -->
                <div class="col-4 text-start  margemcima ms-5 mb-3 tablet">
                    <h3 class="margembaixo "><b class="cor1"><?php echo $countTicket6 ?></b> Resolvidos</h3>

                    <h3 class=""><b class="cor2"><?php echo $countTicket5 ?></b> Em aguardo</h3>
                </div>

                <div class="col-4 margemcima text-start ms-5 mb-3 tablet">
                    <h3 class="  margembaixo"><b class="cor3"><?php echo $countTicket7 ?></b> Abertos</h3>

                    <h3 class=""><b class="cor4"><?php echo $countTicket4 ?></b> Todos</h3>
                </div>

                            <!-- celular -->
                <div class="col-5 text-start  margemcima ms-5 mb-3 celular">
                    <h3 class="margembaixo "><b class="cor1"><?php echo $countTicket6 ?></b> Resolvidos</h3>

                    <h3 class=""><b class="cor2"><?php echo $countTicket5 ?></b> Em aguardo</h3>
                </div>

                <div class="col-5 margemcima text-start ms-3 mb-3 celular">
                    <h3 class="  margembaixo"><b class="cor3"><?php echo $countTicket7 ?></b> Abertos</h3>

                    <h3 class=""><b class="cor4"><?php echo $countTicket4 ?></b> Todos</h3>
                </div>

                <!-- celular medio -->
                <div class="col-6 text-start  margemcima ms-4 mb-4 celularmedio">
                    <h3 class="margembaixo "><b class="cor1"><?php echo $countTicket6 ?></b> Resolvidos</h3>

                    <h3 class=""><b class="cor2"><?php echo $countTicket5 ?></b> Em aguardo</h3>
                </div>

                <div class="col-5 margemcima text-start mb-3 celularmedio">
                    <h3 class=" " style="margin-bottom: 26px;"><b class="cor3"><?php echo $countTicket7 ?></b> Abertos</h3>

                    <h3 class=""><b class="cor4"><?php echo $countTicket4 ?></b> Todos</h3>
                </div>

                <!-- celular pequeno -->
                <div class="col-6 text-start  margemcima ms-4 mb-3 celularpequeno">
                    <h3 class="margembaixo "><b class="cor1"><?php echo $countTicket6 ?></b> Resolvidos</h3>

                    <h3 class=""><b class="cor2"><?php echo $countTicket5 ?></b> Em aguardo</h3>
                </div>

                <div class="col-5 margemcima text-start mb-3 celularpequeno">
                    <h3 class=" " style="margin-bottom: 26px;"><b class="cor3"><?php echo $countTicket7 ?></b> Abertos</h3>

                    <h3 class=""><b class="cor4"><?php echo $countTicket4 ?></b> Todos</h3>
                </div>

            




        
        <div class="col-5 margemcimaneg tabletgraf">
        <?php
            include 'componentes/grafico.php';
        ?>
        </div>
        </div>
        <?php
        }else{
        ?>
        
        <div class="row mt-4">

            <div class="col-3">
                <h3> Enviados</h3>

                <h3 class="risquinhe1"><b><?php echo '<br>' . $countTicket ?></b></a></h3>

            </div>

            <div class="col-3">
                <h3> Abertos</h3>

                <h3 class="risquinhe3"><b><?php echo '<br>' . $countTicket3 ?></b></h3>

            </div>

            <div class="col-3">
                <h3> Em análise</h3>

                <h3 class="risquinhe4"><b><?php echo '<br>' . $countTicket1 ?></b></h3>

            </div>

            <div class="col-3">
                <h3> Resolvidos</h3>

                <h3 class="risquinhe2"><b><?php echo '<br>' . $countTicket2 ?></b></h3>

            </div>

        </div>

        <?php
            include 'componentes/graficobarra.php';
        }
        ?>
    </div>
            
        

</body>
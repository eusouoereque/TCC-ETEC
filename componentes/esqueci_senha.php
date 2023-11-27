<?php
include '../bd/conexao.php';

if (!isset($_SESSION)) {
    session_start();
}
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
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./imagens/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/enviar-cliente.css">
    <title>Document</title>
</head>

<body style="background-color: #012986;">

    <div class="container" style="background-color: #012986;">

        <!-- <div class="row d-flex justify-content-center">
            <div class="col-6 text-center">
                <form method="post" action="../action/busca_email.php">
                    <label class="fs-3 fonte3"><b>Insira seu email</b></label>
                    <input type="text" maxlength="265" name="emailSenha" id="emailSenha" class="caixinhanav mb-4" placeholder="E-mail" required>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-2">
                <button class="btn btn-danger" name="btnEmail" id="btnEmail" type="submit">Enviar Email</button>
                </form>
            </div>
        </div> -->
        <div class="row d-flex justify-content-center" style="margin-top: 20%;">
            <div class="col-5">
                <div class="card text-center">
                    <div class="card-header">
                        Recupere sua senha!
                    </div>
                    <div class="card-body">
                        <form method="post" action="../action/busca_email.php">
                            <div class="row d-flex justify-content-center mb-3">
                                <div class="col-10">
                                    <div class="form-floating">
                                        <input type="email" name="emailSenha" class="form-control" id="emailSenha" placeholder="E-mail">
                                        <label for="floatingInputGrid">Digite seu e-mail</label>
                                    </div>
                                </div>
                            </div>

                            
                    </div>
                    <div class="card-footer text-muted">
                            <button class="btn btn-primary" name="btnEmail" id="btnEmail" type="submit">Enviar Email</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>



    </div>

</body>

</html>
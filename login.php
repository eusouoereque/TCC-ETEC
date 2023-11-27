<?php
    include_once "bd/conexao.php";
    if (!isset($_SESSION)) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./imagens/favicon.ico" type="image/x-icon">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
    <div class="tudo">
    <center>
        <div class="imagem">
            <img src="imagens/logo_sistemax_branco.png" alt="logo">
        </div>
    </center>
    <div class="container">
        <h1>LOGIN</h1>
        <div class="form">
            <form action="" method="POST">
         
                <table  width="250px" style="border-collapse: collapse;">
                    <tr>
                        <td><input type="text" id="nome" name="txtNome" maxlength="40" placeholder="NOME DE USUÁRIO" size="25" required></td>
                    </tr>
                    <tr>
                        <td><input type="password" id="senha" name="txtSenha" placeholder="SENHA" size="14" required></td>
                    </tr>
                </table>
                <?php

                    if (isset($_POST['txtNome']) & isset($_POST['txtSenha'])) {
    
                        $nome = $mysqli->real_escape_string($_POST['txtNome']);
                        $senha = $mysqli->real_escape_string($_POST['txtSenha']);

                        $sql_code = "SELECT * FROM usuario WHERE nome = '$nome' AND senha = '$senha' AND ativo_user = 1";

                        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do codigo SQL: " . $mysqli->error);

                        $quantidade = $sql_query->num_rows;

                        if($quantidade == 1){
                            $usuario = $sql_query->fetch_assoc();

                            if (!isset($_SESSION)) {
                                session_start();
                            }

                            $_SESSION['user'] = $usuario['id_user'];
                            $_SESSION['nome'] = $usuario['nome'];
                            $_SESSION['empresa'] = $usuario['id_empresa_usuario'];
                            $_SESSION['nivel'] = $usuario['id_nivel'];

                            header("Location: index.php");

                        }else {
                            ?>
                            <p style="font-size: 1rem ; margin-top: 10px; margin-bottom: -10px; color:red;" >Usuario ou senha incorretos!</p>
                            <?php
                        }
                    }
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
                <div class="baixo">
                    <p><a href="componentes/esqueci_senha.php"><b>ESQUECI MINHA SENHA</b></a></p>
                
                    <button type="submit">ENTRAR</button>

                </div>
            </form>
        </div>
    </div>
    </div>
</body>
</html>
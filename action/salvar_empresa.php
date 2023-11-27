<?php
include_once "../bd/conexao.php";
include_once "../componentes/protect.php";

$cnpj = mysqli_escape_string($mysqli, $_POST['cnpjNav']);

    if(is_numeric($cnpj)){

        if (isset($_POST['enviar_empresa'])) {
            $empresa = mysqli_escape_string($mysqli, $_POST['empresaNav']);
            $razaoSocial = mysqli_escape_string($mysqli, $_POST['razaoSocialNav']);
            $ativo = 1;

            $sql_empresa = "INSERT INTO empresa
                    (razao_social, empresa, cnpj, ativo, data) VALUES
                    ('$razaoSocial', '$empresa', '$cnpj' , $ativo, now())";
        
            if ($mysqli->query($sql_empresa)) {
                $_SESSION['mensagem'] = "Cadastrado com sucesso!";
                header("Location: ../empresas.php");
            } else {
                $_SESSION['mensagem'] = "Erro ao cadastrar!";
                header("Location: ../empresas.php");
            }
        }else{
            $_SESSION['mensagem'] = "Erro ao cadastrar!";
            header("Location: ../empresas.php");
        }
        
    }else{
        $_SESSION['mensagem'] = "Erro ao cadastrar!";
        header("Location: ../empresas.php");
    }



<?php
header('Content-Type:text/html;charset=UTF-8');

require_once('../componentes/PHPMailer/PHPMailer.php');
require_once('../componentes/PHPMailer/SMTP.php');
require_once('../componentes/PHPMailer/Exception.php');

include '../bd/conexao.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$email = $_GET['email'];

$senha = $_GET['senha'];

try {
	//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->isSMTP();
	$mail->CharSet = 'UTF-8';
	$mail->Host = 'smtp.titan.email';
	$mail->SMTPAuth = true;
	$mail->Username = 'nao-responder@sistemaxsistemas.com.br';
	$mail->Password = '123@senha';
	$mail->Port = 587;

	//email que vai enviar
	$mail->setFrom('nao-responder@sistemaxsistemas.com.br');

	//email que vai receber
	$mail->addAddress($email);

	//caso queira enviar algum anexo
	//$mail->addAttachment('arquivo', 'nome do arquivo');

	$mail->isHTML(true);
	$mail->Subject = 'Atenção. Não responda a este e-mail.';
	$mail->Body = "Sua senha é $senha";
	$mail->AltBody = 'Email da Sistemax Sistemas';

	if ($mail->send()) {
		echo 'Email enviado com sucesso';
	} else {
		echo 'Email nao enviado';
	}
} catch (Exception $e) {
	echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}

session_start();
    $_SESSION['mensagem'] = "Sua senha foi enviada ao seu email!";
header("Location: ../login.php");

?>
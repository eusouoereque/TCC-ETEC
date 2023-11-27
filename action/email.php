<?php
header('Content-Type:text/html;charset=UTF-8');

require_once('../componentes/PHPMailer/PHPMailer.php');
require_once('../componentes/PHPMailer/SMTP.php');
require_once('../componentes/PHPMailer/Exception.php');

include_once 'email_usuario.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$id_ticket = $_GET['id'];

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
	$mail->addAddress($email_enviar);

	//caso queira enviar algum anexo
	//$mail->addAttachment('arquivo', 'nome do arquivo');

	$mail->isHTML(true);
	$mail->Subject = 'Atenção. Não responda a este e-mail.';
	$mail->Body = "Parabéns $username! Seu Ticket foi respondido e finalizado.<br>
	Entre em nosso site, <a href='https://sistemaxsistemas.com.br/ticket/'>https://sistemaxsistemas.com.br/ticket/</a>, para que possa ver a resposta do seu chamado.<br>
	Caso ainda haja problemas, entre em contato conosco por meio do WhatsApp 19 99621-8110 e espere até que seja atendido.<br><br>
	Muito obrigado!<br><br>
	Contato:<br>
	Instagram: instagram.com/sistemax_sistemas<br>
	Facebook: facebook.com/sistemaxsistemas";
	$mail->AltBody = 'Email da Sistemax Sistemas';

	if ($mail->send()) {
		echo 'Email enviado com sucesso';
	} else {
		echo 'Email nao enviado';
	}
} catch (Exception $e) {
	echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}

header("Location: ../meu_ticket.php");

?>
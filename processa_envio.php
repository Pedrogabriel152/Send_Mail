<?php  

	require "./bibliotecas/PHPMailer/Exception.php";
	require "./bibliotecas/PHPMailer/OAuth.php";
	require "./bibliotecas/PHPMailer/PHPMailer.php";
	require "./bibliotecas/PHPMailer/POP3.php";
	require "./bibliotecas/PHPMailer/SMTp.php";

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	class Menssagem
	{
		private $para = null;
		private $assunto = null;
		private $mensagem = null;
		public $status = array('codigo_status' => null, 'descricao_status' => '');

		public function __get($atrr)
		{
			return $this->$atrr;
		}
     
		public function __set($atrr,$value)
		{
			$this->$atrr = $value;
		}

		public function mensagemValida()
		{
			if(empty($this->para) || empty($this->mensagem) || empty($assunto))
			{
				return false;
			}
		}
	}

	$mensagem = new Menssagem();

	$mensagem->__set('para',$_POST['para']);
	$mensagem->__set('assunto', $_POST['assunto']);
	$mensagem->__set('mensagem',$_POST['menssagem']);

	if(!$mensagem->mensagemValida())
	{
		echo 'Mensagem não é válida';
		header('Location: index.php');
	}

	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug = false;                      //Enable verbose debug output
	    $mail->isSMTP();                                            //Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	    $mail->Username   = 'DIGITE AQUI SEU E-mail';                     //SMTP username
	    $mail->Password   = 'DIGITE AQUI A SENHA DO SEU E-MAIL';                               //SMTP password
	    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
	    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	    //Recipients
	    $mail->setFrom('from@example.com', 'Mailer');
	    $mail->addAddress($mensagem->__get('para'));     //Add a recipient          //Name is optional
	    // $mail->addReplyTo('', 'Information');
	    // $mail->addCC('cc@example.com');
	    // $mail->addBCC('bcc@example.com');

	    //Attachments
	    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
	    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

	    //Content
	    $mail->isHTML(true);                                  //Set email format to HTML
	    $mail->Subject = $mensagem->__get('assunto');
	    $mail->Body    = $mensagem->__get('mensagem');
	    $mail->AltBody = 'É necessário ultilizar um client que suporte HTML';

	    $mail->send();

	    $mensagem->status['codigo_status'] = 1;
	    $mensagem->status['descricao_status'] = 'E-mail enviado com sucesso'

	} catch (Exception $e) {
		$mensagem->status['codigo_status'] = 2;
	    $mensagem->status['descricao_status'] = "Não foi possivel enviar este e-mail! Por favor tente novamente mais tarde.\nDetalhes do Error: {$mail->ErrorInfo}: "
	}

?>
<html>
	<head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>

    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	</head>

	<body>

		<div class="container">
			<div class="py-3 text-center">
				<img class="d-bblock mx-auto mb-2" src="imagem/logo.png">
				<h2>Send Mail</h2>
				<p class="lead">Seu app de envio de e-mails particular</p>
			</div>

			<div class="row">
				<div class="col-md-12">
					
					<?php if ($mensagem->status['codigo_status'] == 1) { ?>

						<div class=" container">
							<h1 class="display-4 text-seccess">Sucesso</h1>
							<p><?= $mensagem->status['descricao_status'] ?></p>
							<a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
						</div>

					<?php } ?>

					<?php if ($mensagem->status['codigo_status'] == 2) { ?>

						<div class=" container">
							<h1 class="display-4 text-danger">Ops!</h1>
							<p><?= $mensagem->status['descricao_status'] ?></p>
							<a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
						</div>


					<?php } ?>

				</div>
			</div>
		</div>

	</body>
</html>
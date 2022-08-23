<?php  

	require "./bibliotecas/PHPMailer/Exception.php";
	require "./bibliotecas/PHPMailer/OAuth.php";
	require "./bibliotecas/PHPMailer/PHPMailer.php";
	require "./bibliotecas/PHPMailer/POP3.php";
	require "./bibliotecas/PHPMailer/SMTp.php";

	class Menssagem
	{
		private $para = null;
		private $assunto = null;
		private $mensagem = null;

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

	if($mensagem->mensagemValida())
	{
		echo 'Mensagem é válida';
	} else {
		echo 'Mensagem não é válida';
	}

?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include('conecta.php');
  // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
  if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
      header("Location: index.php"); exit;
  }

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$query= "SELECT `id`, `nome`, `nivel`,`senha`, `usuario` FROM `usuarios` WHERE (`usuario` = '".$usuario ."') AND (`senha` = '". sha1($senha) ."') AND (`ativo` = 1) LIMIT 1;";
	if ($stmt = $con-> prepare($query)) {
				    $stmt->execute();
				    $stmt->bind_result($DbID, $DbNome, $DbNivel, $Dbsenha, $Dbusuario);
				    $stmt->fetch();
				   			    
				    if ($usuario!=$Dbusuario || sha1($senha)!=$Dbsenha){
				    	 echo "<script>history.back();</script>";
				    }else{
				       
				       // Se a sessão não existir, inicia uma
					   if (!isset($_SESSION)) session_start();
					
					      // Salva os dados encontrados na sessão
					      $_SESSION['UsuarioID'] = $DbID;
					      $_SESSION['UsuarioNome'] = $DbNome;
					      $_SESSION['UsuarioNivel'] = $DbNivel;
					
					      // Redireciona o visitante
					      header("Location: logado.php"); exit;
					}
	}



  ?><?php $con->close();?>
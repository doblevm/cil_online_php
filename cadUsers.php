<?php 
$host="10.24.12.81";
$port=3306;
$socket="";
$user="eduardo";
$password="100senha";
$dbname="Horimetros";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="pt-br" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
<style type="text/css">
.Titulo {
	text-align: center;
	font-family: Tahoma;
	color: #FFFFFF;
	text-align: center;
	font-size: 48px;
	}



.SubTitulo {
	text-align: center;
	font-family: Tahoma;
	color: #FFFFFF;
	text-align: center;
	font-size: 16px;
	line-height: 150%;

}



.Conteudo {
	text-align: center;
	font-family: "Tahoma";
	color: #FFFFFF;
	text-align: center;
	font-size: 15px;
	line-height: 150%;
}
.Conteudo {
	text-align: center;
	font-family: Tahoma;
	color: #ffffff;
	text-align: center;
	font-size: 15px;
	line-height: 150%;
}
.subConteudo{
	text-align: center;
	font-family: Tahoma;
	color: #000000;
	text-align: center;
	font-size: 8px;
	
}
.auto-style1 {
	text-align: center;
}
.auto-style2 {
	text-align: center;
	font-family: Tahoma;
	color: #ffffff;
	font-size: 15px;
	line-height: 150%;
}
.auto-style3 {
	text-align: left;
}
.auto-style4 {
	text-align: left;
	font-family: Tahoma;
	color: #ffffff;
	font-size: 15px;
	line-height: 150%;
}
</style>
</head>
<?php
//inclui cabeçalho padrao da pagina com menu
 include('topo.php'); 
	if(isset($_POST["btEnv"])){  
						if(empty($_POST["txNome"]))
							$erro = "Digite o nome";
						else
						if(empty($_POST["nuNivel"]))
							$erro = "Selecione o Nivel de Acesso";
						else
						if(empty($_POST["nuUser"]))
							$erro = "Digite o ID!";
						else
						if(empty($_POST["txSenha"]))
							$erro = "Digite a Senha!";
						else
						{
						
						//Vamos realizar o cadastro ou alteração dos dados enviados.
					
							  	$txNome=$_POST["txNome"];
								$nuNivel=$_POST["nuNivel"];
								$nuUser=$_POST["nuUser"];
								$txSenha=SHA1($_POST["txSenha"]);
								
								$query = " INSERT INTO `Horimetros`.`usuarios` (`nome`, `usuario`, `senha`, `nivel`, `ativo`, `cadastro`) VALUES('".$txNome."', '".$nuUser."', '".$txSenha."', ".$nuNivel.", 1, now());";
				
									if ($stmt = $con->prepare($query)) {
									    $stmt->execute();
									    $stmt->close();
									    $sucesso = "Usuario cadastrados com sucesso!";
									}
						}
			}
				  
			
?>

<body style="background-color: #222E34;">


<form method="post" action="<?php $_SERVER["PHP_SELF"]?>">
<table style="width: 55%; height: 41px;" align="center">
	<tr>
		<td colspan="2" class="auto-style3" style="height: 33px">
		<p class="Titulo">Cadastrar Usuarios</p>
		</td>
	</tr>
	<tr>
		<td style="width: 231px; height: 45px;" class="auto-style2">
			

			Nome:<br />
			<input name="txNome" type="text" size="45" style="width: 130px; background : #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px;"" /><br />
		</td>
		<td style="width: 319px; height: 45px;" class="auto-style4">	
		Nivel Acesso<br>
			<select name="nuNivel" id="nuNivel" style="background : #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px;">
			<option selected="selected" value="0" >Selecione</option>
			<option value="2">Supervisor</option>
			</select></td>
	</tr>
	<tr>
		<td style="width: 231px; height: 20px;" class="auto-style2">
		</td>
		<td style="width: 319px; height: 20px;" class="auto-style4">
		</td>
	</tr>
	<tr>
		<td style="width: 231px" class="auto-style2">
			
		ID:<br />
			<input name="nuUser" type="text" size="45" style="width: 130px; background : #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px;" /></td>
		<td style="width: 319px" class="auto-style4">
			Senha<br>
			<input name="txSenha" type="text" size="45" style="width: 130px; background : #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px;" /></td>
	</tr>
	<tr>
		<td style="width: 231px; height: 23px;" class="auto-style1">
		</td>
		<td style="width: 319px; height: 23px;" class="auto-style3">
		
		<?php
		// Validação dos Dados do formulario
		if(isset($erro))
			echo '<div style="color:#F00">'.$erro.'</div><br/><br/>';
		else
		if(isset($sucesso))
			echo '<div style="color:#00f">'.$sucesso.'</div><br/><br/>';
		 
		?>
		
      <input name="btEnv" id="btEnv" type="submit" value="Salvar" style="background: #FFC72B; border-color:#43494B; border-radius: 5px 5px 5px 5px; height: 28px; width: 105px;"/>&nbsp;&nbsp;</td>
	</tr>
	</table>
</form>
</body>

</html>
<?php $con->close();?>
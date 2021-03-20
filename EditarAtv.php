<?php 
include('../conecta.php');
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="pt-br" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

<style type="text/css">
.Titulo {
	text-align: left;
	font-family: Verdana, Geneva, Tahoma, sans-serif;
	color: #FFFFFF;
	text-align: left;
	font-size: 48px;
	}



.SubTitulo {
	text-align: center;
	font-family: Cambria, Geneva, Tahoma, sans-serif;
	color: #FFFFFF;
	text-align: center;
	font-size: 20px;
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
.auto-style1 {
	font-size: small;
}
.auto-style3 {
	border-width: 0px;
}
.auto-style9 {
	text-align: center;
	border-style: none;
	border-width: medium;
	font-family: Cambria, Geneva, Tahoma, sans-serif;
	color: #FFFFFF;
	text-align: center;
	font-size: 20px;
	line-height: 150%;
}
.auto-style13 {
	border-style: none;
	border-width: medium;
}
</style>
</head>
<?php
 $id=$_GET['id'];
			$query = "SELECT txAtividade, Periodicidade, HorimetroAlerta,HorimetroUltima, procedimento, Maquina, tbAtividades.Categoria, CatAtividades.Categoria FROM tbAtividades right join CatAtividades on CatAtividades.id=tbAtividades.Categoria inner join tbMaquinas using(idMaquina) where(idAtividade=".$id.");";
			if ($stmt = $con-> prepare($query)) {
			    $stmt->execute();
			    $stmt->bind_result($txAtividade, $Periodicidade, $HorimetroAlerta, $HorimetroUltima, $procedimento, $Maquina, $idCategoria, $Categoria);		      	        
			     $stmt->fetch();

				}
			   $stmt->close();
			   
?>

<body style="background-color: #222E34;">

<form method="post" enctype="multipart/form-data" action="<?php $_SERVER["PHP_SELF"]?>">
	<br><br>
	<br><br><br><br>
	<table  style="width: 52%; height: 450px; left: 0%; margin-left: 0px; position: relative; top: -75px;" class="auto-style3">
	<tr>
		<td colspan="2" style="height: 33px" class="auto-style13">
		<p class="Titulo">Alterar atividade</p>
		<p >&nbsp;</p>
		</td>
	</tr>
	<tr>
		<td style="width: 279px; height: 45px;" class="auto-style9">
			

			Maquina:<br /><span class="Conteudo"><?php echo $Maquina;?>
			<br /></span>
		</td>
		<td style="width: 319px; height: 45px;" class="auto-style9">
		Descrição da Atividade:<br />
			<input style="background: #43494B; border-color:#CECECE;border-radius: 5px 5px 5px 5px; height: 25px; width: 465px;" name="txAtividade" type="text" size="100"  tabindex="2" value="<?php echo $txAtividade; ?>"/></td>
	</tr>
	<tr>
		<td style="width: 279px" class="auto-style9">
			
		Periodicidade Horas:<br />
			<input style="background: #43494B; border-color:#CECECE;border-radius: 5px 5px 5px 5px; height: 25px;" name="nuPeriodicidade" type="text" size="45" style="width: 130px" tabindex="3" value="<?php echo $Periodicidade; ?>" /></td>
		<td style="width: 319px" class="auto-style9">
		tipo de atividade<br>
			<select name="nuTipo" id="nuTipo" tabindex="4" style="background: #43494B; border-color:#CECECE;border-radius: 5px 5px 5px 5px; height: 25px;">
			<option selected="" value="<?php echo $idCategoria; ?>"><?php echo $Categoria; ?></option>
<?php
			//query para encher o drop down
			$query = "SELECT `CatAtividades`.`id`, `CatAtividades`.`Categoria` FROM `Horimetros`.`CatAtividades`;";
		
		
			if ($stmt = $con-> prepare($query)) {
			    $stmt->execute();
			    $stmt->bind_result($idCategoria, $CatAtividades);
			    while ($stmt->fetch()) 
			    echo '<option value="'.$idCategoria.'">'.$CatAtividades.'</option>';
			      	        
			    }
			   $stmt->close();
			   
			////query para gravar na base 
			
			if(isset($_POST["btEnv"])){
						if(empty($_POST["txAtividade"]))
							$erro = "Descrição da atividade é obrigatório";
						else
						if(empty($_POST["nuPeriodicidade"]))
							$erro = "Qual a periodicidade em Horas?";
						else
						if(empty($_POST["nuAlerta"]))
							$erro = "Avisar quantas Horas antes do vencimento?";
						else
						if(empty($_POST["nuHorimetroUltima"]))
							$erro = "Qual o Horimetro da ultima ordem executada? <br> Se não tem insira o Horimetro atual";
						else
						if(empty($_POST["nuTipo"]))
							$erro = "Selecione o tipo da Atividade!";
						else{
								
							  	$nuCategoria=$_POST["nuTipo"];
								$txAtividade=$_POST["txAtividade"];
								$nuPeriodicidade=$_POST["nuPeriodicidade"];
								$nuAlerta=$_POST["nuAlerta"];
								$nuHorimetroUltima=$_POST["nuHorimetroUltima"];
								
								$nuProxima=$nuHorimetroUltima+$nuPeriodicidade;
								
							if(isset($_FILES['txProcedimento']['name']) && $_FILES["txProcedimento"]["error"] == 0)
								{
								/*
									echo "Você enviou o arquivo: <strong>" . $_FILES['arquivo']['name'] . "</strong><br />";
									echo "Este arquivo é do tipo: <strong>" . $_FILES['arquivo']['type'] . "</strong><br />";
									echo "Temporáriamente foi salvo em: <strong>" . $_FILES['arquivo']['tmp_name'] . "</strong><br />";
									echo "Seu tamanho é: <strong>" . $_FILES['arquivo']['size'] . "</strong> Bytes<br /><br />";
								*/
									$arquivo_tmp = $_FILES['txProcedimento']['tmp_name'];
									$nome = $_FILES['txProcedimento']['name'];
									
								
									// Pega a extensao
									$extensao = strrchr($nome, '.');
								
									// Converte a extensao para mimusculo
									$extensao = strtolower($extensao);
								
									// Somente imagens, .jpg;.jpeg;.gif;.png
									// Aqui eu enfilero as extesões permitidas e separo por ';'
									// Isso server apenas para eu poder pesquisar dentro desta String
									if(strstr('.pdf', $extensao))
									{
										// Cria um nome único para esta imagem
										// Evita que duplique as imagens no servidor.
										$novoNome = md5(microtime()) . $extensao;
										
										// Concatena a pasta com o nome
										$destino = '../Procedimentos/' . $novoNome; 
										
										// tenta mover o arquivo para o destino
										if( @move_uploaded_file( $arquivo_tmp, $destino  ))
										{
											echo "Arquivo salvo com sucesso em : <strong>" . $destino . "</strong><br />";
											//echo "<img src=\"" . $destino . "\" />";
											$txProcedimento=$novoNome;
											unlink('../Procedimentos/' .$procedimento);
										}
										else
											$erro ="Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";
									}
									else
										$erro ="Você poderá enviar apenas arquivos \"*.pdf\"<br />";
								}
								else
								{
									//$erro ="Você não enviou nenhum arquivo!";
								}

						{
						
						//Vamos realizar o cadastro ou alteração dos dados enviados.
					
							  	$txProcedimento=$novoNome;
								$query="UPDATE `Horimetros`.`tbAtividades` SET `time` = Now(), `Categoria` = ".$nuCategoria.", `txAtividade` = '".$txAtividade."', `Periodicidade` = ".$nuPeriodicidade.", `HorimetroAlerta` = ".$nuAlerta.", `procedimento` = '".$txProcedimento."' WHERE `idAtividade` = ".$id.";";
									if ($stmt = $con->prepare($query)) {
									    $stmt->execute();
								echo $query;	    
									    $stmt->close();
									    $sucesso = "Dados cadastrados com sucesso!";
									}
						}
			}
				  
		}	echo $query;
		?>
			</select></td>
	</tr>
	<tr>
		<td style="width: 279px" class="auto-style9">
		Horimetro Ultima:<br />
			<input style="background: #43494B; border-color:#CECECE;border-radius: 5px 5px 5px 5px; height: 25px;" name="nuHorimetroUltima" type="text" id="nuHorimetroUltima" size="45" style="width: 130px" value="<?php echo $HorimetroUltima; ?>" tabindex="5" /></td>
		<td style="width: 319px" class="auto-style9">
					<br>Procedimento: <span class="auto-style1">(*Somente 
			PDF ate 10Mb)</span><br />
			<input style="background: #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px;" name="txProcedimento" type="file"  tabindex="7" size="30"/>		
			</td>
	</tr>
	<tr>
		<td style="width: 279px" class="auto-style9">
		Horas p/ Alerta:<br />
			<input style="background: #43494B; border-color:#CECECE;border-radius: 5px 5px 5px 5px; height: 25px;" name="nuAlerta" type="text" size="45" style="width: 80px" tabindex="6" value="<?php echo $HorimetroAlerta; ?>" /></td>
		<td style="width: 319px" class="auto-style9">
		
      <input name="btEnv" id="btEnv" type="submit" value="Salvar" style="background: #FFC72B; border-color:#43494B; border-radius: 5px 5px 5px 5px; height: 28px; width: 105px;"/></td>
	</tr>
	</table>
</form>
</body>
<?php $con->close();?>
</html>

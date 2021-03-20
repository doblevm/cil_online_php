<?php 
include('conecta.php');
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="pt-br" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
<style type="text/css">
.auto-style1 {
	font-size: x-small;
}
</style>
</head>
<?php
//inclui cabeçalho padrao da pagina com menu 
 include('topo.php'); 
?>

<body style="background-color: #222E34;">

<form method="post" enctype="multipart/form-data" action="<?php $_SERVER["PHP_SELF"]?>">
	<br><br>
	<br><br><br><br>
	<table  style="width: 80%; height: 41px; left: 10%; margin-left: 0px; position: relative;" align="center ">
	<tr>
		<td colspan="2" style="height: 33px">
		<p class="Titulo"><strong>Cadastrar nova atividade</strong></p>
		</td>
	</tr>
	<tr>
		<td style="width: 279px; height: 45px;" class="Conteudo">
			

			Máquina:<br /><span class="Conteudo">
			<select name="nuMaquinas" id="nuMaquinas" tabindex="1" style="background: #43494B; border-color:#CECECE;">
			<option selected="selected" value="0">Selecione</option>
<?php
			//query para encher o drop down
			$query = "SELECT idMaquina, Area, Maquina, Horimetro FROM tbMaquinas where Maquina IS NOT null order by Area asc;";
		
		
			if ($stmt = $con-> prepare($query)) {
			    $stmt->execute();
			    $stmt->bind_result($idMaquina, $Area, $Maquina, $Horimetro);
			    while ($stmt->fetch()) 
			    echo '<option value="'.$idMaquina.'">'.$Area.' - '.$Maquina.'</option>';
			      	        
			    }
			   $stmt->close();
			  			  
			
?>
			</select><br /></span>
		</td>
		<td style="width: 319px; height: 45px;" class="Conteudo">
		Descrição da Atividade:<br />
			<input style="background: #43494B; border-color:#CECECE;" name="txAtividade" type="text" size="100" style="width: 250px" tabindex="2"/></td>
	</tr>
	<tr>
		<td style="width: 279px; height: 20px;" class="Conteudo">
		</td>
		<td style="width: 319px; height: 20px;" class="Conteudo">
		</td>
	</tr>
	<tr>
		<td style="width: 279px" class="Conteudo">
			
		Periodicidade Horas:<br />
			<input style="background: #43494B; border-color:#CECECE;" name="nuPeriodicidade" type="text" size="45" style="width: 130px" tabindex="3" /></td>
		<td style="width: 319px" class="Conteudo">
		Tipo de Atividade<br>
			<select name="nuCategoria" id="nuCategoria" tabindex="4" style="background: #43494B; border-color:#CECECE;">
			<option selected="selected" value="0">Selecione</option>
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
						if(empty($_POST["nuMaquinas"]))
							$erro = "Selecione a Maquina";
						else
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
						if(empty($_POST["nuCategoria"]))
							$erro = "Selecione a Categoria";
						else
								$nuMaquinas=$_POST["nuMaquinas"];
							  	$nuCategoria=$_POST["nuCategoria"];
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
										$destino = 'Procedimentos/' . $novoNome; 
										
										// tenta mover o arquivo para o destino
										if( @move_uploaded_file( $arquivo_tmp, $destino  ))
										{
											echo "Arquivo salvo com sucesso em : <strong>" . $destino . "</strong><br />";
											echo "<img src=\"" . $destino . "\" />";
										}
										else
											$erro ="Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";
									}
									else
										$erro ="Você poderá enviar apenas arquivos \"*.pdf\"<br />";
								}
								else
								{
									$erro ="Você não enviou nenhum arquivo!";
								}

						{
						
						//Vamos realizar o cadastro ou alteração dos dados enviados.
					
							  	$txProcedimento=$novoNome;
								$query = "INSERT INTO `Horimetros`.`tbAtividades`(`time`,`idMaquina`,`txAtividade`,`Periodicidade`,`HorimetroAlerta`,`HorimetroUltima`,`HorimetroProxima`,`procedimento`) VALUES(now(),".$nuMaquinas.",'".$txAtividade."',".$nuPeriodicidade.",".$nuAlerta.",".$nuHorimetroUltima.",".$nuProxima.",'".$txProcedimento."')";
				
									if ($stmt = $con->prepare($query)) {
									    $stmt->execute();
								echo $query;	    
									    $stmt->close();
									    $sucesso = "Dados cadastrados com sucesso!";
									}
						}
			}
				  
			
?>
			</select></td>
	</tr>
	<tr>
		<td style="width: 279px" class="Conteudo">
		Horímetro Última:<br />
			<input style="background: #43494B; border-color:#CECECE;" name="nuHorimetroUltima" type="text" id="nuHorimetroUltima" size="45" style="width: 130px" value="1" tabindex="5" /></td>
		<td style="width: 319px" class="Conteudo">
					<br>Procedimento: <span class="auto-style1">(*Somente 
			PDF ate 10Mb)</span><br />
			<input style="background: #43494B; border-color:#CECECE;" name="txProcedimento" type="file"  tabindex="7" size="30"/>		
			</td>
	</tr>
	<tr>
		<td style="width: 279px" class="Conteudo">
		Horas p/ Alerta:<br />
			<input style="background: #43494B; border-color:#CECECE;" name="nuAlerta" type="text" size="45" style="width: 130px" tabindex="6" /></td>
		<td style="width: 319px" class="auto-style1">
		&nbsp;</td>
	</tr>
	<tr>
		<td style="width: 279px; height: 23px;" class="auto-style3">
		
		</td>
		<td style="width: 319px; height: 23px;" class="auto-style3">
		<input style="background: #43494B; border-color:#CECECE;" name="btEnv" id="btEnv"type="submit" value="Enviar" tabindex="8" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input style="background: #43494B; border-color:#CECECE;" name="btReset" type="reset" value="Reset" tabindex="9" />
		<?php
		// Validação dos Dados do formulario
		if(isset($erro))
			echo '<div style="color:#F00">'.$erro.'</div><br/><br/>';
		else
		if(isset($sucesso))
			echo '<div style="color:#00f">'.$sucesso.'</div><br/><br/>';
		 
		?>
</td>
	</tr>
	</table>
</form>
</body>
<?php $con->close();?>
</html>

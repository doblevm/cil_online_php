<?php 
include('conecta.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <!--
    Modified from the Debian original for Ubuntu
    Last updated: 2016-11-16
    See: https://launchpad.net/bugs/1288690
  -->
  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style type="text/css">

.Titulo {
	text-align: center;
	font-family: Verdana, Geneva, Tahoma, sans-serif;
	color: #FFFFFF;
	text-align: center;
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
.texto {
	text-align: center;
	font-family: Georgia;
	color: #000000;
	text-align: center;
	font-size: 15px;
	line-height: 150%;
}
.subTexto{
	text-align: center;
	font-family: Georgia;
	color: #000000;
	text-align: center;
	font-size: 8px;
	
}
 
 
 

	.auto-style3 {
		text-align: center;
		font-family: "Candara Light";
		color: #FFFFFF;
		text-align: center;
		font-size: 48px;
	}
 

	.auto-style4 {
	text-align: center;
	font-family: "Tahoma";
	color: #FFFFFF;
	text-align: left;
	font-size: 15px;
	line-height: 150%;
}
 

	</style>
<script>
			function resizeWin() {
  this.resizeTo(600, 500);
  this.focus();
}
			function showHint(str) {
			  if (str.length == 0) {
			    document.getElementById("txtHint").innerHTML = "";
			    return;
			  } else {
			    var xmlhttp = new XMLHttpRequest();
			    xmlhttp.onreadystatechange = function() {
			      if (this.readyState == 4 && this.status == 200) {
			        document.getElementById("txtHint").innerHTML = this.responseText;
			        document.querySelector("[name='idOK']").value = this.responseText;
			      }
			    }
			    xmlhttp.open("GET", "gethint.php?q="+str, true);
			    xmlhttp.send();
			  }
			}
</script>
    </head>
  <?php
//inclui cabeçalho padrao da pagina com menu
 ///include('topo.php'); 
?>

  <body style="background-color: #222E34;" onload="resizeWin();">
	<p><?php
	
	$id=$_GET['id'];
	$query = "SELECT idMaquina,Maquina,idAtividade,txAtividade,Periodicidade,HorimetroAlerta,HorimetroUltima,HorimetroProxima,Horimetro FROM tbAtividades INNER JOIN tbMaquinas USING (idMaquina) WHERE idAtividade=".$id.";";


			if ($stmt = $con->prepare($query)) {
			    $stmt->execute();
			    $stmt->bind_result($idMaquina, $Maquina, $idAtividade, $txAtividade, $Periodicidade, $HorimetroAlerta, $HorimetroUltima, $HorimetroProxima, $Horimetro );
			    while ($stmt->fetch()) {
			        //printf("%s, %s\n", $field1, $field2);
			    }
			    $stmt->close();
			    $Gap=$HorimetroProxima-$Horimetro;
			 }   
			    
			if(isset($_POST["btEnv"])){  
						if(empty($_POST["nuIDExec"]))
							$erro = "Digite seu ID";
						else
						if(empty($_POST["idOK"]))
							$erro = "ID Invalido";
						else
						{
						
						//Vamos realizar o cadastro ou alteração dos dados enviados.
					
							  	$nuIDExec=$_POST["nuIDExec"];
								$txObs=$_POST["txObs"];
								$ProximaNew=$Periodicidade+$Horimetro;
								$query = "INSERT INTO `Horimetros`.`tbExecucoes` (`time`,`idMaquina`, `idAtividade`, `IDFuncionario`, `HorimetroExec`, `GapHorimetro`, `Observacao`) VALUES (CONVERT_TZ(now(),'+00:00','-3:00'),".$idMaquina.",".$idAtividade.",".$nuIDExec.",".$Horimetro.",".$Gap.",'".$txObs."');";
								$query.= "UPDATE `Horimetros`.`tbAtividades` SET `time` = CONVERT_TZ(now(),'+00:00','-3:00'), `HorimetroUltima` =".$Horimetro.", `HorimetroProxima` = ".$ProximaNew." WHERE `idAtividade` = ".$id.";";
								//"INSERT INTO `Horimetros`.`tbExecucoes`(`time`,`idMaquina`,`idAtividade`,`IDFuncionario`,`NomeFunc`,`HorimetroExec`,`GapHorimetro`,Observacao) VALUES(now(),".$idMaquina.",'".$idAtividade."',".$nuIDExec.",".$txNome.",".$Horimetro.",".$Gap.",'".$txObs."')";
								$query2;
									if ($con->multi_query($query)) {
									    $sucesso="Dados Cadastrados";
									    echo "<script>window.close();</script>";
									    }else{
									    $erro=$mysqli->error;
								
									}
						}
			}
	
	?><form method="post" action="<?php $_SERVER["PHP_SELF"]?>">
	<table style="width: 563px; height: 233px;" align="center" class="auto-style3"><font color="#212182">
		<tr>
			<td class="Conteudo" colspan="2"><strong>Finalizar Atividade</strong></td>
		</tr>
		<tr>
			<td class="auto-style4" style="height: 23px; width: 216px;"><strong>Maquina: </strong><?php echo $Maquina ?></td>
			<td class="auto-style4" style="height: 23px"><strong>Atividade: </strong><?php echo $txAtividade ?></td>
		</tr>
		<tr>
			<td class="auto-style4" style="width: 216px"><strong>Horimetro Atual: </strong><?php echo $Horimetro ?></td>
			<td class="auto-style4"><strong>Horimetro Programado: </strong><?php echo $HorimetroProxima?></td>
		</tr>
		<tr>
			<td class="auto-style4" style="width: 216px"><strong>Gap Horas: </strong><?php echo $Gap ?></td>
			<td class="auto-style4">&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style4" colspan="2">
			<strong>Observações:</strong>&nbsp; 
			<input name="txObs" type="text" style="background: #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px; width: 356px;"Conteudo"></td>
		</tr>
		<tr>
			<td class="auto-style4" style="height: 79px;" colspan="2">
			
			ID Executante:&nbsp;&nbsp;</span><font color="#212182"><input name="nuIDExec" onkeyup="showHint(this.value)" type="text" style="background: #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px; width: 100px;"Conteudo"></font> <font color="#212182">
			<input name="idOK" id="idOK"  type="hidden" style="background: #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px; width: 100px;"Conteudo"></font><br>Nome Executante:<span id="txtHint">>&nbsp;&nbsp; 
			</span></td>
		</tr>
		<tr>
			
			<td class="Conteudo">&nbsp; 
			</td>
		</tr></font>
		<tr>
			<td class="auto-style10" colspan="2" style="height: 10px">
				<?php
				// Validação dos Dados do formulario
				//echo $query;
				if(isset($erro))
					echo '<div style="color:#F00">'.$erro.'</div><br/><br/>';
				else
				if(isset($sucesso))
					echo '<div style="color:#00f">'.$sucesso.'</div><br/><br/>';
				 
				?>
		
      <input name="btEnv" id="btEnv" type="submit" value="Salvar" style="background: #FFC72B; border-color:#43494B; border-radius: 5px 5px 5px 5px; height: 28px; width: 105px;"/>
			&nbsp;&nbsp;</td>
		</tr>
	</table>
	  </p>
	
	</form>
	</body>
</html>
<?php $con->close();?>


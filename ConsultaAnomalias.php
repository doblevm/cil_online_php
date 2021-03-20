<?php 
include('conecta.php');
include('topo.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml">
  <!--
    Modified from the Debian original for Ubuntu
    Last updated: 2016-11-16
    See: https://launchpad.net/bugs/1288690
  -->
  <head>
  
<script>
	function Validado(int,str) {
	  var xmlhttp=new XMLHttpRequest();
	  xmlhttp.onreadystatechange=function() {
	    if (this.readyState==4 && this.status==200) {
	     alert("Status Alterado!");
	    }
	  }
	  xmlhttp.open("GET","Validado.php?q="+int+"&s="+str,true);
	  xmlhttp.send();
	}
</script>

  
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Consulta relatos de anomalias</title>
    
    <style type="text/css">
	#myProgress {
		width: 50%;
		background-color: #7D0020;
		margin-left: 10px;
	}

#myBar {
  width: 10%;
  height: 30px;
  background-color: #CF9F59;
  text-align: center;
  line-height: 30px;
  color: white;
}
.box{
	/*definimos a largura do box*/
	width:800px;
	/* definimos a altura do box */
	height:100px;
	/* definimos a cor de fundo do box */
	background-color:#9D4349;
	/* definimos o quão arredondado irá ficar nosso box */
	border-radius: 15px 15px 15px 15px;
	}
.box2{
	/*definimos a largura do box*/
	width:39px;
	/* definimos a altura do box */
	height:80px;
	/* definimos a cor de fundo do box */
	background-color:#9D4349;
	/* definimos o quão arredondado irá ficar nosso box */
	border-radius: 15px 15px 15px 15px;
	}
.Titulo {
	text-align: center;
	font-family: Tahoma, Geneva, Tahoma, sans-serif;
	color: #FFFFFF;
	text-align: center;
	font-size: 48px;
	}



.SubTitulo {
	text-align: center;
	font-family: Tahoma, Geneva, Tahoma, sans-serif;
	color: #FFFFFF;
	text-align: center;
	font-size: 20px;
	line-height: 150%;

}
.SubTr {
	text-align: center;
	font-family: Tahoma, Geneva, Tahoma, sans-serif;
	color: #FFFFFF;
	text-align: center;
	font-size: 20px;
	line-height: 150%;

}
.SubTr:hover {
		text-align: center;
		border-style: solid;
		border-color: #ADB4B6;
		font-family: Tahoma, Geneva, Tahoma, sans-serif;
		color: #FFFFFF;
		text-align: center;
		font-size: 18px;
		line-height: 150%;
		background-color: #ADB4B6;

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
	font-family: Tahoma;
	color: #000000;
	text-align: center;
	font-size: 15px;
	line-height: 150%;
}
.subTexto{
	text-align: center;
	font-family: Tahoma;
	color: #000000;
	text-align: center;
	font-size: 8px;
	
} 
tr {background-color: #43494B;}

	</style>
	<script language="javascript" src="arq/osfun.js"></script>
  </head>
  <body style="background-color: #222E34;">  </br></br></br></br></br>
  <table style="width: 76%; height: 41; left: 10%; margin-left: 30px; position: relative;background-color: #222E34;">
		<tr >
			<td class="Titulo">Consulta de Anomalias</td>
		</tr>
		<tr >
			<td class="subTitulo"><form method="post" action="<?php $_SERVER["PHP_SELF"]?>" style="width: 950px height: 35px;">								
					<form method="post" action="<?php $_SERVER["PHP_SELF"]?>" style="width: 950px; height: 35px;"></br>								
								</select> Palavra Chave:<input name="txPesquisa" id="txPesquisa" type="text" style="background: #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px; width: 490px;"> 
						Data:<input name="dtInicial" id="dtInicial" type="text" value="<?php echo date("01-m-Y");?>" style="width: 90px;background: #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px;"" OnKeyPress="DefMask(this, '##-##-####')" size="10">&nbsp; a&nbsp;
						<input name="dtFinal" id="dtFinal" type="text" value="<?php echo date("31-m-Y");?>" style="width: 90px;background: #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px;"" size="10">&nbsp;&nbsp; 
						<input name="btEnv" type="submit" value=" " style="width: 30px; background: #43494B; border:medium none #43494B; background:url(images/lupa.png); height: 30px;">&nbsp; 
						</form>
									
					
				
				
				</td>
		</tr>
	</table>
	<table style="width: 86%; height: 43px; left: 5%; margin-left: 30px; position: relative; top: 0px;">		<tr>
			<td class="SubTitulo" Data</td style="height: 39px">
			Data<td class="SubTitulo" style="height: 39px" >Área&nbsp; </td>
			<td class="SubTitulo" style="height: 39px">Equipamento</td>
			<td class="SubTitulo" style="height: 39px">Anomalia</td>
			<td class="SubTitulo" style="height: 39px" >Qualidade&nbsp;&nbsp; </td>
			<td class="SubTitulo" style="height: 39px" >Ação Preventiva</td>
			<td class="SubTitulo" style="height: 39px" >Ação Corretiva</td>
			<td class="SubTitulo" style="height: 39px; width: 42px" >Resolvido</td>	
		</tr>
		<?php 
			if((isset($_POST["btEnv"]))){
				//$refresh=360;
				
				$txLike=$_POST["txPesquisa"];
				//$txFiltro=$_POST["nuMaquinas0"]; 
				//$txArea=$_POST["txArea"];
				$dtInicial=date("Y-m-d",strtotime($_POST['dtInicial']));
				$dtFinal=date("Y-m-d",strtotime($_POST['dtFinal']));
				$query = "SELECT `tbAnomalias`.`id`,  `tbAnomalias`.`idFuncionario`, `tbAnomalias`.`idEquipamento`, `tbAnomalias`.`idDescricao`,`tbAnomalias`.`CausaFundamental`,";
				$query=$query." `tbAnomalias`.`dtQualidade`,`tbAnomalias`.`dtLimpeza`,   `tbAnomalias`.`dtLubrificacao`,   `tbAnomalias`.`dtPlano`,  `tbAnomalias`.`dtTrocamandatoria`,";
				$query=$query." `tbAnomalias`.`dtTreinamento`, `tbAnomalias`.`dtCorretiva`,`tbAnomalias`.`dtPreventiva`,`tbAnomalias`.`dtArea`,`tbAnomalias`.`Data`, `tbAnomalias`.`Validado`";
				$query=$query." from `solucionar`.`tbAnomalias`";
				$query=$query." Where `idEquipamento` LIKE '%".$txLike."%' OR `idDescricao` LIKE '%".$txLike."%' OR`CausaFundamental` LIKE '%".$txLike."%'  OR `dtCorretiva` LIKE '%".$txLike."%' OR `dtPreventiva` LIKE '%".$txLike."%' OR `dtArea`";
				$query=$query." LIKE '%".$txLike."%' and (Data between DATE_FORMAT('".$dtInicial."' ,'%Y-%m-%d')  AND DATE_FORMAT('".$dtFinal."' ,'%Y-%m-%d')) order by dtArea asc;";			//echo $query;
				//echo $query;
			}else{
				//$query = "SELECT Data, dtArea, idEquipamento, idDescricao, dtQualidade, dtPreventiva, dtCorretiva, Validado  FROM solucionar.tbAnomalias where Data between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() ;";
				$query = "SELECT `tbAnomalias`.`id`,  `tbAnomalias`.`idFuncionario`, `tbAnomalias`.`idEquipamento`, `tbAnomalias`.`idDescricao`,`tbAnomalias`.`CausaFundamental`,";
				$query=$query." `tbAnomalias`.`dtQualidade`,`tbAnomalias`.`dtLimpeza`,   `tbAnomalias`.`dtLubrificacao`,   `tbAnomalias`.`dtPlano`,  `tbAnomalias`.`dtTrocamandatoria`,";
				$query=$query." `tbAnomalias`.`dtTreinamento`, `tbAnomalias`.`dtCorretiva`,`tbAnomalias`.`dtPreventiva`,`tbAnomalias`.`dtArea`,`tbAnomalias`.`Data`, `tbAnomalias`.`Validado`";
				$query=$query." from `solucionar`.`tbAnomalias`";
				$query=$query." Where Data between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() And Validado='Não' order by dtArea asc;";

			//echo $query;

			
			}
			if ($stmt = $con-> prepare($query)) {
			    $stmt->execute();
			    $stmt->bind_result($id,  $idFuncionario, $idEquipamento, $idDescricao,$CausaFundamental,$dtQualidade,$dtLimpeza,   $dtLubrificacao,   $dtPlano,  $dtTrocamandatoria, $dtTreinamento, $dtCorretiva,$dtPreventiva,$dtArea,$Data, $Validado);
			    
			    while ($stmt->fetch()) {
			        //printf("%s, %s\n", $field1, $field2);
			    echo '<tr class="SubTr">';
			    echo '  <td class="SubTr">'.$Data.'</td>';
			    echo '  <td class="Conteudo">'.$dtArea.'</td>';
			    echo '  <td class="Conteudo">'.$idEquipamento.'</td>';
			    echo '  <td class="Conteudo">'.$idDescricao.' h</td>';
			    echo '  <td class="Conteudo">'.$dtQualidade.'</td>';
			    echo '  <td class="Conteudo">'.$dtPreventiva.'</td>';
  			    echo '  <td class="Conteudo">'.$dtCorretiva.' h</td>';
  			    echo '  <td class="Conteudo"><select name="Validado" id="validado" onchange="Validado('.$id.',this.value);" style="background: #43494B; border-color:#CECECE;border-radius: 5px 5px 5px 5px; height: 25px; width: 83px;" class="auto-style22">';
  			    echo '  <option selected="" value="'.$Validado.'">'.$Validado.'</option><option>Sim</option>';
				echo '	<option>Não</option></select></td>';
				echo '  <tr>';		      	        
			    }
			    $stmt->close();
			}
?>
		</table>
		</body>

<?php $con->close();?>

</html>


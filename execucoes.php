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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Apache2 Ubuntu Default Page: It works</title>
    
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
			<td class="Titulo">Execuções</td>
		</tr>
		<tr >
			<td class="subTitulo"><form method="post" action="<?php $_SERVER["PHP_SELF"]?>" style="width: 950px height: 35px;">								
					<form method="post" action="<?php $_SERVER["PHP_SELF"]?>" style="width: 950px; height: 35px;"></br>								
				Area:<select name="txArea" style="background: #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px;">
		<!----		<option selected="">Selecione</option>---->
				<?php
			//query para encher o drop down
			$query = "SELECT Area FROM tbMaquinas Group by Area;";
		
		
			if ($stmt = $con-> prepare($query)) {
			    $stmt->execute();
			    $stmt->bind_result($Area);
			    
			    while ($stmt->fetch()) 
			    echo '<option value="'.$Area.'">'.$Area.'</option>';
			      	        
			    }
			   $stmt->close();
				?>
				
				</select>&nbsp;&nbsp;&nbsp; Filtrar por:<select name="Select1" style="width: 82px; background: #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px;">	
				<option value="txAtividade" selected="">Atividade</option>
				<option value="Name">Nome</option>
				<option value="Maquina">Maquina</option>
						<option value="Grupo">Grupo</option>
				</select> Palavra Chave:<input name="txPesquisa" id="txPesquisa" type="text" style="background: #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px;"> 
						Data:<input name="dtInicial" id="dtInicial" type="text" value="<?php echo date("01-m-Y");?>" style="width: 90px;background: #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px;"" OnKeyPress="DefMask(this, '##-##-####')" size="10">&nbsp; a&nbsp;
						<input name="dtFinal" id="dtFinal" type="text" value="<?php echo date("31-m-Y");?>" style="width: 90px;background: #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px;"" size="10">&nbsp;&nbsp; 
						<input name="btEnv" type="submit" value=" " style="width: 30px; background: #43494B; border:medium none #43494B; background:url(images/lupa.png); height: 30px;">&nbsp; 
						</form>
									
					
				
				
				</td>
		</tr>
	</table>
	<table style="width: 76%; height: 41; left: 10%; margin-left: 30px; position: relative;">		<tr>
			<td class="SubTitulo" Data</td>
			<td class="SubTitulo" >Atividade</td>
			<td class="SubTitulo">Maquina</td>
			<td class="SubTitulo">Periodicidade</td>
			<td class="SubTitulo" >ID</td>
			<td class="SubTitulo" >Nome</td>
			<td class="SubTitulo" >Horimetro</td>
			<td class="SubTitulo" >Gap</td>	
				
		</tr>
		<?php
			if((isset($_POST["btEnv"]))){
				$refresh=360;
				$txLike=$_POST["txPesquisa"];
				$txFiltro=$_POST["Select1"];
				$txArea=$_POST["txArea"];
				$dtInicial=date("Y-m-d",strtotime($_POST['dtInicial']));
				$dtFinal=date("Y-m-d",strtotime($_POST['dtFinal']));
				$query = "SELECT tbExecucoes.time, IDFuncionario, Name, HorimetroExec, GapHorimetro, txAtividade, Periodicidade, Maquina FROM tbExecucoes inner join tbAtividades on tbExecucoes.idAtividade=tbAtividades.idAtividade inner join tbMaquinas on tbMaquinas.idMaquina=tbExecucoes.idMaquina inner join tbFuncionarios on tbFuncionarios.id=tbExecucoes.IDFuncionario WHERE (Area='".$txArea."') and (".$txFiltro." LIKE '%".$txLike."%') and (`tbExecucoes`.`time` between DATE_FORMAT('".$dtInicial."' ,'%Y-%m-%d')  AND DATE_FORMAT('".$dtFinal."' ,'%Y-%m-%d')) order by time, Maquina asc;";
			//echo $query;
			
			}else{
				$query = "SELECT tbExecucoes.time, IDFuncionario, Name, HorimetroExec, GapHorimetro, txAtividade, Periodicidade, Maquina FROM tbExecucoes inner join tbAtividades on tbExecucoes.idAtividade=tbAtividades.idAtividade inner join tbMaquinas on tbMaquinas.idMaquina=tbExecucoes.idMaquina inner join tbFuncionarios on tbFuncionarios.id=tbExecucoes.IDFuncionario where (`tbExecucoes`.`time` between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() ) order by time, Maquina asc;";
			//echo $query;

			
			}
			if ($stmt = $con-> prepare($query)) {
			    $stmt->execute();
			    $stmt->bind_result($time, $IDFuncionario, $NomeFunc, $HorimetroExec, $GapHorimetro, $txAtividade, $Periodicidade, $Maquina);
			    while ($stmt->fetch()) {
			        //printf("%s, %s\n", $field1, $field2);
			    echo '<tr>';
			    echo '  <td class="Conteudo">'.$time.'</td>';
			    echo '  <td class="Conteudo">'.$txAtividade.'</td>';
			    echo '  <td class="Conteudo">'.$Maquina.'</td>';
			    echo '  <td class="Conteudo">'.$Periodicidade.' h</td>';
			    echo '  <td class="Conteudo">'.$IDFuncionario.'</td>';
			    echo '  <td class="Conteudo">'.$NomeFunc.'</td>';
  			    echo '  <td class="Conteudo">'.$HorimetroExec.' h</td>';
  			    echo '  <td class="Conteudo">'.$GapHorimetro.'</td>';
				echo '  <tr>';		      	        
			    }
			    $stmt->close();
			}
?>
		</table>
		</body>

<?php $con->close();?>

</html>


  <?php
//inclui cabeçalho padrao da pagina com menu
 include('topo.php');
//Conexao Base de dadso
  include('conecta.php');
  
  $refresh=120;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="refresh" content="<?php echo $refresh ?>">
<script language="javascript">
            function open_win_editar(id) {
                window.open("executar.php?id="+id, "Executar", "location=1, status=no, scrollbars=no, width=650, height=350");
            }
            function open_win_pdf(procedimento) {
                window.open('/Procedimentos/'+procedimento, '_blank');
            }

        </script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Controle de CIL Limpeza tecnica</title>
    <style type="text/css">
	#myProgress {
		
		background-color: #FFFFFF;
		margin-left: 10px;
		border-radius: 15px 15px 15px 15px;

	}

#myBar {
  
  height: 25px;
  background-color: #0E97FF;
  text-align: center;
  line-height: 30px;
  color: white;
  border-radius: 15px 15px 15px 15px;

}
.box1{
	/*definimos a largura do box*/
	width:900px;
	/* definimos a altura do box */
	height:90px;
	/* definimos a cor de fundo do box */
	background-color:#43494B;
	/* definimos o quão arredondado irá ficar nosso box */
	border-radius: 15px 15px 15px 15px;
	}
.box2{
	/*definimos a largura do box*/
	width:39px;
	/* definimos a altura do box */
	height:80px;
	/* definimos a cor de fundo do box */
	background-color:#43494B;
	/* definimos o quão arredondado irá ficar nosso box */
	border-radius: 15px 15px 15px 15px;
	}


	.Progress {
		font-size: 36px;
		color: #E5DEE1;
	}
	.bgTD {
		
		background-color: none;
	}
	.boxTitle {
		/*definimos a largura do box*/
	width: 800px; /* definimos a altura do box */;
		height: 50px; /* definimos a cor de fundo do box */;
		background-color: #7D0020;
	/* definimos o quão arredondado irá ficar nosso box */
		border-radius: 15px 15px 15px 15px;
	}
	.Progress1 {
		font-size: 18px;
		color: #E5DEE1;
	}
	.table{
	  left: 25%;
	  margin-left: 0px; 
	  position: relative;
    }

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
 
 
 

	.auto-style1 {
		text-align: center;
		font-family: Verdana, Geneva, Tahoma, sans-serif;
		color: #FFFFFF;
		text-align: left;
		font-size: 48px;
	}
	.auto-style3 {
		text-align: center;
		font-family: "Candara Light";
		color: #FFFFFF;
		text-align: center;
		font-size: 48px;
	}
 

	</style>
	<script language="javascript">	
		// Função para alterar cor numa tabela ao mover o mouse.
		// deve ser usada:
		// <tr onmouseover=mOver(this); onmouseout=mOut(this);>
		bg = "";
		lThis = "";
		Obg="";
		function mOver(src, clrOver) {
			if (!src.contains(event.fromElement)) {
				bg = src.bgColor;
				Obg = src.bgColor;
				src.bgColor = '#c0c0c0';
			}
		}
		function mOut(src, clrIn) {
			if (!src.contains(event.toElement)) {
				src.bgColor = Obg;
			}
		}
	
	</script>
  </head>
  <body style="background-color: #222E34;"><br/><br/>
  <br/>
	<table style="width: 757px; height: 41px; left: 15%; margin-left: 30px; position: relative;">
		<tr>
			<td style="width: 598px; height: 100">
			<div id="box" class="auto-style1">
				<span class="auto-style3"><strong>&nbsp;&nbsp;Lista de 
				atividades&nbsp;<?php if(isset($_GET['Area'])) echo $_GET['Area']; ?> </strong></span>
				</div></td>
						
		</tr>
		<tr>
			<td style="width: 600px" class="Conteudo">
									
			<form method="post" action="<?php $_SERVER["PHP_SELF"]?>" style="width: 822px">								
				Area:<select name="txArea" style="background: #43494B; border-color:#CECECE;border-radius: 5px 5px 5px 5px; height: 25px;">
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
				
				</select>&nbsp;&nbsp;&nbsp; Filtrar por:<select name="Select1" style="background: #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px;">	
				<option value="txAtividade" selected="">Atividade</option>
				<option value="tbMaquinas.Grupo">Grupo</option>
				<option value="tbMaquinas.Maquina">Maquina</option>
				</select> Palavra Chave:<input name="txPesquisa" id="txPesquisa" type="text" style="background: #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px;"> 
				<input name="btEnv" type="submit" value=" " style="width: 30px; background: #43494B; border:medium none #43494B; background:url(images/lupa.png); height: 30px;"></form>
									
											
			<td  style="width: 39px">
			
						
			<td  style="width: 39px">			
		</tr>
		<?php
			//$where='(Horimetro>(HorimetroProxima-HorimetroAlerta));';
		if((isset($_POST["btEnv"]))){
			//and(!empty($_POST["txArea"]))
				$refresh=360;
				$txLike=$_POST["txPesquisa"];
				$txFiltro=$_POST["Select1"];
				$txArea=$_POST["txArea"];
				$query = "SELECT idAtividade,txAtividade, Periodicidade, HorimetroAlerta,HorimetroUltima,HorimetroProxima, procedimento, Area, Maquina, Horimetro, tbMaquinas.Area FROM tbAtividades inner join tbMaquinas using(idMaquina) WHERE (Area='".$txArea."') and (".$txFiltro." LIKE '%".$txLike."%') and (Horimetro>(HorimetroProxima-HorimetroAlerta)) order by Grupo, HorimetroProxima asc;";
			}else{
					if(isset($_GET['Area'])){
						$txArea=$_GET['Area'];
						$query = "SELECT idAtividade,txAtividade, Periodicidade, HorimetroAlerta,HorimetroUltima,HorimetroProxima, procedimento, Area, Maquina, Horimetro, tbMaquinas.Area FROM tbAtividades inner join tbMaquinas using(idMaquina) WHERE (Area='".$txArea."') and (Horimetro>(HorimetroProxima-HorimetroAlerta)) order by Grupo, HorimetroProxima asc;";
						//echo $query;
					}else{
						$query = "SELECT idAtividade,txAtividade, Periodicidade, HorimetroAlerta,HorimetroUltima,HorimetroProxima, procedimento, Area, Maquina, Horimetro, tbMaquinas.Area FROM tbAtividades inner join tbMaquinas using(idMaquina) WHERE (Horimetro>(HorimetroProxima-HorimetroAlerta)) order by Grupo, HorimetroProxima asc limit 30;";
						//echo $query;
					}
			
			}
		//$query = "SELECT idAtividade,txAtividade, Periodicidade, HorimetroAlerta,HorimetroUltima,HorimetroProxima, procedimento, Maquina, Horimetro, tbMaquinas.Area FROM tbAtividades inner join tbMaquinas using(idMaquina);
		//echo $query ;
		
			if ($stmt = $con-> prepare($query)) {
			    $stmt->execute();
			    $stmt->bind_result($idAtividade,$txAtividade, $Periodicidade, $HorimetroAlerta, $HorimetroUltima, $HorimetroProxima, $procedimento, $Area, $Maquina, $Horimetro, $Area);
			    while ($stmt->fetch()) {
			    	$horas=($HorimetroProxima-$Horimetro);
			       $barra=(100-((($HorimetroProxima-$Horimetro)/$Periodicidade)*100));

			       if($barra>100){
			       	$barra=100;}
			       if($barra<0){
			       		$barra=0;}
		        echo '<tr >';
			    echo '  <td style="width: 798px"><br/><div id="box1" class="box1" ><span class="SubTitulo">&nbsp;&nbsp;'.$txAtividade.'<br/>';
			    echo '	</span><span class="Conteudo">&nbsp;&nbsp;Area:&nbsp; '.$Area.' &nbsp;'.$Maquina.'</span><span class="Conteudo">';
			    echo '  &nbsp;&nbsp;Periodicidade:&nbsp;</span><span class="Conteudo">'.$Periodicidade.'&nbsp;h</SPAN>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="Conteudo">&nbsp;Horimetro atual:&nbsp;</span><span class="Conteudo">'.$Horimetro.'&nbsp;h&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
			    echo '  <span class="Conteudo">&nbsp;&nbsp;Proxima Atividade:&nbsp;</span><span class="Conteudo">'.$HorimetroProxima.'&nbsp;<a href="" onclick="open_win_editar('.$idAtividade.');"><img height="50" src="images/cadeado.png" width="50" align="right"></a><a href="Procedimentos/'.$procedimento.'" target="_blank"><img height="50" src="images/lapis.png"  width="50" align="right"></a>'; 
			    echo ' <br/> <div id="myProgress" style="width: 500px;"><div id="myBar" style="width: '.round(($barra),2).'%" class="Conteudo">'.$horas.'h</div></div></span><br/>';
			    }
			    $stmt->close();
			}
?>

			
		</tr>
		
		</table>

	</body>
</html>


<?php $con->close();?>
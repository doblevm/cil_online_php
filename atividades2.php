<?php 
$host="db";
$port=3306;
$socket="";
$user="admin";
$password="admin";
$dbname="Horimetros";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="refresh" content="30">
<script language="javascript">
            function open_win_editar(id) {
                window.open("executar.php?id="+id, "Executar", "location=1, status=no, scrollbars=no, width=450, height=320");
            }
        </script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Controle de CIL Limpeza tecnica</title>
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


	.Titulo {
		color: #212182;
		border: 0 solid #000000;
		text-align: center;
		font-size: x-large;
		font-family: Verdana, Geneva, Tahoma, sans-serif;
	}
	.Corpo {
		font-family: Verdana, Geneva, Tahoma, sans-serif;
		font-size: medium;
		font-weight: bold;
		font-style: oblique;
		font-variant: small-caps;
		text-transform: none;
		color: #CA9956;
		border-top-left-radius: 2px;
		border-top-right-radius: 2px;
		border-bottom-right-radius: 2px;
		border-bottom-left-radius: 2px;
		text-shadow: -2px 0 black, 0 1px black, 1px 0 black, 0 -1px black;

	}
	.texto {
	border-radius: 2px;
	font-family: Verdana, Geneva, Tahoma, sans-serif;
	font-size: medium;
	font-variant: small-caps;
	text-transform: none;
	color: #CA9956;
	font-weight: bolder;
	text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}
	.Progress {
		font-size: 36px;
		color: #E5DEE1;
	}
	.bgTD {
		
		background-color: none;
	}
	.auto-style2 {
		text-align: justify;
	}
	.boxTitle {
		/*definimos a largura do box*/
	width: 800px; /* definimos a altura do box */;
		height: 50px; /* definimos a cor de fundo do box */;
		background-color: #7D0020;
	/* definimos o quão arredondado irá ficar nosso box */
		border-radius: 15px 15px 15px 15px;
	}
	.auto-style4 {
		color: #CF9F59;
	}
	.Progress1 {
		font-size: 18px;
		color: #E5DEE1;
	}
	.auto-style6 {
		font-size: x-large;
		color: #CF9F59;
		font-family: Arial, Helvetica, sans-serif;
		letter-spacing: 5pt;
		text-shadow: -3px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
	}
	.auto-style7 {
		border-radius: 2px;
		font-family: Verdana, Geneva, Tahoma, sans-serif;
		font-size: medium;
		font-variant: small-caps;
		text-transform: none;
		color: #CA9956;
		font-weight: bolder;
		text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
		text-align: center;
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
  <?php
//inclui cabeçalho padrao da pagina com menu
// include('topo.php'); 
?>
<?php include('topo.php');?>
  <body style="background-image: url('images/duplomalte.jpg')"><br/><br/><br/> 

	<form method="post" action="<?php $_SERVER["PHP_SELF"]?>">
	<table style="width: 55%; height: 41px;" align="center">
		<tr>
			<td style="width: 990px; height: 100">
			<div id="box" class="auto-style7">
				<strong>
				<span class="auto-style6">CIL 
				-Lubrificação &amp; Limpeza Tecnica</span></strong><br class="auto-style4"/></div></td>
						
		</tr>
		<tr>
			<td style="width: 990px; height: 100">
			<div id="box" class="texto">
				<span class="texto"><strong>Filtar por Atividade...:
					<input name="Text1" style="width: 354px" type="text"> 
				<input name="btEnv" type="submit" value="button">
				</strong></span><br class="auto-style4"/></div></td>
			<?php
			if(isset($_POST["btEnv"])){
				$txLike=$_POST["Text1"];
				$query = "SELECT idAtividade,txAtividade, Periodicidade, HorimetroAlerta,HorimetroUltima,HorimetroProxima, Maquina, Horimetro, tbMaquinas.Area FROM tbAtividades inner join tbMaquinas using(idMaquina) WHERE (txAtividade LIKE '%".$txLike."%');";
			}else{
			
				$query = "SELECT idAtividade,txAtividade, Periodicidade, HorimetroAlerta,HorimetroUltima,HorimetroProxima, Maquina, Horimetro, tbMaquinas.Area FROM tbAtividades inner join tbMaquinas using(idMaquina);";
			}
			
		//echo $query ;
		
			if ($stmt = $con-> prepare($query)) {
			    $stmt->execute();
			    $stmt->bind_result($idAtividade,$txAtividade, $Periodicidade, $HorimetroAlerta, $HorimetroUltima, $HorimetroProxima, $Maquina, $Horimetro, $Area);
			    while ($stmt->fetch()) {
			       $horas=($HorimetroProxima-$Horimetro);
			       $barra=(100-((($HorimetroProxima-$Horimetro)/$Periodicidade)*100));

			       if($barra>100){
			       	$barra=100;}
			       if($barra<0){
			       		$barra=0;}
		        echo '<tr >';
			    echo '  <td><div id="box" class="box" ><span class="Corpo">&nbsp;&nbsp;'.$txAtividade.'&nbsp;&nbsp;&nbsp;&nbsp;';
			    echo '	 &nbsp;'.$Maquina.'</span><br/><span class="texto">';
			    echo '  &nbsp;&nbsp;Periodicidade:&nbsp;</span><span class="Progress1">'.$Periodicidade.'&nbsp;h</SPAN>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="texto">&nbsp;Horimetro atual:&nbsp;</span><span class="Progress1">'.$Horimetro.'&nbsp;h&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br/>';
			    echo '  <span class="texto">&nbsp;&nbsp;Proxima Atividade:&nbsp;</span><span class="Progress1">'.$HorimetroProxima.'&nbsp;h&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; 
			    echo '  <div id="myProgress" style="width: 300px"><div id="myBar" style="width: '.round(($barra),2).'%" class="auto-style9">'.$horas.'h</div></div></span></td>';
			    
			    echo '  <td><a href="executar.php?id=';
			    echo $idAtividade;
			    echo '"><img height="30" src="images/procedimento2.png" width="32"></a></td>';
			     
			    echo '  <td><a href="" onclick="open_win_editar('.$idAtividade.');"';
			    //echo $idAtividade;
			    echo '"><img height="30" src="images/encerrar.png" width="32"></a></td>';
			    
		      	        
			  

			    }
			    $stmt->close();
			}
?>

						
		</tr>			
		</tr>
		<tr>
			<td style="width: 990px">&nbsp;</td>
						
			<td class="texto">&nbsp;</td>
						
			<td class="auto-style2">&nbsp;</td>
						
		</tr>
		</table></form>
	<p>&nbsp;</p>
		
	</body>
	
</html>



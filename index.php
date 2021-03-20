<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
<style type="text/css">
	a {
	color: #FFFFFF;
}
a:visited {
	color: #FFFFFF;
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
	font-family: Verdana, Geneva, Tahoma, sans-serif;
	color: #FFFFFF;
	text-align: center;
	font-size: 24px;
}



.Conteudo {
	text-align: center;
	font-family: Georgia;
	color: #FFFFFF;
	text-align: center;
	font-size: 15px;
	line-height: 150%;
}

</style>
</head>
<?php 
include('topo.php'); //incluir menu
include('conecta.php');
//include('topo.php'); //conexao a dbase


?>
<body style="background-color: #222E34;">

<p><br />
</p>
<p>&nbsp;</p>
<p class="Titulo"><strong>Bem Vindo ao CIL - Online</strong></p>
<p class="Conteudo">&nbsp;</p>
<p class="Conteudo">Ao escolher uma area voce sera levado direto as 
pendencias da area</p>
<p class="Conteudo">O CIL é a estrtegia da companhia para manter as maquina 
rodando</p>
<p class="Conteudo">&nbsp;</p><br>
<p class="SubTitulo"><strong>Escolha a Area para iniciar</strong></p>
<br><br>
<table id="table" class="table"style="width: 757px; height: 41px;">
	<?php 
	$query = "SELECT Area FROM Horimetros.tbMaquinas Group by Area";
		
		
			if ($stmt = $con-> prepare($query)) {
			    $stmt->execute();
			    $stmt->bind_result($Area);
			    $i=1;
			    while ($stmt->fetch()) {
			    if($i==0)
			    	echo '<tr>';
			        //printf("%s, %s\n", $field1, $field2);
			     echo '<td><div id="caixa" class="caixa"><p>&nbsp;<a href="pendentes.php?Area='.$Area.'">'.$Area.'</a></p></div></td>';
			     //echo '<td><div id="caixa" class="caixa"><p>&nbsp;<a href="L501.php"</a></p></div></td>';
			    if($i==4){
			    	echo '</tr>';
			    	$i=0;
			    	}
   
				$i++;		      	        
			    }
			    $stmt->close();
			}

	
	?>
	
</table>
	

</body>

</html>
<?php $con->close();?>
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
<p class="Titulo"><strong>ESCOLHA A MÁQUINA</strong></p>

<br><br>
<table id="table" class="table"style="width: 757px; height: 41px;">
	<?php 
	$query = "SELECT Maquina FROM Horimetros.tbMaquinas WHERE Area='L501' Group by Maquina";
		
		
			if ($stmt = $con-> prepare($query)) {
			    $stmt->execute();
			    $stmt->bind_result($Area);
			    $i=1;
			    while ($stmt->fetch()) {
			    if($i==0)
			    	echo '<tr>';
			        //printf("%s, %s\n", $field1, $field2);
			     echo '<td><div id="caixa" class="caixa"><p>&nbsp;<a href="pendentes.php?Area='.$Area.'">'.$Area.'</a></p></div></td>';
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
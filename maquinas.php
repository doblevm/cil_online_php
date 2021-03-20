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
    <title></title>
    </style>
    <style type="text/css">
	.Titulo {
	text-align: center;
	font-family: Tahoma, Geneva, Tahoma, sans-serif;
	color: #FFFFFF;
	text-align: center;
	font-size: 48px;
	}



.SubTitulo {
	text-align: left;
	font-family: Cambria, Geneva, Tahoma, sans-serif;
	color: #FFFFFF;
	font-size: 20px;
	line-height: 150%;

}



.Conteudo {
	text-align:left;
	font-family: "Tahoma";
	color: #FFFFFF;
	font-size: 15px;
	line-height: 150%;
}
tr {background-color: #43494B;}

	</style>
  </head>
  <?php
//inclui cabeçalho padrao da pagina com menu
 include('topo.php'); 
?>

  <body style="background-color: #222E34;">    
    
	
	<p>&nbsp;</p>
	<p>&nbsp;</p>
    
    <table style="width: 757px; height: 41px; left: 15%; margin-left: 30px; position: relative;">	
    	<tr>
			<td class="Titulo" colspan="4">Maquinas Cadastradas</td>
		</tr>
		<tr>
			<td class="SubTitulo">Maquina</td>
			<td class="SubTitulo">Area</td>
			<td class="SubTitulo">Grupo</td>
			<td class="SubTitulo">Horimetro</td>
			
		</tr>
		<?php
			$query = "SELECT Maquina, Area, Horimetro, Grupo FROM Horimetros.tbMaquinas order by Area,idMaquina, Grupo, Maquina asc;";
		
		
			if ($stmt = $con-> prepare($query)) {
			    $stmt->execute();
			    $stmt->bind_result($Maquina, $Area, $Horimetro, $Grupo);
			    while ($stmt->fetch()) {
			        //printf("%s, %s\n", $field1, $field2);
			    echo '<tr>';
			    echo '  <td class="Conteudo">'.$Maquina.'</td>';
			    echo '  <td class="Conteudo">'.$Area.'</td>';
			    echo '  <td class="Conteudo">'.$Grupo.'</td>';
			    echo '  <td class="Conteudo">'.$Horimetro.'</td>';    
						      	        
			    }
			    $stmt->close();
			}
?>

			
		</tr>
	</table>
  </body>
</html>


<?php $con->close();?>
  <?php
//inclui cabeçalho padrao da pagina com menu
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
			<td class="Titulo" colspan="5">Usuarios<strong> Cadastrados</strong></td>
		</tr>
		<tr>
			<td class="auto-style3"><strong>Nome</strong></td>
			<td class="auto-style3">ID</td>
			<td class="auto-style3">Nivel</td>
			<td class="auto-style3"><strong>Ativo</strong></td>
			<td class="auto-style3"><strong>Data Cadastro</strong></td>
			
		</tr>
		<?php
			$query = "SELECT  `usuarios`.`nome`, `usuarios`.`usuario`, `usuarios`.`nivel`, `usuarios`.`ativo`, `usuarios`.`cadastro` FROM `Horimetros`.`usuarios`;";
		
		
			if ($stmt = $con-> prepare($query)) {
			    $stmt->execute();
			    $stmt->bind_result($nome, $usuario, $nivel,$ativo,$cadastro);
			    while ($stmt->fetch()) {
				       
				    echo '<tr>';
				    echo '  <td class="Corpo">'.$nome.'</td>';
				    echo '  <td class="Corpo">'.$usuario.'</td>';
				    echo '  <td class="Corpo">'.$nivel.'</td>'; 
				    echo '  <td class="Corpo">'.$ativo.'</td>'; 
				    echo '  <td class="Corpo">'.$cadastro.'</td>';    
							      	        
			    }
			    
			 $stmt->close();
			}
?>

			
		</tr>
	</table>
  </body>
</html>


<?php $con->close();?>
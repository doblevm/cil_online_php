<?php
include('conecta.php');
$id=$_GET['q'];
$query = "SELECT Name FROM Horimetros.tbFuncionarios where id ='".$id."';";


			if ($stmt = $con->prepare($query)) {
			    $stmt->execute();
			    $stmt->bind_result($Name);
			    while ($stmt->fetch()) {
			        
  					echo $Name;
			    }
			   }
			   // $stmt->close();
?>

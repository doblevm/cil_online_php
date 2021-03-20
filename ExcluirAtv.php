<?php
 include('conecta.php'); 
 $id=$_GET['id'];
			$query = "DELETE FROM tbAtividades where(idAtividade=".$id.");";
			if ($stmt = $con->prepare($query)){
			    $stmt->execute();
				}
			   $stmt->close();
			   echo "<script>window.close();</script>";			   
?>
<?php $con->close();?>
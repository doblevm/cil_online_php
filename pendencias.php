<html>
<head>
<meta content="pt-br" http-equiv="Content-Language">
</head>
<body>
<p><?php
$host="10.24.12.81";
$port=3306;
$socket="";
$user="eduardo";
$password="100senha";
$dbname="Horimetros";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

$query = "SELECT * FROM Horimetros.tbMaquinas";


if ($stmt = $con->prepare($query)) {
    $stmt->execute();
    $stmt->bind_result($field1, $field2);
    while ($stmt->fetch()) {
        //printf("%s, %s\n", $field1, $field2);
    }
    $stmt->close();
}



$con->close();

?>
</p>
</body>
</html>

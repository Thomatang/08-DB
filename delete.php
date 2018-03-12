<?php
/**** Supprimer une randonnée ****/
$servername = "localhost";
$username = "root";
$password = "popo8989";
$dbname = "reunion_island";

if(isset($_POST['Delete'])){
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	

$sql = "DELETE FROM hiking WHERE id='".$_POST['Delete']."'"; // ideas= WHERE id='".$_POST['id']."'"
// prepare sql and bind parameters
    $stmt = $conn->exec($sql);
// use exec() because no results are returned
	echo "The trail has been deleted successfully.";
	header('Location: read.php');
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
}

?>

<?php
$servername = "localhost";
$username = "root";
$password = "popo8989";
$dbname = "reunion_island";


//========================================================================================
//PRE-FILL form with data of element we want to update
//==========================================================================================
try {
    $conn = new PDO("mysql:host=$servername;dbname=reunion_island", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	/*echo "Connected successfully"; */
	/*var_dump($_POST); */
	$stmt = $conn -> prepare("SELECT * FROM `hiking` WHERE id='".$_POST['Submit']."'") ;

	$stmt->execute();
	
	$stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);


//turn data into array before displaying in form
 foreach( $stmt as $stmt ){
	 	echo $stmt['id'];
		echo $stmt['name'];
		echo $stmt['difficulty'];
		echo $stmt['distance'];
		echo $stmt['duration'];
		echo $stmt['height_difference'];
    }

    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
	}

//========================================================================================
// SEND New data back to my SQL -- UPDATE SQL REQUEST
//==========================================================================================
	if(isset($_POST['submit'])){
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	

$sql = "UPDATE hiking SET name=:name, difficulty=:difficulty, distance=:distance, duration=:duration, height_difference=:height_difference WHERE id='".$_POST['id']."'"; // ideas= WHERE id='".$_POST['id']."'"
// prepare sql and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':difficulty',$difficulty);
	$stmt->bindParam(':distance',$distance);
	$stmt->bindParam(':duration',$duration);
	$stmt->bindParam(':height_difference',$height_difference);

// use exec() because no results are returned

//insert a row
$name = $_POST['name'];
$difficulty = $_POST['difficulty'];
$distance = $_POST['distance'];
$duration = $_POST['duration'];
$height_difference = $_POST['height_difference'];
    $stmt->execute();
	echo "The trail has been updated successfully.";
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<input type="hidden" name="id" value="<?php echo $stmt['id']; ?>">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?php echo $stmt['name']; ?>">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="<?php echo $stmt['difficulty']; ?>"><?php echo $stmt['difficulty']; ?></option>
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?php echo $stmt['distance']; ?>">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="<?php echo $stmt['duration']; ?>">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?php echo $stmt['height_difference']; ?>">
		</div>
		<input type="submit" value="submit" name="submit" />
	</form>
</body>
</html>
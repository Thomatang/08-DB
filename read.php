<?php
$servername = "localhost";
$username = "root";
$password = "popo8989";

try {
    $conn = new PDO("mysql:host=$servername;dbname=reunion_island", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /*echo "Connected successfully";*/ 
    $stmt = $conn->prepare("SELECT * FROM hiking"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $data= $stmt->fetchAll();
    $output = "";
    foreach($data as $k=>$v) { 
       $output .=  " <tr><td>".$v['id']."</td>";
        $output .=  "<td>".$v['name']."</td>";
        $output .=  "<td>".$v['difficulty']."</td>";
        $output .=  "<td>".$v['distance']."</td>";
        $output .=  "<td>".$v['duration']."</td>";
        $output .=  "<td>".$v['height_difference']."</td>";
        $output .=  "<td> <form action='update.php' method='post' value='"
        .$v['id']
        ."'>
        <input type='submit' value='".$v['id']."' name='Submit' />
        
        </form></td></tr>";
    }
}
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
$conn = null;


?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
  <h1>Liste des randonnées</h1>
  <table style='border: solid 1px black;'>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Difficulty</th>
        <th>Distance</th>
        <th>Duration</th>
        <th>height_difference</th>
    </tr>

    <?php
    echo $output;
    ?>

    </table>
  </body>
</html>
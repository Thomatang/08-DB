<?php



echo " <h1>Liste des randonnées</h1>";
echo "<table style='border: solid 1px black;'>";
 echo "<tr><th>Id</th><th>Name</th><th>Difficulty</th><th>Distance</th><th>Duration</th><th>height_difference</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 


$servername = "localhost";
$username = "root";
$password = "popo8989";

try {
    $conn = new PDO("mysql:host=$servername;dbname=reunion_island", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    $stmt = $conn->prepare("SELECT * FROM hiking"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
$conn = null;
echo "</table>";

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    
  </body>
</html>
<?php
$db_host = 'localhost'; // Server Name
$db_user = 'root'; // Username
$db_pass = 'popo8989'; // Password
$db_name = 'reunion_island'; // Database Name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
}

$sql = 'SELECT * 
		FROM hiking';
		
$query = mysqli_query($conn, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

<h1>Hikerdom</h1>
	<table class="data-table">
		<caption class="title">Some Volcano-themed hiking trails to start with:</caption>
		<thead>
			<tr>
				<th>NO</th>
				<th>NAME</th>
				<th>DIFFICULTY</th>
				<th>DISTANCE</th>
				<th>DURATION</th>
                <th>HEIGHT-DIFFERENCE</th>
			</tr>
		</thead>
		<tbody>
		<?php
        
        while ($row = mysqli_fetch_array($query))
		{
		
			echo '<tr>
					<td>'.$row['id'].'</td>
					<td>'.$row['name'].'</td>
					<td>'.$row['difficulty'].'</td>
					<td>'. $row['distance'] . '</td>
                    <td>'.$row['duration'].'</td>
                    <td>'.$row['height_difference'].'</td>
                </tr>';
        }
		?>
		</tbody>
		<tfoot>
			<tr>
				<h2>Let's Go Hiking!</h2>
			</tr>
		</tfoot>
	</table>


</body>
</html>
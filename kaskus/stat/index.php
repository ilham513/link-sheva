<? 
$servername = "sql110.epizy.com";
$username = "epiz_25949741";
$password = "0R4T8MSyAU16";
$dbname = "epiz_25949741_sheva";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
 ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<div class="jumbotron p-4 m-4" style="font-size:24px">



<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Url</th>
      <th scope="col">Visit</th>
    </tr>
  </thead>
  <tbody>
<?
$sql = "SELECT img,COUNT(*) AS n FROM kaskus GROUP BY img ORDER BY n desc LIMIT 10";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	echo "<tr>";
    echo "<td><a id='shw' href='".$row["img"]."'> ...".substr($row["img"],-10)." </a> </td><td>" . $row["n"]. "</td>";
	echo "<tr>";
  }
} else {
  echo "0 results";
}
?>
  </tbody>
</table>



<hr/>




<?
$sql = "SELECT COUNT(*) AS n
FROM kaskus";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo "<h1>Total Pengunjung ".$row[n]."</h1>";
?>




<hr/>



<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Url</th>
      <th scope="col">Visit</th>
    </tr>
  </thead>
  <tbody>
<?
$sql = "SELECT DATE_FORMAT(timestamp,'%m/%d') AS timestamp2,COUNT(*) AS n 
FROM kaskus 
GROUP BY timestamp2 
ORDER BY timestamp2 desc
LIMIT 7";
$result = $conn->query($sql);
// $row = $result->fetch_assoc(); var_dump($row); die();
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	echo "<tr>";
    echo "<td>".$row["timestamp2"]."</td>
		 <td>" . $row["n"]. "</td>";
	echo "</tr>";
	$tim[] = $row["timestamp2"];
	$en[] = $row["n"];
  }
} else {
  echo "0 results";
}

$tim = array_reverse($tim);
$en = array_reverse($en);
$tim = implode("','",$tim);
$en = implode(",",$en);
?>
  </tbody>
</table>



<hr/>

<center>
<div style="width: 80%;height: 500px">
		<canvas id="myChart"></canvas>
</div>
</center>






<script>
var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ['<?echo $tim?>'],
				datasets: [{
					label: 'Pengunjung',
					data: [<? echo $en ?>],
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
</script>


<hr/>



<?
$sql = "
SELECT DATE_FORMAT(timestamp,'%H') AS timestamp2,COUNT(*) AS n 
FROM kaskus 
GROUP BY timestamp2 
ORDER BY timestamp2 desc
";
$result = $conn->query($sql);
// $row = $result->fetch_assoc(); var_dump($row); die();

unset($tim);
unset($en);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	$tim[] = $row["timestamp2"];
	$en[] = $row["n"];
  }
} else {
  echo "0 results";
}

$tim = array_reverse($tim);
$en = array_reverse($en);
$tim = implode("','",$tim);
$en = implode(",",$en);
?>




<center> <h2>Jam Kunjungan</h2>
<div style="width: 80%;height: 500px">
		<canvas id="myChart2"></canvas>
</div>
</center>




 

<script>
var ctx = document.getElementById("myChart2").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ['<?echo $tim?>'],
				datasets: [{
					label: 'Pengunjung',
					data: [<? echo $en ?>],
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
</script>



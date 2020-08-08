<?
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Origin: https://ilham513.github.io')  
?>
<!DOCTYPE html>
<html>
<head>
   <!-- HTML meta refresh URL redirection -->
   <meta http-equiv="refresh" content="10; url=<? echo "http://kuliah-kalkulus.sheva.my.id/tampil-gambar/?url=".$_GET['img']?>">

	<script>
	var greetings = [];
	var greeting_id = Math.floor(Math.random() * 3);
	
	fetch("https://api.rss2json.com/v1/api.json?rss_url=https://medium.com/feed/@isetiabhakti")
	  .then((res) => res.json())
	  .then((data) => {
		const res = data.items;
		console.log(res.length);
		var i;
		for (i = 0; i < res.length; i++) {
		  console.log(res[i].link);
		  greetings.push(res[i].link);
		}
		
		var x = document.querySelector("a").href = greetings[greeting_id];
	  });
	</script>

</head>
<body>

<?
$img = $_GET['img'];
// echo $img;

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

date_default_timezone_set('Asia/Jakarta'); 

$timestamp = date('Y-m-d H:i:s');

// echo $timestamp;die();

$sql = "INSERT INTO kaskus (img,timestamp)
VALUES ('$img','$timestamp')";

if ($conn->query($sql) === TRUE) {
  echo "<div style='font-size: 40px;padding:15px';><a onclick='runing()' href='' rel='nofollow external noopener noreferrer'>Klik di sini</a> untuk melihat gambar.<hr/> <progress style='text-align: center;' value=\"0\" max=\"10\" id=\"progressBar\"></progress></div>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();




echo '<script>


function runing(){
window.open("http://kuliah-kalkulus.sheva.my.id/tampil-gambar/?url='.$img.'");
}

var timeleft = 10;
var downloadTimer = setInterval(function(){
  if(timeleft <= 0){
    clearInterval(downloadTimer);
  }
  document.getElementById("progressBar").value = 10 - timeleft;
  timeleft -= 1;
}, 1000);

</script>';





// header("Location: http://hinata-pro-sakura-beban.wblog.id/view/?url=$img");
?>


</body>
</html>
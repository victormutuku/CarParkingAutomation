<?php
// session_start();
// if ($_SESSION['User'] == null) {
// 	header("Location: login/login.php");
// 	die();
// }

if (!isset($_SESSION['User'])) {
	header("Location: login/login.php");
	die();
}
?>
<?php
require_once ('user.php');
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Parking System</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="parkme.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="navbar">
		<a href="#">HOME</a>
		<a href="#">ABOUT</a>
		<a href="#">CLIENTS</a>
		<a href="#">SETTINGS</a>
		<div class="dropdown">
			<button class="dropbtn" onclick="myFunction()">SERVICES
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-content" id="myDropdown">
				<a href="#">Service 1</a>
				<a href="#">Service 2</a>
				<a href="#">Service 3</a>
			</div>
		</div>
		
	</div>

	


	<div class="polaroid">
		<a href="#">
			<img height="250" src=carr.png alt="Occupied" title="Occupied"/>
			<span style="font-size:20px;cursor:pointer" onclick="openNav()">&#9776;View Details</span>
			<div id="myNav" class="overlay"> <!--the overlay-->
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times; <!--button to close the overlay navigation-->
				</a>

				<form action="#" method="POST">		
						<div class="overlay-content">

							<div>
								<p>Plate Number</p>
								<input type="text" id="carplate" name="carplate" placeholder="plate number" value="<?php echo $_SESSION['User'] ?>">
							</div>

							<div>
								<p>Car Type</p>
								<input type="text" id="cartype" name="cartype" placeholder="car type" value="<?php echo "$cartype"; ?>">
							</div>

							<div>
								<p>Car Colour</p>
								<input type="text" id="carcolour" name="carcolour" placeholder="car colour" value="<?php echo "$carcolour"; ?>">
							</div>

							<div>
								<p>Time Stamp</p>
								<input type="time" id="timestamp" name="timestamp" placeholder="time stamp" value="<?php echo "$timestamp"; ?>">
							</div>
							<!-- <input type="submit" name="" value="GO"> -->
				</form>
					
				</div>

				<div class="pagination_section"> 
        			<a href="#"><< Previous</a>  
        			<a href="#">Next >></a> 
    			</div> 
			</div>
		</a>
	</div>

	<script>
		function myFunction() {
			document.getElementById("myDropdown").classList.toggle("show");
		}

		window.onclick = function(e) {
			if (!e.target.matches('.dropbtn')) {
				var myDropdown = document.getElementById("myDropdown");
				if (myDropdown.classList.contains('show')) {
					myDropdown.classList.remove('show');
				}

			}
		}

		function openNav() {
			document.getElementById("myNav").style.height = "100%";
		}

		function closeNav() {
			document.getElementById("myNav").style.height = "0%";
		}

		/*function openNav() {
			document.getElementById("myNav").style.height = "100%";
		}

		function closeNav() {
			document.getElementById("myNav").style.height = "0%";
		}*/
	</script>

</body>
</html>
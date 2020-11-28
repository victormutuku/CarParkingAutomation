<?php
// if (!isset($_SESSION['User'])) {
// 	header("Location: index.php");
// 	die();
// }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Panel</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styleEmployee.css">

	<script>
	
		function ModalOpen(){
		var BgModal = document.getElementById("bg-modal");
		var modalcp = document.getElementById("modalcarpark");
			if (BgModal.style.display === "none"){
				BgModal.style.display = "flex";
				modalcp.style.display = "none";
			}else{
				BgModal.style.display = "none";
			}
		}

		function ModalCarPark(){
			var BgModal = document.getElementById("bg-modal");
			var modalcp = document.getElementById("modalcarpark");
			if (modalcp.style.display == "none") {
				modalcp.style.display = "block";
				BgModal.style.display = "none"
			} else {
				modalcp.style.display = "none";
			}
		}

	</script>
</head>

<body>
	<div class="header">
		<br>
		<p>Welcome back</p>
	</div>

	<div class="main-content">
		<div class="sidebar">
			<ul>
				<button onclick="ModalOpen()" class="navbuttons">Manual Register</button>
				<button onclick="ModalCarPark()" class="navbuttons">Car Parks</button>
				<!-- car park.php  -->
				<button onclick="" class="navbuttons">Auto Register</button>
				<button onclick="" class="navbuttons">Checkout</button>
				<a href="logout.php"><button class="navbuttons">Log Out</button></a>		
			</ul>
		</div>
	</div>

	<!-- Car Parks -->
		<div class="parkinglot" id="modalcarpark">
			<ul>
				<a href="parkinglot.php"><li>Car Park 1</li></a>
				<a href=""><li>Car Park 2</li></a>
				<a href=""><li>+</li></a>
			</ul>  
		</div>

	<!-- Car Details Registration -->

		<form action="web_actions.php" method="POST">
		<div id="bg-modal">	
			<div class="login-box">
			
				<div class="textbox">
				<input type="text " id="numberplate" name="numberPlate" placeholder="Number Plate">
				<br>
				</div>

				<div class="textbox">
				<input type="text" id="carcolour" name="carcolour" placeholder="Car Color">
				<br>
				</div>

				<div class="textbox">
				<input type="text" id="type" name="type" placeholder="Type">
				<br>
				</div>

				<div class="textbox">
				<input type="text" name="phoneNo" id="phoneNo" placeholder="PhoneNumber">
				<br>
				</div>
				
				<div>
				<button type="submit" name="car_reg_details" class="register-button">Register</button>
				</div>
				<?php
				if(!isset($_GET['car_reg_details'])){
					exit();
				}else{
					$loginError = $_GET['RegStatus'];

					if($loginError == "Success"){
					echo "<p class='success'>Success</p>";
					exit();
					}
				}
				?>
			</div>
		</form>
	</body>
</html>
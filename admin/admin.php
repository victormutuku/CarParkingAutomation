 <?php
if (!isset($_SESSION['User'])) {
	header("Location: index.php");
	die();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Panel</title>
		<link rel="stylesheet" type="text/css" href="style.css">>
	</head>

	<body>
		<form action="../web_actions.php" method="POST">
			<div class="header">
				<br>
				<p>Welcome back Admin</p>
			</div>
			<div class="main-content">
				<div class="sidebar">
					<ul>
						<li><a href="userReg.php">View Employees</a></li>					
						<li><a href="#">View Report</a></li>
						<li><a href="../logout.php">Log Out</a></li>
					</ul>
				</div>
			</div>
		</form>
		
	</body>
</html>
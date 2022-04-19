<!DOCTYPE html>
<html lang="en">
<head>
	<title>Search</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="styles.css" />

</head>
<body>

<! --- top bar --->
<nav class="navbar">
		<div class="navbar__container">
			<a href="/" id="navbar__logo">
				<img src="images/Icon.png" alt="">
			</a>
			<div class="navbar__toggle" id="mobile-menu">
				<span class="bar"></span>
				<span class="bar"></span>
				<span class="bar"></span>
			</div>
			<ul class="navbar__menu">
				<li class="navbar__btn">
					<a href="/" class="button">
						Home
					</a>
				</li>
				<li class="navbar__btn">
					<a href="/search.php" class="button">
						Search
					</a>
				</li>
<?php 
					if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
						echo '<a href="/create.html" class="button">
						Post
					</a>';
					}
				?>

								<li class="navbar__btn">
					<a href="/login.html" class="button">
						Login
					</a>
				</li>
			</ul>
		</div>
	</nav>

<?php

require_once('sql_connect.php');

$query = "SELECT Content_ID, subject, date FROM metadata WHERE metadata.subject LIKE '" . $_GET['query'] . "%';";


$raw_results = @mysqli_query($dbc, $query) or die(mysqli_error());


if($raw_results){
	echo '<ul class="teaser_btn">';
			
			while($row = mysqli_fetch_array($raw_results)) {
				
				echo '<form action="/content.php" method="GET" class="navbar__btn">';
				echo '<button name="Content_ID" value="' . $row["Content_ID"] . '" class="button">' . $row["subject"] . ' posted on ' . $row["date"] . '</button>';
				echo '</form>';
				
			}

			echo '</ul>';
}

?>




</body>

</html>
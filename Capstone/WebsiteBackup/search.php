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






	<form action="search_database.php" method="GET">
		<input type="text" name="query" />
		<input type="submit" value="Search" />
	</form>
</body>
</html>
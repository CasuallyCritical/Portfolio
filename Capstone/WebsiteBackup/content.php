<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="UTF-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Notably - CREATE</title>

	<link rel="stylesheet" href="styles.css" />

</head>

<body>

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

				<li class="navbar__btn">

					<a href="/create.html" class="button">

						Post

					</a>

				</li>

				<li class="navbar__btn">

					<a href="/login.html" class="button">

						Login

					</a>

				</li>

			</ul>

		</div>

	</nav>

	<!-- View Page -->

	<?php

	

	require_once('sql_connect.php');

	

	if($_SERVER["REQUEST_METHOD"] == "GET") {
		
		$queryID = "SELECT Note.Text, metadata.subject from Note, Notes, Content, metadata where Content.Content_ID ="  . $_GET["Content_ID"] . " and metadata.Content_ID = Content.Content_ID and Notes.Notes_ID = Content.Notes_ID and Note.Note_ID = Notes.Note_ID;";

		$response = @mysqli_query($dbc, $queryID);
		
		if($response) {
			
			while($row = mysqli_fetch_array($response)) {
				echo '<div class="text_area_content">';
				echo $row["subject"];
				echo '<br>';

				$subject = $row["Text"];

				$separator = "\r\n";
				$line = strtok($subject, $separator);

				while ($line !== false) {
					echo $line;
					echo '<br>';
					$line = strtok( $separator );
				}

    			echo '</div>';
				
			}
		} else {
			echo "Couldn't issue database query";
			echo mysqli_error($dbc);
		}

		mysqli_close($dbc);

	}

	

	exit();

	

	?>

</body>

</html>


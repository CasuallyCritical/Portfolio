<?php
session_start();
require_once('sql_connect.php');

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
            $sql = "SELECT User_Number, UserName, password FROM Users;";
            $response = @mysqli_query($dbc, $sql);

            if($response) {
				
				
                while($row = mysqli_fetch_array($response)) {
                    if($row["password"] == $password) {
						echo "Login success!";
						
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $row["User_Number"];
                        $_SESSION["username"] = $username;
						break;
                    }
                }
				
				//header("Location: notably.hstn.me/index.php");
            }
            
            
        }
    }
    
    // Close connection
    //mysqli_close($dbc);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Quizzy</title>
	<link rel="stylesheet" href="styles.css" />
</head>
<body>
	<nav class="navbar">
		<div class="navbar__container">
			<a href="/" id="navbar__logo">
				<img src="images/Icon.png" alt="">
				<?php
					if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true && isset($_SESSION["username"])) {
						echo 'Welcome ' . $_SESSION["username"] . '!';
					}
				?>
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
	<!-- Home page recents -->
	<?php
	
		//require_once('sql_connect.php');
		$queryID = "select Content_ID, subject, date from metadata order by date desc;";
		$response = @mysqli_query($dbc, $queryID);
		
		if($response) {
			echo '<ul class="teaser_btn">';
			
			while($row = mysqli_fetch_array($response)) {
				
				echo '<form action="/content.php" method="GET" class="navbar__btn">';
				echo '<button name="Content_ID" value="' . $row["Content_ID"] . '" class="button">' . $row["subject"] . ' posted on ' . $row["date"] . '</button>';
				echo '</form>';
				
			}

			echo '</ul>';
		} else {
			echo "Couldn't issue database query";
			echo mysqli_error($dbc);
		}

		mysqli_close($dbc);
	
	?>
	</body>
</html>
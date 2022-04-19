<?php

DEFINE ('DB_USER', 'quizzyuser');
DEFINE ('DB_PASSWORD', 'q!781@7A');
DEFINE ('DB_HOST', 'quizzydb.profrusso.com');
DEFINE ('DB_NAME', 'quizzydb');

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to MySQL ' . mysqli_connect_error());

?>
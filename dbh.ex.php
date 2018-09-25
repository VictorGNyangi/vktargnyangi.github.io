<?php
//Creating a connection
//The database to be called artnetwork

DEFINE('dbServername', 'localhost');
DEFINE('dbUsername', 'root');
DEFINE('dbPassword', '6lack');
DEFINE('dbName', 'artnetwork');

$conn = @mysqli_connect()(dbServername, dbUsername, dbPassword, dbName) OR dies('Could not connect to Mysql: '.mysqli_connect_error());
<?php
$ServerName = "localhost";
$UserName = "root";
$DBPassword = "";
$DBName = "db_votingsyt";
$Con = mysqli_connect($ServerName,$UserName,$DBPassword,$DBName);
if(!$Con)
{
	echo"Connectio failed";
}
?>
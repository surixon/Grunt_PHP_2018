<?php
/* Connect to an ODBC database using driver invocation */
$host="localhost";
$user = "traalero_trainee";
$password = "trainee";
$dsname = "traalero_gruntwork";

try 
{
    $pdo = new PDO("mysql:host=localhost;dbname=traalero_gruntwork",$user,$password);
   
} 
catch (PDOException $e)
{
    $e->getMessage();
   
}
?>


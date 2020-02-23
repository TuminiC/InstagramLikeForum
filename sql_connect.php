<?php
$servername= "localhost";
$username="root";
$password="";
$dbname="assign4";

//create new connection
$conn= new mysqli($servername,$username,$password,$dbname);
if ($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
?>
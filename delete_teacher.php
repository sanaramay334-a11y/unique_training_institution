<?php

include("db.php");

$id = $_GET['id'];

$query = "DELETE FROM teachers WHERE id='$id'";

if(mysqli_query($conn,$query))
{
    header("Location: view_teachers.php");
    exit();
}

?>
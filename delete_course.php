<?php

include("db.php");

$id = $_GET['id'];

$query = "DELETE FROM courses WHERE id='$id'";

if(mysqli_query($conn,$query))
{
    header("Location: view_courses.php");
    exit();
}

?>
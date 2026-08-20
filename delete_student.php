<?php

include("db.php");

$id = $_GET['id'];

$query = "DELETE FROM students WHERE id='$id'";

if(mysqli_query($conn,$query))
{
    header("Location: view_students.php");
    exit();
}

?>
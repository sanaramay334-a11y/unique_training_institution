<?php
include("db.php");

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $delete = "DELETE FROM results WHERE id='$id'";

    if(mysqli_query($conn,$delete))
    {
        header("Location: view_results.php");
        exit();
    }
    else
    {
        echo "Error deleting record.";
    }
}
?>

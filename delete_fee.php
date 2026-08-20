<?php

include("db.php");

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM fees WHERE id='$id'");

header("Location: view_fees.php");
exit();

?>
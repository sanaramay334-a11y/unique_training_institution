<?php
include("db.php");

$id = $_GET['id'];

$stmt = mysqli_prepare(
$conn,
"SELECT * FROM students WHERE id=?"
);

mysqli_stmt_bind_param($stmt,"i",$id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result)==0)
{
die("Student Not Found");
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>

<head>

<title>Student Verification</title>

<style>

body{
font-family:Arial;
background:#F1F5F9;
}

.box{
width:600px;
margin:40px auto;
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,.15);
}

h2{
text-align:center;
color:green;
}

img{
display:block;
margin:auto;
width:130px;
height:130px;
border-radius:50%;
}

table{
width:100%;
margin-top:20px;
border-collapse:collapse;
}

td{
padding:12px;
border:1px solid #ddd;
}

</style>

</head>

<body>

<div class="box">

<h2>Student Verified ✓</h2>

<img src="uploads/<?php echo $row['picture']; ?>">

<table>

<tr>
<td><b>Student ID</b></td>
<td>UTI-<?php echo str_pad($row['id'],4,"0",STR_PAD_LEFT); ?></td>
</tr>

<tr>
<td><b>Name</b></td>
<td><?php echo $row['student_name']; ?></td>
</tr>

<tr>
<td><b>Father</b></td>
<td><?php echo $row['father_name']; ?></td>
</tr>

<tr>
<td><b>Class</b></td>
<td><?php echo $row['class_name']; ?></td>
</tr>

<tr>
<td><b>Course</b></td>
<td><?php echo $row['course']; ?></td>
</tr>

<tr>
<td><b>Phone</b></td>
<td><?php echo $row['phone']; ?></td>
</tr>

</table>

</div>

</body>

</html>
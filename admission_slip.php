<?php
include("db.php");

if(!isset($_GET['id']))
{
    die("Invalid Request");
}

$id = $_GET['id'];

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM admissions WHERE id=?"
);

mysqli_stmt_bind_param($stmt,"i",$id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result)==0)
{
    die("Admission Not Found");
}

$row = mysqli_fetch_assoc($result);

if($row['status']!="Approved")
{
    die("Admission is not Approved Yet.");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admission Slip</title>

<style>

body{
    font-family:Arial,sans-serif;
    background:#F1F5F9;
}

.slip{
    width:750px;
    margin:30px auto;
    background:white;
    padding:30px;
    border:2px solid #2563EB;
}

.header{
    text-align:center;
}

.header img{
    width:80px;
}

.header h2{
    margin:10px 0;
    color:#0F172A;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:25px;
}

table td{
    border:1px solid #ccc;
    padding:12px;
}

.print-btn{
    display:block;
    width:220px;
    margin:25px auto;
    background:#2563EB;
    color:white;
    padding:12px;
    text-align:center;
    text-decoration:none;
    border-radius:8px;
    cursor:pointer;
}

.signature{
    margin-top:60px;
    display:flex;
    justify-content:space-between;
}

@media print{

.print-btn{
display:none;
}

}

</style>

</head>

<body>

<div class="slip">

<div class="header">

<img src="http://localhost/unique_training_institution/images/logo.png">

<h2>Unique Training Institution</h2>

<h3>Admission Slip</h3>

</div>

<table>

<tr>
<td><b>Admission ID</b></td>
<td><?php echo $row['id']; ?></td>
</tr>

<tr>
<td><b>Student Name</b></td>
<td><?php echo $row['student_name']; ?></td>
</tr>

<tr>
<td><b>Phone</b></td>
<td><?php echo $row['phone']; ?></td>
</tr>

<tr>
<td><b>Email</b></td>
<td><?php echo $row['email']; ?></td>
</tr>

<tr>
<td><b>Course</b></td>
<td><?php echo $row['course']; ?></td>
</tr>

<tr>
<td><b>Status</b></td>
<td style="color:green;font-weight:bold;">
<?php echo $row['status']; ?>
</td>
</tr>

<tr>
<td><b>Date</b></td>
<td><?php echo date("d-m-Y"); ?></td>
</tr>

</table>

<div class="signature">

<div>
_____________________<br>
Student Signature
</div>

<div>
_____________________<br>
Principal Signature
</div>

</div>

<a class="print-btn" onclick="window.print()">
Print Admission Slip
</a>

</div>

</body>
</html>
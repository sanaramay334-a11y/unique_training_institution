<?php
include("db.php");

$id = $_GET['id'];

$stmt = mysqli_prepare(
$conn,
"SELECT fees.*, students.student_name
FROM fees
INNER JOIN students
ON fees.student_id=students.id
WHERE fees.id=?"
);

mysqli_stmt_bind_param($stmt,"i",$id);

mysqli_stmt_execute($stmt);

$result=mysqli_stmt_get_result($stmt);

$row=mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>Fee Receipt</title>

<style>

body{
font-family:Arial,sans-serif;
background:#F1F5F9;
}

.receipt{
width:700px;
margin:30px auto;
background:white;
padding:30px;
border:2px solid #2563EB;
}

h2,h3{
text-align:center;
}

table{
width:100%;
border-collapse:collapse;
margin-top:25px;
}

td{
padding:12px;
border:1px solid #ccc;
}

.print{
text-align:center;
margin-top:25px;
}

button{
padding:12px 25px;
background:#2563EB;
color:white;
border:none;
cursor:pointer;
border-radius:8px;
}

@media print{

button{
display:none;
}

}

</style>

</head>

<body>

<div class="receipt">

<h2>Unique Training Institution</h2>

<h3>Fee Receipt</h3>

<table>

<tr>
<td><b>Receipt No</b></td>
<td><?php echo $row['id']; ?></td>
</tr>

<tr>
<td><b>Student Name</b></td>
<td><?php echo $row['student_name']; ?></td>
</tr>

<tr>
<td><b>Amount</b></td>
<td>Rs. <?php echo $row['amount']; ?></td>
</tr>

<tr>
<td><b>Payment Date</b></td>
<td><?php echo $row['payment_date']; ?></td>
</tr>

<tr>
<td><b>Status</b></td>
<td><?php echo $row['status']; ?></td>
</tr>

</table>

<br><br>

<div style="display:flex;justify-content:space-between;">

<div>

_____________________<br>

Student Signature

</div>

<div>

_____________________<br>

Cashier Signature

</div>

</div>

<div class="print">

<button onclick="window.print()">

Print Receipt

</button>

</div>

</div>

</body>
</html>

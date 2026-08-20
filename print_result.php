<?php
include("db.php");

$id = $_GET['id'];

$query = mysqli_query($conn,
"SELECT * FROM results WHERE id='$id'");

$row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>

<html>
<head>
    <title>Student Report Card</title>

<style>
body{
    font-family:Arial, sans-serif;
    background:#F1F5F9;
}

.report-card{
    width:700px;
    margin:30px auto;
    background:white;
    padding:30px;
    border:2px solid #000;
}

.report-card h1,
.report-card h2{
    text-align:center;
}

.report-table{
    width:100%;
    margin-top:20px;
    border-collapse:collapse;
}

.report-table th,
.report-table td{
    border:1px solid #000;
    padding:10px;
    text-align:left;
}

.print-btn{
    background:#3B82F6;
    color:white;
    padding:10px 20px;
    border:none;
    cursor:pointer;
    margin-top:20px;
}

@media print{
    .print-btn{
        display:none;
    }
}
</style>

</head>
<body>

<div class="report-card">

<h1>Unique Training Institution ERP</h1>

<h2>Official Result Card</h2>

<table class="report-table">

<tr>
    <th>Student Name</th>
    <td><?php echo $row['student_name']; ?></td>
</tr>

<tr>
    <th>Subject</th>
    <td><?php echo $row['subject']; ?></td>
</tr>

<tr>
    <th>Marks</th>
    <td><?php echo $row['marks']; ?></td>
</tr>

<tr>
    <th>Percentage</th>
    <td><?php echo $row['percentage']; ?></td>
</tr>

<tr>
    <th>Grade</th>
    <td><?php echo $row['grade']; ?></td>
</tr>

<tr>
    <th>Remarks</th>
    <td><?php echo $row['remarks']; ?></td>
</tr>

<tr>
    <th>Date</th>
    <td><?php echo date("d-m-Y"); ?></td>
</tr>

</table>

<br><br><br>

<table style="width:100%; border:none;">

<tr>

<td style="border:none; text-align:left;">
____________________
<br>
Student Signature
</td>

<td style="border:none; text-align:right;">
____________________
<br>
Principal Signature
</td>

</tr>

</table>

<center>

<button class="print-btn"
onclick="window.print()">
Print Report Card </button>

</center>

</div>

</body>
</html>

<?php
session_start();

if(!isset($_SESSION['student_id']))
{
    header("Location: student_login.php");
    exit();
}

include("db.php");

$student_id = $_SESSION['student_id'];

$student = mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT * FROM students WHERE id='$student_id'")
);

$result_count = mysqli_num_rows(
mysqli_query($conn,
"SELECT * FROM results
WHERE student_name='".$student['student_name']."'")
);

$attendance_count = mysqli_num_rows(
mysqli_query($conn,
"SELECT * FROM attendance
WHERE student_id='$student_id'")
);

$fee_count = mysqli_num_rows(
mysqli_query($conn,
"SELECT * FROM fees
WHERE student_id='$student_id'")
);

$results = mysqli_query($conn,
"SELECT * FROM results
WHERE student_name='".$student['student_name']."'");

$attendance = mysqli_query($conn,
"SELECT * FROM attendance
WHERE student_id='$student_id'");

$fees = mysqli_query($conn,
"SELECT * FROM fees
WHERE student_id='$student_id'");
?>

<!DOCTYPE html>

<html>
<head>
<title>Student Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Student Dashboard</h1>

<div class="card" style="max-width:900px; margin:20px auto;">

<h2>Student Profile</h2>

<table>

<tr>
<th>Photo</th>
<td>
<img src="uploads/<?php echo $student['picture']; ?>"
width="120"
height="120">
</td>
</tr>

<tr>
<th>Name</th>
<td><?php echo $student['student_name']; ?></td>
</tr>

<tr>
<th>Father Name</th>
<td><?php echo $student['father_name']; ?></td>
</tr>

<tr>
<th>Class</th>
<td><?php echo $student['class_name']; ?></td>
</tr>

<tr>
<th>Email</th>
<td><?php echo $student['email']; ?></td>
</tr>

<tr>
<th>Phone</th>
<td><?php echo $student['phone']; ?></td>
</tr>

<tr>
<th>Course</th>
<td><?php echo $student['course']; ?></td>
</tr>

</table>

</div>
<div class="cards-container">


<div class="card">
<h3>Attendance Records</h3>
<p class="count"><?php echo $attendance_count; ?></p>
</div>

<div class="card">
<h3>Results</h3>
<p class="count"><?php echo $result_count; ?></p>
</div>

<div class="card">
<h3>Fee Records</h3>
<p class="count"><?php echo $fee_count; ?></p>
</div>

</div>

<h2>My Results</h2>

<table>

<tr>
<th>Subject</th>
<th>Marks</th>
<th>Percentage</th>
<th>Grade</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($results))
{
?>

<tr>
<td><?php echo $row['subject']; ?></td>
<td><?php echo $row['marks']; ?></td>
<td><?php echo $row['percentage']; ?></td>
<td><?php echo $row['grade']; ?></td>
</tr>

<?php
}
?>

</table>

<h2>My Attendance</h2>

<table>

<tr>
<th>Date</th>
<th>Status</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($attendance))
{
?>

<tr>
<td><?php echo $row['attendance_date']; ?></td>
<td><?php echo $row['status']; ?></td>
</tr>

<?php
}
?>

</table>

<h2>My Fee Status</h2>

<table>

<tr>
<th>Amount</th>
<th>Payment Date</th>
<th>Status</th>
</tr>

<?php
while($fee = mysqli_fetch_assoc($fees))
{
?>

<tr>
<td><?php echo $fee['amount']; ?></td>
<td><?php echo $fee['payment_date']; ?></td>
<td><?php echo $fee['status']; ?></td>
</tr>

<?php
}
?>

</table>

<br><br>

<a class="edit-btn" href="student_logout.php">
Logout
</a>

</body>
</html>

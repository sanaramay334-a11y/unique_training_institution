<?php
include("db.php");

$query = "
SELECT fees.*, students.student_name
FROM fees
INNER JOIN students
ON fees.student_id = students.id
WHERE fees.status='Pending'
ORDER BY fees.id DESC
";

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pending Fees</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Pending Fee Students</h2>

<table>

<tr>
    <th>ID</th>
    <th>Student Name</th>
    <th>Amount</th>
    <th>Payment Date</th>
    <th>Status</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['student_name']; ?></td>
    <td><?php echo $row['amount']; ?></td>
    <td><?php echo $row['payment_date']; ?></td>
    <td><?php echo $row['status']; ?></td>
</tr>

<?php
}
?>

</table>

</body>
</html>
<?php
include("db.php");
$total_paid = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT SUM(amount) AS total
FROM fees
WHERE status='Paid'
"));

$total_pending = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT SUM(amount) AS total
FROM fees
WHERE status='Pending'
"));

if(isset($_GET['search']))
{
    $search = $_GET['search'];

    $query = "
    SELECT
    students.student_name,
    fees.amount,
    fees.payment_date,
    fees.status
    FROM fees
    INNER JOIN students
    ON fees.student_id = students.id
    WHERE students.student_name LIKE '%$search%'
    ";
}
else
{
    $query = "
    SELECT
    students.student_name,
    fees.amount,
    fees.payment_date,
    fees.status
    FROM fees
    INNER JOIN students
    ON fees.student_id = students.id
    ";
}

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>

<html>
<head>
    <title>Fee Report</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Fee Report</h2>
<div class="cards-container">

<div class="card">
<h3>Total Fees Collected</h3>
<p class="count">
<?php echo $total_paid['total']; ?>
</p>
</div>

<div class="card">
<h3>Total Pending Fees</h3>
<p class="count">
<?php echo $total_pending['total']; ?>
</p>
</div>

</div>
<form method="GET">

<input type="text"
name="search"
placeholder="Search Student">

<input type="submit"
value="Search">

</form>

<br>
<table>

<tr>
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
    <td><?php echo $row['student_name']; ?></td>
    <td><?php echo $row['amount']; ?></td>
    <td><?php echo $row['payment_date']; ?></td>
    <td><?php echo $row['status']; ?></td>
</tr>

<?php
}
?>
<button onclick="window.print()"
class="edit-btn">
Print Report
</button>
</table>

</body>
</html>

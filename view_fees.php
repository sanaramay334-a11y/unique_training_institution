<?php
include("db.php");

$query = "
SELECT fees.*, students.student_name
FROM fees
INNER JOIN students
ON fees.student_id = students.id
ORDER BY fees.id DESC
";

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>
   <head>
<title>View Fees</title>
<link rel="stylesheet" href="style.css">

<style>

.edit-btn,
.delete-btn,
.print-btn{
    color:white;
    padding:8px 12px;
    border-radius:6px;
    text-decoration:none;
    display:inline-block;
    margin:2px;
    font-size:14px;
}

.edit-btn{
    background:#2563EB;
}

.edit-btn:hover{
    background:#1D4ED8;
}

.delete-btn{
    background:#DC2626;
}

.delete-btn:hover{
    background:#B91C1C;
}

.print-btn{
    background:#16A34A;
}

.print-btn:hover{
    background:#15803D;
}

</style>
</head>
<body>

<h2>Fee Records</h2>

<table>

<tr>
    <th>ID</th>
    <th>Student</th>
    <th>Amount</th>
    <th>Payment Date</th>
    <th>Status</th>
    <th>Actions</th>
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
    <td>

<a class="edit-btn"
href="edit_fee.php?id=<?php echo $row['id']; ?>">
Edit
</a>

<a class="delete-btn"
href="delete_fee.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this fee record?')">
Delete
</a>

<a class="print-btn"
href="fee_receipt.php?id=<?php echo $row['id']; ?>">
Print Receipt
</a>


<a class="print-btn"
href="fee_receipt_pdf.php?id=<?php echo $row['id']; ?>">
📄 Download PDF
</a>

</td>
</tr>

<?php
}
?>

</table>

</body>
</html>
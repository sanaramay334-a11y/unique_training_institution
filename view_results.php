<?php
include("db.php");

if(isset($_GET['search']))
{
    $search = $_GET['search'];

    $query = "SELECT * FROM results
              WHERE student_name LIKE '%$search%'
              OR subject LIKE '%$search%'";
}
else
{
    $query = "SELECT * FROM results";
}

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>

<html>
<head>
    <title>View Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Results List</h2>

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
    <th>ID</th>
    <th>Student Name</th>
    <th>Subject</th>
    <th>Marks</th>
    <th>Percentage</th>
    <th>Grade</th>
    <th>Remarks</th>
    <th>Actions</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['student_name']; ?></td>
    <td><?php echo $row['subject']; ?></td>
    <td><?php echo $row['marks']; ?></td>
    <td><?php echo $row['percentage']; ?></td>
    <td><?php echo $row['grade']; ?></td>
    <td><?php echo $row['remarks']; ?></td>


<td class="actions">

    <a class="edit-btn"
       href="edit_result.php?id=<?php echo $row['id']; ?>">
       Edit
    </a>

    <a class="delete-btn"
       href="delete_result.php?id=<?php echo $row['id']; ?>"
       onclick="return confirm('Delete this result?')">
       Delete
    </a>

    <a class="edit-btn"
       href="print_result.php?id=<?php echo $row['id']; ?>">
       Print
    </a>

</td>


</tr>

<?php
}
?>

</table>

</body>
</html>

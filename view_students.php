<?php
include("db.php");

if(isset($_GET['search']))
{
    $search = $_GET['search'];

    $query = "SELECT * FROM students
              WHERE student_name LIKE '%$search%'
              OR father_name LIKE '%$search%'
              OR class_name LIKE '%$search%'";
}
else
{
    $query = "SELECT * FROM students";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <style>

table{
width:100%;
border-collapse:collapse;
}

th,td{
padding:12px;
border:1px solid #ddd;
text-align:left;
}

.action-buttons{
display:flex;
flex-wrap:wrap;
gap:5px;
min-width:320px;
}

.action-buttons a{
background:#2563EB;
color:white;
padding:8px 12px;
border-radius:6px;
text-decoration:none;
font-size:14px;
}

.action-buttons a:hover{
background:#1D4ED8;
}

.print-btn{
display:inline-block;
background:#16A34A;
color:white;
padding:10px 18px;
border-radius:8px;
text-decoration:none;
font-weight:bold;
margin-bottom:15px;
}

.print-btn:hover{
background:#15803D;
}

</style>
    <title>View Students</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Students List</h2>

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
    <th>Photo</th>
    <th>Name</th>
    <th>Father Name</th>
    <th>Class</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Course</th>
    <th>Actions</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

    <td><?php echo $row['id']; ?></td>

    <td>
<img src="uploads/<?php echo $row['picture']; ?>" width="60" height="60">
    </td>
    

    <td><?php echo $row['student_name']; ?></td>

    <td><?php echo $row['father_name']; ?></td>

    <td><?php echo $row['class_name']; ?></td>

    <td><?php echo $row['email']; ?></td>

    <td><?php echo $row['phone']; ?></td>

    <td><?php echo $row['course']; ?></td>

    <td>

        <a href="students_pdf.php" class="print-btn">
📄 Download Students PDF
</a> 

<div class="action-buttons">

<a href="edit_student.php?id=<?php echo $row['id']; ?>">Edit</a>

<a href="delete_student.php?id=<?php echo $row['id']; ?>">Delete</a>

<a href="certificate.php?id=<?php echo $row['id']; ?>">Certificate</a>

<a href="student_profile.php?id=<?php echo $row['id']; ?>">Profile</a>

<a href="id_card.php?id=<?php echo $row['id']; ?>">ID</a>


</div>

</td>

</tr>
<?php
}
?>

</table>

</body>
</html>
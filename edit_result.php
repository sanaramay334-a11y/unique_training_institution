<?php
include("db.php");

$id = $_GET['id'];

$result = mysqli_query($conn,
"SELECT * FROM results WHERE id='$id'");

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $student_name = $_POST['student_name'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];
    $percentage = $_POST['percentage'];
    $grade = $_POST['grade'];

    $update = "UPDATE results SET
    student_name='$student_name',
    subject='$subject',
    marks='$marks',
    percentage='$percentage',
    grade='$grade'
    WHERE id='$id'";

    if(mysqli_query($conn,$update))
    {
        header("Location: view_results.php");
        exit();
    }
}
?>

<!DOCTYPE html>

<html>
<head>
    <title>Edit Result</title>
    <link rel="stylesheet" href="style.css">
<style>
body{
    background:#F1F5F9;
    font-family:Arial,sans-serif;
}

.form-container{
    width:600px;
    margin:40px auto;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,0.15);
}

.form-container h2{
    text-align:center;
    color:#0F172A;
    margin-bottom:25px;
}

.form-container label{
    font-weight:bold;
    color:#334155;
}

.form-container input[type="text"],
.form-container input[type="email"]{
    width:100%;
    padding:12px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #CBD5E1;
    border-radius:8px;
    box-sizing:border-box;
}

.form-container input[type="submit"]{
    width:100%;
    background:#2563EB;
    color:white;
    border:none;
    padding:14px;
    border-radius:10px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}

.form-container input[type="submit"]:hover{
    background:#1D4ED8;
}

.success{
    text-align:center;
    color:green;
    font-weight:bold;
}
</style>
</head>
<body>
<div class="form-container">
<h2>📝Edit Result</h2>
<form method="POST">

Student Name<br>
<input type="text"
       name="student_name"
       value="<?php echo $row['student_name']; ?>"
       required>
<br><br>

Subject<br>
<input type="text"
       name="subject"
       value="<?php echo $row['subject']; ?>"
       required>
<br><br>

Marks<br>
<input type="number"
       name="marks"
       value="<?php echo $row['marks']; ?>"
       required>
<br><br>
Percentage<br> <input type="text"
    name="percentage"
    value="<?php echo $row['percentage']; ?>"
    required>

<br><br>

Grade<br>
<input type="text"
       name="grade"
       value="<?php echo $row['grade']; ?>"
       required>
<br><br>

<input type="submit"
       name="update"
       value="Update Result">


</form>
</div>
</body>
</html>

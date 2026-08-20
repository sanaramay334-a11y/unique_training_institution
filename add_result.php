<?php
include("db.php");

if(isset($_POST['add_result']))
{
    $student_name = $_POST['student_name'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];

    $percentage = $marks . "%";

    if($marks >= 80)
    {
        $grade = "A";
        $remarks = "Pass";
    }
    elseif($marks >= 70)
    {
        $grade = "B";
        $remarks = "Pass";
    }
    elseif($marks >= 60)
    {
        $grade = "C";
        $remarks = "Pass";
    }
    elseif($marks >= 50)
    {
        $grade = "D";
        $remarks = "Pass";
    }
    else
    {
        $grade = "F";
        $remarks = "Fail";
    }

    $query = "INSERT INTO results
    (student_name, subject, marks, percentage, grade, remarks)
    VALUES
    ('$student_name','$subject','$marks',
    '$percentage','$grade','$remarks')";

    if(mysqli_query($conn,$query))
    {
        echo "<h3>Result Added Successfully</h3>";
    }
}
?>

<!DOCTYPE html>

<html>
<head>
    <title>Add Result</title>
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
<h2>📝Add Result</h2>

<form method="POST">
<label>Student Name</label><br> <input type="text" name="student_name" required>

<br><br>

<label>Subject</label><br> <input type="text" name="subject" required>

<br><br>

<label>Marks</label><br> <input type="number" name="marks" required>

<br><br>

<input type="submit"
    name="add_result"
    value="Add Result">

</form>
</div>
</body>
</html>

<?php
include("db.php");

if(isset($_POST['save']))
{
    $teacher_name = $_POST['teacher_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $specialization = $_POST['specialization'];

    $query = "INSERT INTO teachers
    (teacher_name,email,phone,specialization)
    VALUES
    ('$teacher_name','$email','$phone','$specialization')";

    if(mysqli_query($conn,$query))
    {
        $message = "Teacher Added Successfully";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Teacher</title>
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

<h2>👨‍🏫 Add Teacher</h2>

<form method="POST">

    <label>Teacher Name</label><br>
    <input type="text" name="teacher_name" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email"><br><br>

    <label>Phone</label><br>
    <input type="text" name="phone"><br><br>

    <label>Specialization</label><br>
    <input type="text" name="specialization"><br><br>

    <input type="submit" name="save" value="Add Teacher">

</form>
</div>
<?php
if(isset($message))
{
    echo "<p class='success'>$message</p>";
}
?>

</body>
</html>

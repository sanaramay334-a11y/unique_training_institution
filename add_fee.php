<?php
include("db.php");

$students = mysqli_query($conn,"SELECT * FROM students");

if(isset($_POST['save']))
{
    $student_id = $_POST['student_id'];
    $amount = $_POST['amount'];
    $payment_date = $_POST['payment_date'];
    $status = $_POST['status'];

    $query = "INSERT INTO fees
    (student_id,amount,payment_date,status)
    VALUES
    ('$student_id','$amount','$payment_date','$status')";

    if(mysqli_query($conn,$query))
    {
        $message = "Fee Record Added Successfully";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Fee</title>
    <link rel="stylesheet" href="style.css">
     <style>
body{
    background:#F1F5F9;
    font-family:Arial,sans-serif;
}

.form-container{
    width:650px;
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

.form-container input[type="date"],
.form-container select{
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
    margin-top:15px;
}
</style>
</head>
<body>
<div class="form-container">

<h2>💰Add Fee Record</h2>

<form method="POST">

<label>Student</label><br>

<select name="student_id" required>

<?php
while($row = mysqli_fetch_assoc($students))
{
?>
<option value="<?php echo $row['id']; ?>">
    <?php echo $row['student_name']; ?>
</option>
<?php
}
?>

</select>

<br><br>

<label>Amount</label><br>
<input type="number" name="amount" required>

<br><br>

<label>Payment Date</label><br>
<input type="date" name="payment_date" required>

<br><br>

<label>Status</label><br>

<select name="status">
    <option value="Paid">Paid</option>
    <option value="Pending">Pending</option>
</select>

<br><br>

<input type="submit" name="save" value="Save Fee">

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
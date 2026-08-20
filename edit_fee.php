<?php
include("db.php");

$id = $_GET['id'];

$query = "SELECT * FROM fees WHERE id='$id'";
$result = mysqli_query($conn,$query);

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $amount = $_POST['amount'];
    $payment_date = $_POST['payment_date'];
    $status = $_POST['status'];

    $update = "UPDATE fees SET
    amount='$amount',
    payment_date='$payment_date',
    status='$status'
    WHERE id='$id'";

    if(mysqli_query($conn,$update))
    {
        header("Location: view_fees.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Fee</title>
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

<h2>💰Edit Fee Record</h2>

<form method="POST">

<label>Amount</label><br>
<input type="number"
       name="amount"
       value="<?php echo $row['amount']; ?>"
       required>

<br><br>

<label>Payment Date</label><br>
<input type="date"
       name="payment_date"
       value="<?php echo $row['payment_date']; ?>"
       required>

<br><br>

<label>Status</label><br>

<select name="status">

<option value="Paid"
<?php if($row['status']=="Paid") echo "selected"; ?>>
Paid
</option>

<option value="Pending"
<?php if($row['status']=="Pending") echo "selected"; ?>>
Pending
</option>

</select>

<br><br>

<input type="submit"
       name="update"
       value="Update Fee">

</form>
</div>

</body>
</html>
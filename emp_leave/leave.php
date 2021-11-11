<?php 
    include('../config/db_connection.php');

	include('../components/navigation.php');

    $messages = array('notification'=>'');

	if(isset($_POST['apply'])) {
		//getting id of the data from url
		$id =   $_SESSION['emp_id'];
		//echo $id;
		$reason = $_POST['reason'];
	
		$start = $_POST['start'];
		//echo "$reason";
		$end = $_POST['end'];

		print_r($_SESSION['emp_id']);
	
		$sql = "INSERT INTO leave_tb(leave_id,emp_id,leave_description,start_date,end_date,status) VALUES ('','$id','$reason','$start','$end','Pending')";
	
		$result = mysqli_query($conn, $sql);
	
		$messages['notification'] = '<div class="alert alert-success" role="alert" style="text-align: center">Your leave application has been submited and is now pending approval</div>'; 
	}
?>

<!DOCTYPE html>
	<html lang="en">
	<head>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
	<title>Leave Application</title>
<style>
body {
	color: #fff;
	background: #EEE;
	font-family: 'Roboto', sans-serif;
}
.form-control {
	height: 40px;
	box-shadow: none;
	color: #969fa4;
}
.form-control:focus {
	border-color: #5cb85c;
}
.form-control, .btn {        
	border-radius: 3px;
}
.signup-form {
	width: 450px;
	margin: 0 auto;
    margin-top: 30px;
	padding: 30px 0;
  	font-size: 15px;
}
.signup-form h2 {
	color: #636363;
	margin: 0 0 15px;
	position: relative;
	text-align: center;
}
.signup-form h2:before, .signup-form h2:after {
	content: "";
	height: 2px;
	width: 30%;
	background: #d4d4d4;
	position: absolute;
	top: 50%;
	z-index: 2;
}	
.signup-form h2:before {
	left: 0;
}
.signup-form h2:after {
	right: 0;
}
.signup-form .hint-text {
	color: #999;
	margin-bottom: 30px;
	text-align: center;
}
.signup-form form {
	color: #999;
	border-radius: 3px;
	margin-bottom: 15px;
	background: #f2f3f7;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;
}
.signup-form .form-group {
	margin-bottom: 20px;
}
.signup-form input[type="checkbox"] {
	margin-top: 3px;
}
.signup-form .btn {        
	font-size: 16px;
	font-weight: bold;		
	min-width: 140px;
	outline: none !important;
}
.signup-form .row div:first-child {
	padding-right: 10px;
}
.signup-form .row div:last-child {
	padding-left: 10px;
}    	
.signup-form a {
	color: #fff;
	text-decoration: underline;
}
.signup-form a:hover {
	text-decoration: none;
}
.signup-form form a {
	color: #5cb85c;
	text-decoration: none;
}	
.signup-form form a:hover {
	text-decoration: underline;
}  
</style>
</head>

<body>
<div class="signup-form">
    <form action="leave.php" method="post">
		<h2>Leave</h2>
        <?php echo $messages['notification']?>
        <div class="form-group">
            <label>Reason for Leave</label>
        	<input type="text" class="form-control" name="reason" placeholder="Reason for leave" required="required">
        </div>
        <div class="form-group">
            <label>Start Date</label>
            <input type="date" class="form-control" value="" min="1970-01-01" max="2021-12-31" name="start" required>
        </div>

		<div class="form-group">
            <label>End Date</label>
            <input type="date" class="form-control" value="" min="1970-01-01" max="2021-12-31" name="end" required>
        </div>       
		<div class="form-group">
            <button type="submit" name="apply" class="btn btn-success btn-lg btn-block">Apply</button>
        </div>
    </form>
</div>
</body>
</html>
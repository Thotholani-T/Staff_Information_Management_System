<?php
    include('../config/db_connection.php');

    include('../components/navigation.php');

    $emp_id = $_SESSION['emp_id'];

    $sql_d = "SELECT project.project_no,project_name,project_budget,date_comissioned,expected_completion_date FROM project,employee WHERE employee.project_no = project.project_no AND emp_id=$emp_id;";

    $result_d = mysqli_query($conn,$sql_d);

    $project = mysqli_fetch_all($result_d,MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <style>
        .container {
            background-color: #fff;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="container-fluid">
            <h1 class="mt-5 mb-3" style="padding-top: 5px;">View Record</h1>
            <div class="row">
                    <div class="form-group col-6">
                        <label>Project Number</label>
                        <h4><b><?php echo $project['0']['project_no']; ?></b></h4>
                    </div>
                    <div class="form-group col-6">
                        <label>Project Name</label>
                        <h4><b><?php echo $project['0']["project_name"]; ?></b></h4>
                    </div>
                    <div class="form-group col-6">
                        <label>Project Budget</label>
                        <h4><b><?php echo $project['0']["project_budget"]; ?></b></h4>
                    </div>
                    <div class="form-group col-6">
                        <label>Date_Commissioned</label>
                        <h4><b><?php echo $project['0']["date_comissioned"]; ?></b></h4>
                    </div>
                    <div class="form-group col-6">
                        <label>Expected Completion Date</label>
                        <h4><b><?php echo $project['0']["expected_completion_date"]; ?></b></h4>
                    </div>
            </div>
                    
            <div class="row">
                <h4 class="col-6"><a href="javascript:history.back()" class="btn btn-secondary btn-lg">Back</a></h4>
            </div>
        </div>
    </div>
</body>
</html>